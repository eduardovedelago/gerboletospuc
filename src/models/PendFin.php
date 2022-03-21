<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 26/01/2018
 * Time: 11:54
 */

namespace models;

/**
 * Class PendFin
 * @package DevSoft\Models
 * @Entity
 * @Table(name="PendFin",indexes={
 *     @Index(name="pfin_transacao_idx", columns={"pfin_transacao"}),
 *     @Index(name="pfin_operacao_idx", columns={"pfin_operacao"}),
 *     @Index(name="pfin_transbaixa_idx", columns={"pfin_transBaixa"}),
 *     @Index(name="pfin_transantecip_idx", columns={"pfin_transAntecip"})
 * })
 **/
class PendFin
{

    /*
    * -----------------------------------------------------------
    *  ####                  Atributos
    * -----------------------------------------------------------
    */

    /**
     * @Id
     * @Column(type="integer", name="pfin_id", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     * @SequenceGenerator(sequenceName="pfin_operacao_seq", initialValue=5000, allocationSize=1)
     * @Column(type="bigint", name="pfin_operacao", length=20, nullable=false)
     */
    protected $operacao;

    /**
     ** @SequenceGenerator(sequenceName="pfin_transacao_seq", initialValue=5000, allocationSize=1)
     ** @Column(type="bigint", name="pfin_transacao", length=20, nullable=false)
     */
    protected $transacao;

    /**
     ** @Column(type="string", name="pfin_status", length=1, nullable=false)
     */
    protected $status;
    /**
     ** @Column(type="string", name="pfin_tipo", length=1, nullable=false)
     */
    protected $tipo;
    /**
     ** @Column(type="date", name="pfin_dataLcto", nullable=false)
     */
    protected $dataLcto;
    /**
     ** @Column(type="string", name="pfin_boleto", length=1)
     */
    protected $boleto;
    /**
     ** @Column(type="string", name="pfin_statusAntecipacao", length=1)
     *///N - Antecipação Não Solicitada - P - Antecipação Pendênte de Análise - A - Antecipação Aprovada Aguardando Repasse - E - Antecipação Efetuada - R - Antecipação Rejeitada
    protected $statusAntecipacao;
    /**
     ** @Column(type="bigint", name="pfin_transAntecip", length=20, nullable=true)
     */
    protected $transacaoAntecipacao;
    /**
     ** @Column(type="bigint", name="pfin_transAvaliacaoAntecip", length=20, nullable=true)
     */
    protected $transacaoAvaliacaoAntecipacao;
    /**
     ** @Column(type="date", name="pfin_dataMvto", nullable=false)
     */
    protected $dataMvto;
    /**
     ** @Column(type="date", name="pfin_dataVcto", nullable=false)
     */
    protected $dataVcto;
    /**
     ** @Column(type="integer", name="pfin_empr_codigo", nullable=false)
     */
    protected $empr_Codigo;
    /**
     * @Column(type="integer", name="pfin_fpgt_codigo", nullable=true)
     */
    protected $fpgt_Codigo;
    /**
     * @Column(type="integer", name="pfin_lpgt_codigo", nullable=true)
     */
    protected $lpgt_Codigo;
    /**
     * @Column(type="integer", name="pfin_port_codigo", nullable=true)
     */
    protected $port_Codigo;
    /**
     * @Column(type="string", name="pfin_catEntidade", length=1, nullable=true)
     */
    protected $catEntidade;
    /**
     * @Column(type="integer", name="pfin_codEntidade", length=10, nullable=true)
     */
    protected $codEntidade;
    /**
     * @Column(type="string", name="pfin_numeroDcto", length=100, nullable=true)
     */
    protected $numeroDcto;
    /**
     * @Column(type="smallint", name="pfin_parcela", nullable=true)
     */
    protected $parcela;
    /**
     * @Column(type="smallint", name="pfin_numParcelas", nullable=true)
     */
    protected $numParcelas;
    /**
     * @Column(type="float", name="pfin_valor", nullable=false)
     */
    protected $valor;
    /**
     * @Column(type="float", name="pfin_juros", nullable=true)
     */
    protected $juros;
    /**
     * @Column(type="float", name="pfin_multa", nullable=true)
     */
    protected $multa;
    /**
     * @Column(type="float", name="pfin_mora", nullable=true)
     */
    protected $mora;
    /**
     * @Column(type="float", name="pfin_acrescimos", nullable=true)
     */
    protected $acrescimos;
    /**
     * @Column(type="float", name="pfin_descontos", nullable=true)
     */
    protected $descontos;
    /**
     * @Column(type="float", name="pfin_abatimentos", nullable=true)
     */
    protected $abatimentos;
    /**
     * @Column(type="float", name="pfin_txadm", nullable=true)
     */
    protected $txAdm;
    /**
     * @Column(type="float", name="pfin_corrMonet", nullable=true)
     */
    protected $corrMonet;
    /**
     ** @Column(type="string", name="pfin_transBaixa", length=15, nullable=true)
     */
    protected $transBaixa;
    /**
     ** @Column(type="date", name="pfin_dataBaixa", nullable=true)
     */
    protected $dataBaixa;
    /**
     ** @Column(type="integer", name="pfin_usuaBaixa", nullable=true)
     */
    protected $usuaBaixa;
    /**
     ** @Column(type="date", name="pfin_dataCanc", nullable=true)
     */
    protected $dataCanc;
    /**
     ** @Column(type="integer", name="pfin_usuaCanc", nullable=true)
     */
    protected $usuaCanc;
    /**
     ** @Column(type="integer", name="pfin_usuaLcto", nullable=true)
     */
    protected $usuaLcto;
    /**
     ** @Column(type="string", name="pfin_observacao", length=200, nullable=true)
     */
    protected $observacao;
    /**
     ** @Column(type="string", name="pfin_banco", length=4, nullable=true)
     */
    protected $banco;
    /**
     ** @Column(type="string", name="pfin_agencia", length=10, nullable=true)
     */
    protected $agencia;
    /**
     ** @Column(type="string", name="pfin_contaCorrente", length=20, nullable=true)
     */
    protected $contaCorrente;

