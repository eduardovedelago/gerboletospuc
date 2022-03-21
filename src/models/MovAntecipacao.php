<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class MovAntecipacao
 * @package DevSoft\Models
 * @Entity @Table(name="MovAntecipacao")
 *
 **/

class MovAntecipacao
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="mant_id", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="bigint", length=20, name="mant_transacao", length=15, nullable=false)
     */
    protected $transacao;
    /**
     ** @Column(type="bigint", length=20, name="mant_operacao", length=15, nullable=false)
     */
    protected $operacao;
    /**
     ** @Column(type="string", name="mant_status", length=1, nullable=false)
     */
    protected $status;
    /**
     ** @Column(type="date", name="mant_dataLcto", nullable=false)
     */
    protected $dataLcto;
    /**
     ** @Column(type="integer", name="mant_empr_codigo", nullable=false)
     */
    protected $empr_Codigo;
    /**
     ** @Column(type="float", name="mant_valor", nullable=false)
     */
    protected $valor;
    /**
     ** @Column(type="float", name="mant_valorprev", nullable=false)
     */
    protected $valorprev;
    /**
     ** @Column(type="integer", name="mant_usuaLcto", nullable=false)
     */
    protected $usuaLcto;

    /**
     * MovAntecipacao constructor.
     * @param $codigo
     * @param $transacao
     * @param $operacao
     * @param $status
     * @param $dataLcto
     * @param $empr_Codigo
     * @param $valor
     * @param $valorprev
     * @param $usuaLcto
     */
    public function __construct($transacao, $operacao, $dataLcto, $empr_Codigo, $valor, $valorprev, $usuaLcto)
    {
        $this->transacao = $transacao;
        $this->operacao = $operacao;
        $this->status = "N";
        $this->dataLcto = $dataLcto;
        $this->empr_Codigo = $empr_Codigo;
        $this->valor = $valor;
        $this->valorprev = $valorprev;
        $this->usuaLcto = $usuaLcto;
    }

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
    public function getValorprev()
    {
        return $this->valorprev;
    }

    /**
     * @param mixed $valorprev
     */
    public function setValorprev($valorprev)
    {
        $this->valorprev = $valorprev;
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
    
}