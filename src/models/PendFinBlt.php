<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 26/01/2018
 * Time: 11:54
 */

namespace models;

use Doctrine\ORM\Mapping\Index;

/**
 * Class PendFinBlt
 * @package DevSoft\Models
 * @Entity
 * @Table(name="PendFinBlt",indexes={
 *     @Index(name="pblt_invoice_id_idx", columns={"pblt_invoice_id"}),
 *     @Index(name="pblt_transacao_idx", columns={"pblt_transacao"}),
 *     @Index(name="pblt_operacao_idx", columns={"pblt_operacao"})*
 * })
 **/
class PendFinBlt
{

    /*
    * -----------------------------------------------------------
    *  ####                  Atributos
    * -----------------------------------------------------------
    */

    /**
     * @Id
     * @Column(type="integer", name="pblt_id", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="bigint", name="pblt_transacao", length=20, nullable=false)
     */
    protected $transacao;
    /**
     ** @Column(type="bigint", name="pblt_operacao", length=20, nullable=false)
     */
    protected $operacao;
    /**
     ** @Column(type="string", name="pblt_status", length=1, nullable=false)
     */
    protected $status;
    /**
     ** @Column(type="date", name="pblt_dataLcto", nullable=false)
     */
    protected $dataLcto;
    /**
     ** @Column(type="date", name="pblt_dataVcto", nullable=false)
     */
    protected $dataVcto;
    /**
     * @Column(type="float", name="pblt_valor", nullable=false)
     */
    protected $valor;
    /**
     ** @Column(type="date", name="pblt_dataBaixa", nullable=true)
     */
    protected $dataBaixa;
    /**
     * @SequenceGenerator(sequenceName="pblt_nossoNumero_seq", initialValue=5000, allocationSize=1)
     * @Column(type="string", name="pblt_nossoNumero", length=50, nullable=true)
     */
    protected $nossoNumero;
    /**
     * @Column(type="string", name="pblt_nossoNumeroBlt", length=50, nullable=true)
     */
    protected $nossoNumeroBlt;
    /**
     * @Column(type="string", name="pblt_codigoBarras", length=200, nullable=true)
     */
    protected $codigoBarras;
    /**
     * @Column(type="string", name="pblt_linhaDigitavel", length=200, nullable=true)
     */
    protected $linhaDigitavel;
    /**
     * @Column(type="string", name="pblt_autenticacao", length=100, nullable=true)
     */
    protected $autenticacao;
    /**
     * @Column(type="string", name="pblt_protocolo", length=100, nullable=true)
     */
    protected $protocolo;
    /**
     * @Column(type="string", name="pblt_statusBco", length=100, nullable=true)
     */
    protected $statusBco;

    /**
     * @Column(type="string", name="pblt_msgBlt", length=300, nullable=true)
     */
    protected $msgBlt;

    /**
     * @Column(type="string", name="pblt_banco", length=3, nullable=true)
     */
    protected $banco;

    /**
     * @Column(type="string", name="pblt_statusExp", length=1, nullable=true)
     */
    protected $statusExp;

    /**
     * @Column(type="bigint", name="pblt_loteExp", length=1, nullable=true)
     */
    protected $loteExp;

    /**
     * @Column(type="string", name="pblt_errors", length=2000, nullable=true)
     */
    protected $errors = "";
    /**
     * @Column(type="string", name="pblt_url", length=500, nullable=true)
     */
    protected $url = "";
    /**
     * @Column(type="string", name="pblt_pdf", length=500, nullable=true)
     */
    protected $pdf = "";
    /**
     * @Column(type="string", name="pblt_identification", length=100, nullable=true)
     */
    protected $identification = "";
    /**
     * @Column(type="string", name="pblt_invoice_id", length=100, nullable=true)
     */
    protected $invoice_id = "";

    /*
     * -----------------------------------------------------------
     *  ####             Getters And Setters
     * -----------------------------------------------------------
     */

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getTransacao()
    {
        return $this->transacao;
    }

    /**
     * @param mixed $transacao
     */
    public function setTransacao($transacao)
    {
        $this->transacao = $transacao;
    }

    /**
     * @return mixed
     */
    public function getOperacao()
    {
        return $this->operacao;
    }

    /**
     * @param mixed $operacao
     */
    public function setOperacao($operacao)
    {
        $this->operacao = $operacao;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDataLcto()
    {
        return $this->dataLcto;
    }

    /**
     * @param mixed $dataLcto
     */
    public function setDataLcto($dataLcto)
    {
        $this->dataLcto = $dataLcto;
    }

    /**
     * @return mixed
     */
    public function getDataVcto()
    {
        return $this->dataVcto;
    }

    /**
     * @param mixed $dataVcto
     */
    public function setDataVcto($dataVcto)
    {
        $this->dataVcto = $dataVcto;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getDataBaixa()
    {
        return $this->dataBaixa;
    }

    /**
     * @param mixed $dataBaixa
     */
    public function setDataBaixa($dataBaixa)
    {
        $this->dataBaixa = $dataBaixa;
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }

    /**
     * @param mixed $nossoNumero
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
    }

    /**
     * @return mixed
     */
    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    /**
     * @param mixed $codigoBarras
     */
    public function setCodigoBarras($codigoBarras)
    {
        $this->codigoBarras = $codigoBarras;
    }

    /**
     * @return mixed
     */
    public function getLinhaDigitavel()
    {
        return $this->linhaDigitavel;
    }

    /**
     * @param mixed $linhaDigitavel
     */
    public function setLinhaDigitavel($linhaDigitavel)
    {
        $this->linhaDigitavel = $linhaDigitavel;
    }

    /**
     * @return mixed
     */
    public function getAutenticacao()
    {
        return $this->autenticacao;
    }

    /**
     * @param mixed $autenticacao
     */
    public function setAutenticacao($autenticacao)
    {
        $this->autenticacao = $autenticacao;
    }

    /**
     * @return mixed
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * @param mixed $protocolo
     */
    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }

    /**
     * @return mixed
     */
    public function getStatusBco()
    {
        return $this->statusBco;
    }

    /**
     * @param mixed $statusBco
     */
    public function setStatusBco($statusBco)
    {
        $this->statusBco = $statusBco;
    }

    /**
     * @return mixed
     */
    public function getMsgBlt()
    {
        return $this->msgBlt;
    }

    /**
     * @param mixed $msgBlt
     */
    public function setMsgBlt($msgBlt)
    {
        $this->msgBlt = $msgBlt;
    }

    /**
     * @return mixed
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @param mixed $banco
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;
    }

    /**
     * @return mixed
     */
    public function getStatusExp()
    {
        return $this->statusExp;
    }

    /**
     * @param mixed $statusExp
     */
    public function setStatusExp($statusExp)
    {
        $this->statusExp = $statusExp;
    }

    /**
     * @return mixed
     */
    public function getLoteExp()
    {
        return $this->loteExp;
    }

    /**
     * @param mixed $loteExp
     */
    public function setLoteExp($loteExp)
    {
        $this->loteExp = $loteExp;
    }

    /**
     * @return mixed
     */
    public function getNossoNumeroBlt()
    {
        return $this->nossoNumeroBlt;
    }

    /**
     * @param mixed $nossoNumeroBlt
     */
    public function setNossoNumeroBlt($nossoNumeroBlt)
    {
        $this->nossoNumeroBlt = $nossoNumeroBlt;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param mixed $pdf
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return mixed
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param mixed $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }
}