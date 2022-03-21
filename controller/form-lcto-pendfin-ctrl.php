<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
INCLUDE_once("./UserCtrl.php");
include_once '../database.php';
include_once "../phputils.php";
include_once("../boletophp/include/funcoes_sicredi.php");
include_once "../src/Enums/BancosBoleto.php";
include_once("IuguCtrl.php");
include_once("../src/models/Cliente.php");
include_once("../src/models/Municipio.php");
include_once("../src/models/Empresa.php");
include_once("../src/models/ConfGer.php");


// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\PendFin;
use models\PendFinBlt;
use models\Empresa;
use models\MovAntecipacao;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\PendFin";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-pendfin.php";


// #####################################################
// ##
// ##         IF Method Request Is "POST"
// ##
// #####################################################
/**
 * @param $entityManager
 * @param $transacao
 * @param $solicitadoAntecipacao
 * @param $dataLcto
 * @param $pfin_datavcto
 * @param $cliente
 * @param $numeroDcto
 * @param $parcela
 * @param $parcelas
 * @param $pfin_Valor
 * @param $usuario
 * @return PendFin
 */
function loadNewObjPendFin($entityManager, $transacao, $solicitadoAntecipacao, $pfin_datavcto, $cliente, $numeroDcto, $parcela, $parcelas, $pfin_Valor, $usuario)
{
    $operacao = Geral::getOperacao($entityManager);
    $pendfin = new PendFin();
    $pendfin->setCodigo(0);
    $pendfin->setTransacao($transacao);
    $pendfin->setOperacao($operacao);
    $pendfin->setStatus('P');
    $pendfin->setStatusAntecipacao("N");
    $pendfin->setTransacaoAntecipacao(null);
    if ($solicitadoAntecipacao) {
        $pendfin->setStatusAntecipacao("P");
        $pendfin->setTransacaoAntecipacao($pendfin->getTransacao());
    }
    $pendfin->setEnvEmail("N");
    if (strtoupper($_POST['pfin_enviaboletoemail']) == "ON") {
        $pendfin->setEnvEmail("S");
    }
    $pendfin->setTipo($_POST['tipoLcto']);
    $pendfin->setDataLcto(new DateTime('now'));
    $pendfin->setDataMvto(new DateTime($_POST['ed_pfin_datamvto']));
    $pendfin->setDataVcto($pfin_datavcto);
    $pendfin->setFpgtCodigo(0);
    $pendfin->setLpgtCodigo(0);
    $pendfin->setPortCodigo(0);
    $pendfin->setCatEntidade('C');
    $pendfin->setCodEntidade($cliente->getCodigo());
    $pendfin->setNumeroDcto($numeroDcto);
    $pendfin->setParcela($parcela);
    $pendfin->setNumParcelas($parcelas);
    $pendfin->setValor($pfin_Valor);
    $pendfin->setJuros(0.00);
    $pendfin->setMulta(0.00);
    $pendfin->setMora(0.00);
    $pendfin->setAcrescimos(0.00);
    $pendfin->setDescontos(0.00);
    $pendfin->setAbatimentos(0.00);
    $pendfin->setTxAdm(0.00);
    $pendfin->setCorrMonet(0.00);
    $pendfin->setTransBaixa('');
    $pendfin->setDataBaixa(null);
    $pendfin->setObservacao($_POST['ed_pfin_observacao']);
    $pendfin->setBanco($_POST['ed_bancocheque']);
    $pendfin->setAgencia($_POST['ed_agenciacheque']);
    $pendfin->setContaCorrente($_POST['ed_contacheque']);
    $pendfin->setNominalCheque($_POST['ed_nominalcheque']);
    $pendfin->setEmail($_POST['ed_clie_email']);
    $pendfin->setBoleto("N");
    $pendfin->setEmprCodigo($usuario->getEmpresa());
    $pendfin->setUsuaLcto($usuario->getCodigo());
    return $pendfin;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // #####################################################
    // ##
    // ##                  DELETE
    // ##
    // #####################################################
    if ($_POST['action'] == 'delete') {
        $result = "";
        try {
            $primariKey = $_POST['primarikey'];
            if ($primariKey > 0) {
                if ($entityManager != null) {
                    $entity = $entityManager->find($entityName, $primariKey);
                    if ($entity != null) {
                        $entityManager->remove($entity);
                        $entityManager->flush();
                        $result = "success";
                    } else {
                        $result = "Entidade Não Localizada";
                    }
                } else {
                    $result = "Erro ao Utilizar o Controlador de Entidades, Null";
                }
            } else {
                $result = "Chave da Entidade Zerada";
            }
        } catch (Exception $exception) {
            $result = $exception->getMessage();
        }
        echo $result;
    }


    // #####################################################
    // ##
    // ##               INSERT /or UPDATE
    // ##
    // #####################################################


    if ($_POST['action'] == 'insert') {
        $result = "Erro Desconhecido";
        $countSavePendFin = 0;
        try {
            if ($entityManager != null) {
                $parcelas = $_POST['ed_pfin_parcela'];
                $pfin_Valor = strToFloat($_POST['ed_pfin_valor']);
                $pfin_datavcto = new DateTime($_POST['ed_pfin_datavcto']);
                $solicitadoAntecipacao = strtoupper($_POST['pfin_statusantecipacao']) == "ON";
                $dataLcto = new DateTime('now');
                $numeroDcto = getValueNumeroDcto();
                $transacao = Geral::getTransacao($entityManager);

                $cliente = $entityManager->find("models\Cliente", $_POST['edCliente']);
                $municipio = $entityManager->find("models\Municipio", $cliente->getMuniCodigo());
                $confGer = $entityManager->find("models\ConfGer", 1);
                $usuario = ctrl\UserCtrl::getObjetoUsuario_Login();
                $empresa = getDadosEmpresa();

                $resultValidacaoInicial = "";
                $resultValidacao = "";
                if (validaDadosIniciais($cliente, $municipio, $confGer, $empresa, $resultValidacaoInicial)) {
                    uploadFile($transacao);
                    $movAntecipacao = null;
                    if ($solicitadoAntecipacao) {
                        $operacaoAntecipacao = Geral::getOperacao($entityManager);
                        $movAntecipacao = new MovAntecipacao($transacao, $operacaoAntecipacao, $dataLcto, $usuario->getEmpresa(), $pfin_Valor, $pfin_Valor, $usuario->getCodigo());
                    }
                    for ($parcela = 1; $parcela <= $parcelas; $parcela++) {
                        if ($resultValidacao != null && trim($resultValidacao) != "") {
                            break;
                        }
                        if ($parcelas > 1) {
                            $pfin_Valor = strToFloat($_POST['ed_parcela_' . $parcela]);
                            $pfin_datavcto = new DateTime($_POST['ed_vcto_' . $parcela]);
                        }
                        $pendfin = loadNewObjPendFin($entityManager, $transacao, $solicitadoAntecipacao, $pfin_datavcto, $cliente, $numeroDcto, $parcela, $parcelas, $pfin_Valor, $usuario);
                        $resultValidacao = $resultValidacao . validaDadosInsert($pendfin);
                        $erroPersistenciaIugu = false;
                        if ($resultValidacao == null || trim($resultValidacao) == "") {
                            $persistePendFin = true;
                            if ($pendfin->getTipo() == 1) {
                                $persistePendFin = false;
                                $pfbl = createPendFinBlt($pendfin, $_POST['ed_instrucao'], $entityManager, $cliente, $municipio, $confGer, $empresa);
                                $erroPersistenciaIugu = $pfbl->getStatusBco() == "E";
                                if (!$erroPersistenciaIugu || $countSavePendFin > 0) {
                                    $entityManager->persist($pfbl);
                                    $pendfin->setBoleto("S");
                                    $persistePendFin = true;
                                }
                                if ($erroPersistenciaIugu) {
                                    $resultValidacao = $resultValidacao . $pfbl->getErrors();
                                }
                            }
                            if ($persistePendFin) {
                                $entityManager->persist($pendfin);
                                $countSavePendFin = $countSavePendFin + 1;
                                if ($solicitadoAntecipacao && $movAntecipacao != null) {
                                    $entityManager->persist($movAntecipacao);
                                    $movAntecipacao = null;
                                }
                            }
                        }
                    }
                } else {
                    $resultValidacao = $resultValidacaoInicial;
                }
                if ($resultValidacao == null || trim($resultValidacao) == "") {
                    $entityManager->flush();
                    $result = "success:" . str_pad($transacao, 12, "0", STR_PAD_LEFT);
                } else {
                    $result = $resultValidacao;
                }
            } else {
                $resultValidacao = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        } catch (Exception $exception) {
            $result = "Exception: " . $exception->getMessage();
        }
        echo $result;
    }
}


// #####################################################
// ##
// ##               Funções
// ##
// #####################################################


function createPendFinBlt(PendFin $pendfin, $msgBlt, $entityManager, $cliente, $municipio, $confGer, $empresa)
{
    $pfbl = new PendFinBlt();
    $pfbl->setCodigo(0);
    $pfbl->setTransacao($pendfin->getTransacao());
    $pfbl->setOperacao($pendfin->getOperacao());
    $pfbl->setStatus('P');
    $pfbl->setDataLcto(new DateTime('now'));
    $pfbl->setDataVcto($pendfin->getDataVcto());
    $pfbl->setValor($pendfin->getValor());
    $pfbl->setDataBaixa(null);
    $pfbl->setNossoNumero(Geral::getNossoNumero($entityManager));
    $pfbl->setNossoNumeroBlt('');
    $pfbl->setCodigoBarras('');
    $pfbl->setLinhaDigitavel('');
    $pfbl->setAutenticacao('');
    $pfbl->setProtocolo('');
    $pfbl->setStatusBco('P');
    $pfbl->setMsgBlt($msgBlt);
    if (Geral::$BANC_BLT == \Enums\BancosBoleto::SICREDI) {
        geraDadosBoletoSicredi($pendfin, $pfbl);
    } else if (Geral::$BANC_BLT == \Enums\BancosBoleto::IUGU) {
        geraDadosBoletoIugu($entityManager, $pendfin, $pfbl, $cliente, $municipio, $confGer, $empresa);
    }
    return $pfbl;
}

function geraDadosBoletoIugu($entityManager, PendFin $pendfin, PendFinBlt $pendFinBlt, $cliente, $municipio, $confGer, $empresa)
{
    $pendFinBlt->setCodigoBarras("");
    $pendFinBlt->setLinhaDigitavel("");
    $pendFinBlt->setNossoNumeroBlt("");
    $pendFinBlt->setBanco(\Enums\BancosBoleto::toStringSigla(Geral::$BANC_BLT));
    $pendFinBlt->setStatusExp('P');
    $pendFinBlt->setStatusBco('');
    $pendFinBlt->setLoteExp(0);

    $descricaoBoleto = montaDadosDescricao($empresa, $pendfin, $confGer);

    $numDiasVcto = $pendfin->getDataLcto()->diff($pendfin->getDataVcto())->format("%a");
    $numDiasVcto = $numDiasVcto + 1;
    $resultIugu = executeGeracaoBltIugu($cliente, $municipio, $pendfin->getOperacao(), $numDiasVcto, $pendfin->getValor(), $descricaoBoleto, $pendfin->getDataMvto());
    if ($resultIugu->isSuccess()) {
        $pendFinBlt->setStatusBco('P');
        $pendFinBlt->setErrors('');
        $pendFinBlt->setPdf($resultIugu->getPdf());
        $pendFinBlt->setInvoiceId($resultIugu->getInvoiceId());
        $pendFinBlt->setIdentification($resultIugu->getIdentification());
        $pendFinBlt->setUrl($resultIugu->getUrl());
    } else {
        $pendFinBlt->setStatusBco('E');
        $pendFinBlt->setErrors($resultIugu->getErrors());
    }
}

function geraDadosBoletoSicredi(PendFin $pendfin, PendFinBlt $pendFinBlt)
{

    $valor_cobrado = $pendfin->getValor(); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
    $valor_cobrado = str_replace(",", ".", $valor_cobrado);
    $valor_boleto = number_format($valor_cobrado, 2, ',', '');

    $dadosboleto["inicio_nosso_numero"] = date("y");          // Ano da gera��o do t�tulo ex: 07 para 2007
    $dadosboleto["nosso_numero"] = $pendFinBlt->getNossoNumero(); // Nosso numero (m�x. 5 digitos) - Numero sequencial de controle.
    $dadosboleto["numero_documento"] = $pendfin->getOperacao();      // Num do pedido ou do documento
    $dadosboleto["data_vencimento"] = date("d/m/Y", $pendfin->getDataVcto()->getTimesTamp());                 // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
    $dadosboleto["data_documento"] = date("d/m/Y", $pendfin->getDataMvto()->getTimesTamp());     // Data de emiss�o do Boleto
    $dadosboleto["data_processamento"] = date("d/m/Y", $pendfin->getDataMvto()->getTimesTamp());  // Data de processamento do boleto (opcional)
    $dadosboleto["valor_boleto"] = $valor_boleto;                  // Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //

    // DADOS DA SUA CONTA - SICREDI
    $dadosboleto["agencia"] = "0737";    // Num da agencia (4 digitos), sem Digito Verificador
    $dadosboleto["conta"] = "39164";    // Num da conta (5 digitos), sem Digito Verificador
    $dadosboleto["conta_dv"] = "6";    // Digito Verificador do Num da conta

    // DADOS PERSONALIZADOS - SICREDI
    $dadosboleto["posto"] = "10";      // C�digo do posto da cooperativa de cr�dito
    $dadosboleto["byte_idt"] = "2";      // Byte de identifica��o do cedente do bloqueto utilizado para compor o nosso n�mero.
    // 1 - Idtf emitente: Cooperativa | 2 a 9 - Idtf emitente: Cedente
    $dadosboleto["carteira"] = "A";   // C�digo da Carteira: A (Simples)

    //Executa Calculos dos Dados do Boleto
    $dadosboleto = executeCalculosCompoemDadosBco($dadosboleto);

    //Retornar os dados Calculados para Gravação
    $pendFinBlt->setCodigoBarras($dadosboleto["codigo_barras"]);
    $pendFinBlt->setLinhaDigitavel($dadosboleto["linha_digitavel"]);
    $pendFinBlt->setNossoNumeroBlt($dadosboleto["nosso_numero"]);
    $pendFinBlt->setBanco(\Enums\BancosBoleto::toStringSigla(Geral::$BANC_BLT));
    $pendFinBlt->setStatusExp('P');
    $pendFinBlt->setStatusBco('P');
    $pendFinBlt->setLoteExp(0);
}

function getValueNumeroDcto()
{
    $result = "";
    if ($_POST['ed_pfin_numerodcto1'] != null && trim($_POST['ed_pfin_numerodcto1']) != "") {
        $result = addValueSep($result, trim($_POST['ed_pfin_numerodcto1']));
    }
    // if ($_POST['ed_pfin_numerodcto2'] != null && trim($_POST['ed_pfin_numerodcto2']) != "") {
    //     $result = addValueSep($result, trim($_POST['ed_pfin_numerodcto2']));
    // }
    // if ($_POST['ed_pfin_numerodcto3'] != null && trim($_POST['ed_pfin_numerodcto3']) != "") {
    //     $result = addValueSep($result, trim($_POST['ed_pfin_numerodcto3']));
    // }
    // if ($_POST['ed_pfin_numerodcto4'] != null && trim($_POST['ed_pfin_numerodcto4']) != "") {
    //     $result = addValueSep($result, trim($_POST['ed_pfin_numerodcto4']));
    // }
    return $result;
}

function addValueSep($result, $valueAdd)
{
    if ($result != null && $result != "") {
        $result = $result . ',';
    }
    $result = $result . $valueAdd;
    return $result;
}

function getDadosEmpresa()
{
    try {
        return ctrl\UserCtrl::getObjetoEmpresa_Login();
    } catch (Exception $exception) {
    } catch (Error $error) {
    }
}

function montaDadosDescricao($empresa, PendFin $pendfin, $confGer)
{
    $text = "";
    if ($confGer != null) {
        $text = $confGer->getTextoboleto();
        $text = executeConversaoTagsDadosBoletos($text, $pendfin, $empresa);
    }
    return $text;
}

function executeConversaoTagsDadosBoletos($text, PendFin $pendfin, Empresa $empresa)
{
    //#DataMvto;  #DataVcto;  #Empresa.Nome;  #Empresa.CNPJ; #NumParcelas; #Parcela; #NumeroDcto; #DataLcto;
    if ($text != null && strpos($text, '#') !== false) {
        if ($pendfin != null) {
            if (strpos(strtoupper($text), '#NUMERODCTO') !== false) {
                $text = str_ireplace('#NumeroDcto', $pendfin->getNumeroDcto(), $text);
            }
            if (strpos(strtoupper($text), '#PARCELA') !== false) {
                $text = str_ireplace('#Parcela', $pendfin->getParcela(), $text);
            }
            if (strpos(strtoupper($text), '#NUMPARCELAS') !== false) {
                $text = str_ireplace('#NumParcelas', $pendfin->getNumParcelas(), $text);
            }
            if (strpos(strtoupper($text), '#DATALCTO') !== false) {
                $text = str_ireplace('#DataLcto', $pendfin->getDataLcto()->format("d/m/Y"), $text);
            }
            if (strpos(strtoupper($text), '#DATAMVTO') !== false) {
                $text = str_ireplace('#DataMvto', $pendfin->getDataMvto()->format("d/m/Y"), $text);
            }
            if (strpos(strtoupper($text), '#DATAVCTO') !== false) {
                $text = str_ireplace('#DataVcto', $pendfin->getDataVcto()->format("d/m/Y"), $text);
            }
        }
        if ($empresa != null) {
            if (strpos(strtoupper($text), '#EMPRESA.NOME') !== false) {
                $text = str_ireplace('#Empresa.Nome', $empresa->getNome(), $text);
            }
            if (strpos(strtoupper($text), '#EMPRESA.CNPJ') !== false) {
                $text = str_ireplace('#Empresa.CNPJ', $empresa->getCnpj(), $text);
            }
        }
        //ZeraCampos
        $text = str_ireplace('#DataMvto', "", $text);
        $text = str_ireplace('#DataVcto', "", $text);
        $text = str_ireplace('#DataLcto', "", $text);
        $text = str_ireplace('#NumeroDcto', "", $text);
        $text = str_ireplace('#Parcela', "", $text);
        $text = str_ireplace('#NumParcelas', "", $text);
        $text = str_ireplace('#Empresa.Nome', "", $text);
        $text = str_ireplace('#Empresa.CNPJ', "", $text);
    }
    return $text;
}

function validaDadosIniciais($cliente, $municipio, $confGer, $empresa, &$result)
{
    $result = "";
    if ($cliente == null || $cliente->getCodigo() == 0) {
        $result = "Falha ao Carregar Dados do Cliente";
    }
    if ($municipio == null || $municipio->getCodigo() == 0) {
        $result = "Falha ao Carregar Dados do Município";
    }
    if ($confGer == null || $confGer->getCodigo() == 0) {
        $result = "Falha ao Carregar Dados de Configurações";
    }
    if ($empresa == null || $empresa->getCodigo() == 0) {
        $result = "Falha ao Carregar Dados da Empresa";
    }
    return $result == "";
}

// #####################################################
// ##
// ##               Upload Arquivos
// ##
// #####################################################

function uploadFile($transacao)
{
    $allowedTypes = array(
        'image/png',
        'image/gif',
        'image/jpeg',
        'image/bmp',
        'image/tiff',
        'application/zip',
        'text/plain',
        'application/xml',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel'
    );

    $useFiles = array();

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    foreach ($_FILES as $index => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $type = $finfo->file($file['tmp_name']);
            if (in_array($type, $allowedTypes)) {
                $useFiles[$index] = $file;
            }
        }
    }

    //$data = array();

    if (isset($useFiles) && (sizeof($useFiles) > 0)) {
        $error = false;
        $files = array();

        $uploaddir = '../uploads/' . $transacao;
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        $uploaddir = $uploaddir . '/';

        foreach ($useFiles as $file) {
            if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
                $files[] = $uploaddir . $file['name'];
            } else {
                $error = true;
            }
        }
        //$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
    } else {
        //$data = array('success' => 'Form was submitted', 'formData' => $_POST);
    }
    return $error;
}


// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsert(Pendfin $pendFin)
{
    $msgDefault = null;
    if ($pendFin == null) {
        return $msgDefault . "<br> Dados do Movimento Inválido, Null";
    }
    if ($pendFin->getStatus() == null || ($pendFin->getStatus() != "P" && $pendFin->getStatus() != "B")) {
        return $msgDefault . "<br> Status inválido";
    }
    if ($pendFin->getValor() <= 0) {
        return $msgDefault . "<br> Valor Inválido";
    }
    if ($pendFin->getCodEntidade() <= 0) {
        return $msgDefault . "<br> Entidade Inválida";
    }
    if ($pendFin->getDataLcto()->diff($pendFin->getDataVcto())->format("%a") < 0) {
        return $msgDefault . "<br> Data de Vencimento Deve ser superior a data atual";
    }
    if ($msgDefault != null) {
        $msgDefault = "Validação de Dados: " . $msgDefault;
        return $msgDefault;
    }
    return "";
}
