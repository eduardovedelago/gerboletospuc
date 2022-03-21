<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class PlanoGer
 * @package DevSoft\Models
 * @Entity @Table(name="PlanoGer")
 *
 **/

class PlanoGer
{
    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="pger_conta", nullable=false)
     * @GeneratedValue
     */
    protected $conta;

    /**
     ** @Column(type="string", name="pger_descricao", length=250, nullable=false)
     */
    protected $descricao;

    /**
     ** @Column(type="string", name="pger_classificacao", length=250, nullable=false)
     */
    protected $classificacao;

    /**
     ** @Column(type="string", name="pger_tipo", length=2, nullable=false)
     */
    protected $tipo;

    /**
     * @Column(type="integer", name="pger_pcon_conta", nullable=true)
     */
    protected $contaContabil;

    /**
     ** @Column(type="string", name="pger_comportamento", length=250, nullable=true)
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
    public function getConta()
    {
        return $this->conta;
    }

    /**
     * @param mixed $conta
     */
    public function setConta($conta)
    {
        $this->conta = $conta;
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
    public function getClassificacao()
    {
        return $this->classificacao;
    }

    /**
     * @param mixed $classificacao
     */
    public function setClassificacao($classificacao)
    {
        $this->classificacao = $classificacao;
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
    public function getContaContabil()
    {
        return $this->contaContabil;
    }

    /**
     * @param mixed $contaContabil
     */
    public function setContaContabil($contaContabil)
    {
        $this->contaContabil = $contaContabil;
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