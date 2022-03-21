<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 29/03/21
 * Time: 23:21
 */

namespace models;

/**
 * Class Usuarios
 * @package DevSoft\Models
 * @Entity @Table(name="usuarios")
 *
 **/

class Usuarios
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="usua_codigo")
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="usua_nome", length=250)
     */
    protected $nome;
    /**
     ** @Column(type="string", name="usua_ativo", length=1, nullable=false)
     */
    protected $ativo;
    /**
     ** @Column(type="string", name="usua_senha", length=150, nullable=true)
     */
    protected $senha;
    /**
     ** @Column(type="string", name="usua_email", length=200, nullable=true)
     */
    protected $email;
    /**
     ** @Column(type="date", name="usua_dtcad", nullable=false)
     */
    protected $datacadastro;
    /**
     ** @Column(type="string", name="usua_acessos", length=2000, nullable=true)
     */
    protected $acessos;
    /**
     ** @Column(type="integer", name="usua_grup_codigo", length=10, nullable=true)
     */
    protected $grupo;
    /**
     ** @Column(type="string", name="usua_cpf", length=15, nullable=true)
     */
    protected $cpf;
    /**
     ** @Column(type="integer", name="usua_empr_codigo", length=20, nullable=true)
     */
    protected $empresa;
    /**
     ** @Column(type="string", name="usua_administrador", length=1, nullable=false)
     */
    protected $administrador;

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
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
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
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param mixed $datacadastro
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
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

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param mixed $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
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
    public function getAdministrador()
    {
        return $this->administrador;
    }

    /**
     * @param mixed $administrador
     */
    public function setAdministrador($administrador)
    {
        $this->administrador = $administrador;
    }

    public function isAdministrador(){
        return $this->administrador!=null &&  $this->administrador=='S';
    }

}