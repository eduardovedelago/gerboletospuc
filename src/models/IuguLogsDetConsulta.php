<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 13/02/17
 * Time: 20:47
 */

namespace models;

/**
 * Class IuguLogsDetConsulta
 * @package DevSoft\Models
 * @Entity @Table(name="IuguLogsDetConsulta")
 *
 **/

class IuguLogsDetConsulta
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="dCon_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     * @Column(type="integer", name="dCon_ilog_codigo", nullable=false)
     */
    protected $ilog_codigo;
    /**
     * @Column(type="bigint", name="dCon_pfin_operacao", length=20, nullable=false)
     */
    protected $operacao;
    /**
     ** @Column(type="string", name="dCon_pfin_status", length=1, nullable=false)
     */
    protected $statusAtual;
    /**
     ** @Column(type="string", name="dCon_pfin_status_novo", length=1, nullable=false)
     */
    protected $statusNovo;

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
    public function getStatusAtual()
    {
        return $this->statusAtual;
    }

    /**
     * @param mixed $statusAtual
     */
    public function setStatusAtual($statusAtual)
    {
        $this->statusAtual = $statusAtual;
    }

    /**
     * @return mixed
     */
    public function getStatusNovo()
    {
        return $this->statusNovo;
    }

    /**
     * @param mixed $statusNovo
     */
    public function setStatusNovo($statusNovo)
    {
        $this->statusNovo = $statusNovo;
    }

    /**
     * @return mixed
     */
    public function getIlogCodigo()
    {
        return $this->ilog_codigo;
    }

    /**
     * @param mixed $ilog_codigo
     */
    public function setIlogCodigo($ilog_codigo)
    {
        $this->ilog_codigo = $ilog_codigo;
    }

}