    /**
     ** @Column(type="string", name="pfin_nominalCheque", length=150, nullable=true)
     */
    protected $nominalCheque;
    /**
     ** @Column(type="string", name="pfin_email", length=150, nullable=true)
     */
    protected $email;
    /**
     ** @Column(type="string", name="pfin_$envEmail", length=1, nullable=true)
     */
    protected $envEmail;
    /**
     ** @Column(type="string", name="pfin_cobranca", length=1, nullable=true)
     */
    protected $cobranca;
    /**
     ** @Column(type="string", name="pfin_baixamanual", length=1, nullable=true)
     */
    protected $baixaManual;
    /**
     ** @Column(type="string", name="pfin_motivoBaixa", length=100, nullable=true)
     */
    protected $motivoBaixa;


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
    public function getDataMvto()
    {
        return $this->dataMvto;
    }

    /**
     * @param mixed $dataMvto
     */
    public function setDataMvto($dataMvto)
    {
        $this->dataMvto = $dataMvto;
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
    public function getEmprCodigo()
    {
        return $this->empr_Codigo;
    }

    /**
     * @param mixed $empr_Codigo
     */
    public function setEmprCodigo($empr_Codigo)
    {
        $this->empr_Codigo = $empr_Codigo;
    }

    /**
     * @return mixed
     */
    public function getFpgtCodigo()
    {
        return $this->fpgt_Codigo;
    }

    /**
     * @param mixed $fpgt_Codigo
     */
    public function setFpgtCodigo($fpgt_Codigo)
    {
        $this->fpgt_Codigo = $fpgt_Codigo;
    }

    /**
     * @return mixed
     */
    public function getLpgtCodigo()
    {
        return $this->lpgt_Codigo;
    }

    /**
     * @param mixed $lpgt_Codigo
     */
    public function setLpgtCodigo($lpgt_Codigo)
    {
        $this->lpgt_Codigo = $lpgt_Codigo;
    }

    /**
     * @return mixed
     */
    public function getPortCodigo()
    {
        return $this->port_Codigo;
    }

    /**
     * @param mixed $port_Codigo
     */
    public function setPortCodigo($port_Codigo)
    {
        $this->port_Codigo = $port_Codigo;
    }

    /**
     * @return mixed
     */
    public function getCatEntidade()
    {
        return $this->catEntidade;
    }

    /**
     * @param mixed $catEntidade
     */
    public function setCatEntidade($catEntidade)
    {
        $this->catEntidade = $catEntidade;
    }

    /**
     * @return mixed
     */
    public function getCodEntidade()
    {
        return $this->codEntidade;
    }

    /**
     * @param mixed $codEntidade
     */
    public function setCodEntidade($codEntidade)
    {
        $this->codEntidade = $codEntidade;
    }

    /**
     * @return mixed
     */
    public function getNumeroDcto()
    {
        return $this->numeroDcto;
    }

    /**
     * @param mixed $numeroDcto
     */
    public function setNumeroDcto($numeroDcto)
    {
        $this->numeroDcto = $numeroDcto;
    }

    /**
     * @return mixed
     */
    public function getParcela()
    {
        return $this->parcela;
    }

    /**
     * @param mixed $parcela
     */
    public function setParcela($parcela)
    {
        $this->parcela = $parcela;
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
    public function getJuros()
    {
        return $this->juros;
    }

    /**
     * @param mixed $juros
     */
    public function setJuros($juros)
    {
        $this->juros = $juros;
    }

    /**
     * @return mixed
     */
    public function getMulta()
    {
        return $this->multa;
    }

    /**
     * @param mixed $multa
     */
    public function setMulta($multa)
    {
        $this->multa = $multa;
    }

    /**
     * @return mixed
     */
    public function getMora()
    {
        return $this->mora;
    }

    /**
     * @param mixed $mora
     */
    public function setMora($mora)
    {
        $this->mora = $mora;
    }

    /**
     * @return mixed
     */
    public function getAcrescimos()
    {
        return $this->acrescimos;
    }

    /**
     * @param mixed $acrescimos
     */
    public function setAcrescimos($acrescimos)
    {
        $this->acrescimos = $acrescimos;
    }

    /**
     * @return mixed
     */
    public function getDescontos()
    {
        return $this->descontos;
    }

    /**
     * @param mixed $descontos
     */
    public function setDescontos($descontos)
    {
        $this->descontos = $descontos;
    }

    /**
     * @return mixed
     */
    public function getAbatimentos()
    {
        return $this->abatimentos;
    }

    /**
     * @param mixed $abatimentos
     */
    public function setAbatimentos($abatimentos)
    {
        $this->abatimentos = $abatimentos;
    }

    /**
     * @return mixed
     */
    public function getTxAdm()
    {
        return $this->txAdm;
    }

    /**
     * @param mixed $txAdm
     */
    public function setTxAdm($txAdm)
    {
        $this->txAdm = $txAdm;
    }

    /**
     * @return mixed
     */
    public function getCorrMonet()
    {
        return $this->corrMonet;
    }

    /**
     * @param mixed $corrMonet
     */
    public function setCorrMonet($corrMonet)
    {
        $this->corrMonet = $corrMonet;
    }

    /**
     * @return mixed
     */
    public function getTransBaixa()
    {
        return $this->transBaixa;
    }

    /**
     * @param mixed $transBaixa
     */
    public function setTransBaixa($transBaixa)
    {
        $this->transBaixa = $transBaixa;
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
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
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
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * @param mixed $agencia
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
    }

    /**
     * @return mixed
     */
    public function getContaCorrente()
    {
        return $this->contaCorrente;
    }

    /**
     * @param mixed $contaCorrente
     */
    public function setContaCorrente($contaCorrente)
    {
        $this->contaCorrente = $contaCorrente;
    }

    /**
     * @return mixed
     */
    public function getNominalCheque()
    {
        return $this->nominalCheque;
    }

    /**
     * @param mixed $nominalCheque
     */
    public function setNominalCheque($nominalCheque)
    {
        $this->nominalCheque = $nominalCheque;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getNumParcelas()
    {
        return $this->numParcelas;
    }

    /**
     * @param mixed $numParcelas
     */
    public function setNumParcelas($numParcelas)
    {
        $this->numParcelas = $numParcelas;
    }

    /**
     * @return mixed
     */
    public function getBoleto()
    {
        return $this->boleto;
    }

    /**
     * @param mixed $boleto
     */
    public function setBoleto($boleto)
    {
        $this->boleto = $boleto;
    }

    /**
     * @return mixed
     */
    public function getStatusAntecipacao()
    {
        return $this->statusAntecipacao;
    }

    /**
     * @param mixed $statusAntecipacao
     */
    public function setStatusAntecipacao($statusAntecipacao)
    {
        $this->statusAntecipacao = $statusAntecipacao;
    }

    /**
     * @return mixed
     */
    public function getEnvEmail()
    {
        return $this->envEmail;
    }

    /**
     * @param mixed $envEmail
     */
    public function setEnvEmail($envEmail)
    {
        $this->envEmail = $envEmail;
    }

    /**
     * @return mixed
     */
    public function getTransacaoAntecipacao()
    {
        return $this->transacaoAntecipacao;
    }

    /**
     * @param mixed $transacaoAntecipacao
     */
    public function setTransacaoAntecipacao($transacaoAntecipacao)
    {
        $this->transacaoAntecipacao = $transacaoAntecipacao;
    }

    /**
     * @return mixed
     */
    public function getDataCanc()
    {
        return $this->dataCanc;
    }

    /**
     * @param mixed $dataCanc
     */
    public function setDataCanc($dataCanc)
    {
        $this->dataCanc = $dataCanc;
    }

    /**
     * @return mixed
     */
    public function getUsuaCanc()
    {
        return $this->usuaCanc;
    }

    /**
     * @param mixed $usuaCanc
     */
    public function setUsuaCanc($usuaCanc)
    {
        $this->usuaCanc = $usuaCanc;
    }

    /**
     * @return mixed
     */
    public function getUsuaLcto()
    {
        return $this->usuaLcto;
    }

    /**
     * @param mixed $usuaLcto
     */
    public function setUsuaLcto($usuaLcto)
    {
        $this->usuaLcto = $usuaLcto;
    }

    /**
     * @return mixed
     */
    public function getTransacaoAvaliacaoAntecipacao()
    {
        return $this->transacaoAvaliacaoAntecipacao;
    }

    /**
     * @param mixed $transacaoAvaliacaoAntecipacao
     */
    public function setTransacaoAvaliacaoAntecipacao($transacaoAvaliacaoAntecipacao)
    {
        $this->transacaoAvaliacaoAntecipacao = $transacaoAvaliacaoAntecipacao;
    }

    /**
     * @return mixed
     */
    public function getCobranca()
    {
        return $this->cobranca;
    }

    /**
     * @param mixed $cobranca
     */
    public function setCobranca($cobranca)
    {
        $this->cobranca = $cobranca;
    }

    /**
     * @return mixed
     */
    public function getBaixaManual()
    {
        return $this->baixaManual;
    }

    /**
     * @param mixed $baixaManual
     */
    public function setBaixaManual($baixaManual)
    {
        $this->baixaManual = $baixaManual;
    }

    /**
     * @return mixed
     */
    public function getUsuaBaixa()
    {
        return $this->usuaBaixa;
    }

    /**
     * @param mixed $usuaBaixa
     */
    public function setUsuaBaixa($usuaBaixa)
    {
        $this->usuaBaixa = $usuaBaixa;
    }

    /**
     * @return mixed
     */
    public function getMotivoBaixa()
    {
        return $this->motivoBaixa;
    }

    /**
     * @param mixed $motivoBaixa
     */
    public function setMotivoBaixa($motivoBaixa)
    {
        $this->motivoBaixa = $motivoBaixa;
    }

}