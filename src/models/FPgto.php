<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class FPgto
 * @package DevSoft\Models
 * @Entity @Table(name="FPgto")
 *
 **/

class FPgto
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="fpgt_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="fpgt_descricao", length=250, nullable=false)
     */
    protected $descricao;

    /**
     ** @Column(type="string", name="fpgt_aplicacao", length=50, nullable=false)
     */
    protected $aplicacao;

    /**
     ** @Column(type="string", name="fpgt_prazos", length=250, nullable=true)
     */
    protected $prazos;

    /**
     ** @Column(type="string", name="fpgt_comportamento", length=200, nullable=true)
     */
    protected $comportamento;

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getAplicacao()
    {
        return $this->aplicacao;
    }

    /**
     * @param mixed $aplicacao
     */
    public function setAplicacao($aplicacao)
    {
        $this->aplicacao = $aplicacao;
    }

    /**
     * @return mixed
     */
    public function getPrazos()
    {
        return $this->prazos;
    }

    /**
     * @param mixed $prazos
     */
    public function setPrazos($prazos)
    {
        $this->prazos = $prazos;
    }

    /**
     * @return mixed
     */
    public function getComportamento()
    {
        return $this->comportamento;
    }

    /**
     * @param mixed $comportamento
     */
    public function setComportamento($comportamento)
    {
        $this->comportamento = $comportamento;
    }
    
}