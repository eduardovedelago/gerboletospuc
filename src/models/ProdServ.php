<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 21/01/18
 * Time: 16:31
 */

namespace models;

/**
 * Class ProdServ
 * @package DevSoft\Models
 * @Entity @Table(name="ProdServ")
 *
 **/

class ProdServ
{
    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="prsv_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="prsv_descricao", length=250, nullable=false)
     */
    protected $descricao;

    /**
     * @Column(type="float", name="prsv_valor", nullable=false)
     */
    protected $valor;


    /**
     ** @Column(type="integer", name="prsv_empr_codigo", length=15, nullable=true)
     */
    protected $empresa;

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
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
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

}