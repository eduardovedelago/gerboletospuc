<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class Portador
 * @package DevSoft\Models
 * @Entity @Table(name="Portadores")
 *
 **/

class Portador
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="port_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="port_descricao", length=250, nullable=false)
     */
    protected $descricao;

    /**
     ** @Column(type="string", name="port_comportamento", length=250, nullable=true)
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