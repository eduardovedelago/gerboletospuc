<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 15/08/17
 * Time: 16:31
 */

namespace models;

/**
 * Class Grupos
 * @package DevSoft\Models
 * @Entity @Table(name="grupos")
 *
 **/

class Grupos
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="grup_codigo")
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="grup_nome", length=250)
     */
    protected $nome;

    /**
     ** @Column(type="string", name="grup_acessos", length=2000, nullable=true)
     */
    protected $acessos;

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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getAcessos()
    {
        return $this->acessos;
    }

    /**
     * @param mixed $acessos
     */
    public function setAcessos($acessos)
    {
        $this->acessos = $acessos;
    }

}