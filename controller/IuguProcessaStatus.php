<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 12/02/2019
 * Time: 21:25
 */


include_once "Geral.php";
Include_once("../vendor/mashape/unirest-php/src/Unirest.php");
include_once("./IuguCtrl.php");
include_once("../src/models/IuguFatura.php");
include_once("../src/models/IuguLogs.php");
include_once("../src/models/IuguLogsDetConsulta.php");
include_once("../database.php");

use models\IuguFatura;
use models\IuguLogs;
use models\IuguLogsDetConsulta;

/**
 * @param $dataProcessamento
 * @param $iuguLog
 * @param $entityManager
 */


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['action'] == "procstatusiugu") {
        $codigoLog = 0;
        $diasRecuo = '10';
        if (isset($_GET['returndays']) &&  $_GET['returndays']!=''){
            $diasRecuo = $_GET['returndays'];
        }
        $dataProcessamento = new DateTime('-'.$diasRecuo.' day');
        $iuguLog = createIuguLog();
        $codigoLog = $iuguLog->getCodigo();
        $entityManager->persist($iuguLog);
        $entityManager->flush();
        try {
            executeCallConsultasIuguPaginadas($dataProcessamento, $iuguLog, $entityManager);
        }catch (Exception $exception){
            $iuguLog->setMensagem($exception->getMessage());
        }
        if ($iuguLog->getMensagem()!=null && $iuguLog->getMensagem()!=''){
            $entityManager->merge($iuguLog);
            $entityManager->flush();
        }
        return $codigoLog;
    }
}

function executeCallConsultasIuguPaginadas($dataProcessamento, $iuguLog, $entityManager)
{
    $start = 0;
    $limit = 50;
    $inter = 0;
    while( true ) {
        try {
            $start = $limit*$inter;
            $response = callIuguConsultaListaFaturasAlteradas($dataProcessamento, $start, $limit);
            if ($response != null) {
                $resultIugu = processaResponseIugu($response);
                if ($resultIugu->isSuccess()) {
                    executeProcessamentoStatus($iuguLog, $resultIugu, $entityManager);
                    if ($response->body->totalItems < $start) {
                        return;
                    }
                } else {
                    $iuguLog->setMensagem("Falha ao Executar procedimento resultIugu not Success");
                    return;
                }
            } else {
                $iuguLog->setMensagem("Falha ao Executar procedimento Response null");
                return;
            }
        } finally {
            if ($inter>=100) {
                return;
            }
            $inter = $inter + 1;
        }
    }
}

function executeProcessamentoStatus(IuguLogs $iuguLogs, $resultIugu, $entityManager)
{
    if ($resultIugu->isSuccess()) {
        $countRegister = $resultIugu->getBody()->totalItems;
        if ($countRegister > 0) {
            $body = $resultIugu->getBody();
            for ($i = 0; $i < $countRegister; $i++) {
                $item = $body->items[$i];
                if ($item!=null) {
                    $fatura = getObjectFaturaIugu($item);
                    processaAtualizacaoMovimento($iuguLogs, $fatura, $entityManager);
                }
            }
        }
    }
}

function processaAtualizacaoMovimento(IuguLogs $iuguLogs, IuguFatura $fatura, $entityManager)
{
    if ($entityManager != null) {
        $qb = $entityManager->createQueryBuilder();
        if ($qb != null) {
                $qb->select('p.transacao ,p.operacao', 'p.status')
                    ->from('models\PendFinBlt', 'p')
                    ->where('p.invoice_id = :id')
                    ->setParameter('id', $fatura->id);
            $dadosResult = $qb->getQuery()->getResult();
            foreach ($dadosResult as $dadosObj) {
                if ( $dadosObj['status'] != "B" ) {
                    $statusFatura = getStatusByFatura($fatura);
                    if ($statusFatura != $dadosObj['status']) {
                        $iuguDetLog = createIuguLogDet($iuguLogs, $dadosObj['operacao'], $dadosObj['status'], $statusFatura);
                        $qbpbl = $entityManager->createQueryBuilder();
                        $qbpbl->update('models\PendFinBlt', 'p')
                            ->set('p.status', '?1')
                            ->where('p.operacao = ?2')
                            ->setParameter(1, $statusFatura)
                            ->setParameter(2, $dadosObj['operacao']);

                        $qbpfin = $entityManager->createQueryBuilder();
                        $qbpfin->update('models\PendFin', 'p')
                            ->set('p.status', '?1')
                            ->where('p.operacao = ?2')
                            ->setParameter(1, $statusFatura)
                            ->setParameter(2, $dadosObj['operacao']);

                        $entityManager->getConnection()->beginTransaction();
                        $qbpbl->getQuery()->execute();
                        $qbpfin->getQuery()->execute();
                        $entityManager->persist($iuguDetLog);
                        $entityManager->flush();
                        $entityManager->getConnection()->commit();
                    }
                    if (strtoupper($fatura->status) == "EXPIRED") {
                        $iuguDetLog = createIuguLogDet($iuguLogs, $dadosObj['operacao'], $dadosObj['status'], $statusFatura);
                        $qbpbl = $entityManager->createQueryBuilder();
                        $qbpbl->update('models\PendFinBlt', 'p')
                            ->set('p.status', '?1')
                            ->where('p.operacao = ?2')
                            ->setParameter(1, "P")
                            ->setParameter(2, $dadosObj['operacao']);

                        $qbpfin = $entityManager->createQueryBuilder();
                        $qbpfin->update('models\PendFin', 'p')
                            ->set('p.cobranca', '?1')
                            ->set('p.status', '?2')
                            ->where('p.operacao = ?3')
                            ->setParameter(1, 'S')
                            ->setParameter(2, 'P')
                            ->setParameter(3, $dadosObj['operacao']);
                        $entityManager->getConnection()->beginTransaction();
                        $qbpbl->getQuery()->execute();
                        $qbpfin->getQuery()->execute();
                        $entityManager->persist($iuguDetLog);
                        $entityManager->flush();
                        $entityManager->getConnection()->commit();
                    }
                }
            }
        }
    }
}

