<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 21/01/18
 * Time: 16:31
 */

namespace models;

/**
 * Class Register
 * @package DevSoft\Models
 * @Entity @Table(name="Register")
 *
 **/

class Register
{
    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="regi_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="string", name="regi_status", length=1, nullable=false))
     */
    protected $status;
    /**
     ** @Column(type="string", name="regi_nomeempresa", length=250, nullable=false))
     */
    protected $nomeempresa;

    /**
     ** @Column(type="string", name="regi_razaosocial", length=250, nullable=false))
     */
    protected $razaosocial;

    /**
     ** @Column(type="string", name="regi_cnpj", length=20, nullable=false)
     */
    protected $cnpj;

    /**
     ** @Column(type="string", name="regi_email", length=100, nullable=false)
     */
    protected $email;

//    /**
//     ** @Column(type="string", name="regi_municipio", length=100, nullable=true)
//     */
//    protected $municipio;

    /**
     ** @Column(type="date", name="regi_datainclusao", nullable=true)
     */
    protected $dataInclusao;
    /**
     ** @Column(type="string", name="regi_nome", length=250)
     */
    protected $nome;
    /**
     ** @Column(type="string", name="regi_fone", length=25)
     */
    protected $fone;
    /**
     ** @Column(type="string", name="regi_fone2", length=25)
     */
    protected $fone2;
    /**
     ** @Column(type="string", name="regi_sexo", length=25, nullable=true))
     */
    protected $sexo;
    /**
     ** @Column(type="string", name="regi_origeminteresse", length=30, nullable=true))
     */
    protected $origeminteresse;
    /**
     ** @Column(type="string", name="regi_obs", length=350, nullable=true))
     */
    protected $obs;

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
    public function getNomeempresa()
    {
        return $this->nomeempresa;
    }

    /**
     * @param mixed $nomeempresa
     */
    public function setNomeempresa($nomeempresa)
    {
        $this->nomeempresa = $nomeempresa;
    }

    /**
     * @return mixed
     */
    public function getRazaosocial()
    {
        return $this->razaosocial;
    }

    /**
     * @param mixed $razaosocial
     */
    public function setRazaosocial($razaosocial)
    {
        $this->razaosocial = $razaosocial;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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
    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }

    /**
     * @param mixed $dataInclusao
     */
    public function setDataInclusao($dataInclusao)
    {
        $this->dataInclusao = $dataInclusao;
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
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * @param mixed $fone
     */
    public function setFone($fone)
    {
        $this->fone = $fone;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getOrigeminteresse()
    {
        return $this->origeminteresse;
    }

    /**
     * @param mixed $origeminteresse
     */
    public function setOrigeminteresse($origeminteresse)
    {
        $this->origeminteresse = $origeminteresse;
    }

    /**
     * @return mixed
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param mixed $obs
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
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
    public function getFone2()
    {
        return $this->fone2;
    }

    /**
     * @param mixed $fone2
     */
    public function setFone2($fone2)
    {
        $this->fone2 = $fone2;
    }
}