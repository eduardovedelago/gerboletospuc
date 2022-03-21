<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class MovLctos
 * @package DevSoft\Models
 * @Entity @Table(name="MovLctos")
 *
 **/

class MovLctos
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="mlct_id", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="string", name="mlct_transacao", length=15, nullable=false)
     */
    protected $transacao;
    /**
     ** @Column(type="string", name="mlct_operacao", length=20, nullable=false)
     */
    protected $operacao;
    /**
     ** @Column(type="string", name="mlct_status", length=1, nullable=false)
     */
    protected $status;
    /**
     ** @Column(type="date", name="mlct_dataLcto", nullable=false)
     */
    protected $dataLcto;
    /**
     ** @Column(type="integer", name="pfin_empr_codigo", nullable=false)
     */
    protected $empr_Codigo;
    /**
     ** @Column(type="string", name="mlct_tipoLcto", length=4, nullable=false)
     */
    protected $tipoLcto;
    /**
     ** @Column(type="float", name="mlct_valor", nullable=false)
     */
    protected $valor;
    /**
     ** @Column(type="integer", name="mlct_usuaLcto", nullable=false)
     */
    protected $usuaLcto;
    /**
     ** @Column(type="integer", name="mlct_usuaCanc", nullable=true)
     */
    protected $usuaCanc;
    /**
     ** @Column(type="datetime", name="mlct_dataHoraCanc", nullable=true)
     */
    protected $dataHoraCanc;
    /**
     ** @Column(type="string", name="mlct_versao", length=10, nullable=false)
     */
    protected $versao;

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
    public function getTipoLcto()
    {
        return $this->tipoLcto;
    }

    /**
     * @param mixed $tipoLcto
     */
    public function setTipoLcto($tipoLcto)
    {
        $this->tipoLcto = $tipoLcto;
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
    public function getDataHoraCanc()
    {
        return $this->dataHoraCanc;
    }

    /**
     * @param mixed $dataHoraCanc
     */
    public function setDataHoraCanc($dataHoraCanc)
    {
        $this->dataHoraCanc = $dataHoraCanc;
    }

    /**
     * @return mixed
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * @param mixed $versao
     */
    public function setVersao($versao)
    {
        $this->versao = $versao;
    }
    
}