function getStatusByFatura(IuguFatura $fatura){
    $result = "";
    if (strtoupper($fatura->status)=="PENDING"){
        $result = "P";
    } else if (strtoupper($fatura->status)=="PAID"){
        $result = "B";
    } else if (strtoupper($fatura->status)=="CANCELED"){
        $result = "C";
    } else if (strtoupper($fatura->status)=="PARTIALLY_PAID"){//TODO Não sei oque fazer aqui.
        $result = "P";
    } else if (strtoupper($fatura->status)=="EXPIRED"){
        $result = "P";
    } else if (strtoupper($fatura->status)=="AUTHORIZED"){
        $result = "P";
    }
    return $result;
}

function getObjectFaturaIugu($item)
{
    $fatura = new IuguFatura();
    $fatura->id = $item->id;
    $fatura->due_date = $item->due_date;
    $fatura->currency = $item->currency;
    $fatura->discount_cents = $item->discount_cents;
    $fatura->email = $item->email;
    $fatura->notification_url = $item->notification_url;
    $fatura->return_url = $item->return_url;
    $fatura->status = $item->status;
    $fatura->tax_cents = $item->tax_cents;
    $fatura->total_cents = $item->total_cents;
    $fatura->total_paid_cents = $item->total_paid_cents;
    $fatura->taxes_paid_cents = $item->taxes_paid_cents;
    $fatura->paid_at = $item->paid_at;
    $fatura->paid_cents = $item->paid_cents;
    $fatura->cc_emails = $item->cc_emails;
    $fatura->payable_with = $item->payable_with;
    $fatura->overpaid_cents = $item->overpaid_cents;
    $fatura->ignore_due_email = $item->ignore_due_email;
    $fatura->ignore_canceled_email = $item->ignore_canceled_email;
    $fatura->advance_fee_cents = $item->advance_fee_cents;
    $fatura->commission_cents = $item->commission_cents;
    $fatura->early_payment_discount = $item->early_payment_discount;
    $fatura->order_id = $item->order_id;
    $fatura->updated_at = $item->updated_at;
    $fatura->secure_id = $item->secure_id;
    $fatura->secure_url = $item->secure_url;
    $fatura->customer_id = $item->customer_id;
    $fatura->customer_ref = $item->customer_ref;
    $fatura->customer_name = $item->customer_name;
    $fatura->user_id = $item->user_id;
    $fatura->total = $item->total;
    $fatura->taxes_paid = $item->taxes_paid;
    $fatura->total_paid = $item->total_paid;
    $fatura->total_overpaid = $item->total_overpaid;
    $fatura->commission = $item->commission;
    $fatura->fines_on_occurrence_day = $item->fines_on_occurrence_day;
    $fatura->total_on_occurrence_day = $item->total_on_occurrence_day;
    $fatura->fines_on_occurrence_day_cents = $item->fines_on_occurrence_day_cents;
    $fatura->total_on_occurrence_day_cents = $item->total_on_occurrence_day_cents;
    $fatura->financial_return_date = $item->financial_return_date;
    $fatura->advance_fee = $item->advance_fee;
    $fatura->paid = $item->paid;
    $fatura->original_payment_id = $item->original_payment_id;
    $fatura->double_payment_id = $item->double_payment_id;
    $fatura->interest = $item->interest;
    $fatura->discount = $item->discount;
    $fatura->created_at = $item->created_at;
    $fatura->created_at_iso = $item->created_at_iso;
    $fatura->authorized_at = $item->authorized_at;
    $fatura->authorized_at_iso = $item->authorized_at_iso;
    $fatura->expired_at = $item->expired_at;
    $fatura->expired_at_iso = $item->expired_at_iso;
    $fatura->refunded_at = $item->refunded_at;
    $fatura->refunded_at_iso = $item->refunded_at_iso;
    $fatura->canceled_at = $item->canceled_at;
    $fatura->canceled_at_iso = $item->canceled_at_iso;
    $fatura->protested_at = $item->protested_at;
    $fatura->protested_at_iso = $item->protested_at_iso;
    $fatura->chargeback_at = $item->chargeback_at;
    $fatura->chargeback_at_iso = $item->chargeback_at_iso;
    $fatura->occurrence_date = $item->occurrence_date;
    $fatura->refundable = $item->refundable;
    $fatura->installments = $item->installments;
    $fatura->transaction_number = $item->transaction_number;
    $fatura->payment_method = $item->payment_method;
    $fatura->financial_return_dates = $item->financial_return_dates;
    $fatura->bank_slip = $item->bank_slip;
    return $fatura;
}

function createIuguLog(){
    $iuguLog = new \models\IuguLogs();
    $iuguLog->setCodigo(0);
    $iuguLog->setData(new DateTime('now'));
    $iuguLog->setTipo("CON");
    $iuguLog->setUsuario(0);
    return $iuguLog;
}

function createIuguLogDet(IuguLogs $iuguLogs,$operacao,$status,$novoStatus){
    $iuguDet = new IuguLogsDetConsulta();
    $iuguDet->setCodigo(0);
    $iuguDet->setIlogCodigo($iuguLogs->getCodigo());
    $iuguDet->setOperacao($operacao);
    $iuguDet->setStatusAtual($status);
    $iuguDet->setStatusNovo($novoStatus);
    return $iuguDet;
}
