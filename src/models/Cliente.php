<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class Cliente
 * @package DevSoft\Models
 * @Entity @Table(name="Clientes")
 *
 **/

class Cliente
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="clie_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="clie_nome", length=250, nullable=false)
     */
    protected $nome;

    /**
     ** @Column(type="string", name="clie_razaoSocial", length=250, nullable=true)
     */
    protected $razaoSocial;

    /*
     * F - Física, J - Juridica
     */
    /**
     ** @Column(type="string", name="clie_tipo", length=1, nullable=false)
     */
    protected $tipo;
    /**
     ** @Column(type="string", name="clie_cnpjCpf", length=20, nullable=true)
     */
    protected $cnpjCpf;
    /**
     ** @Column(type="string", name="clie_rgIE", length=20, nullable=true)
     */
    protected $rgIe;
    /**
     ** @Column(type="string", name="clie_endereco", length=100, nullable=true)
     */
    protected $endereco;
    /**
     ** @Column(type="string", name="clie_enderecoNumero", length=20, nullable=true)
     */
    protected $enderecoNumero;
    /**
     ** @Column(type="string", name="clie_enderecoComplemento", length=100, nullable=true)
     */
    protected $enderecoComplemento;
    /**
     ** @Column(type="string", name="clie_enderecoBairro", length=50, nullable=true)
     */
    protected $enderecoBairro;
    /**
     ** @Column(type="integer", name="clie_muni_codigo", nullable=true)
     */
    protected $muni_Codigo;
    /**
     ** @Column(type="string", name="clie_cep", length=11, nullable=true)
     */
    protected $cep;
    /**
     ** @Column(type="string", name="clie_fone", length=15, nullable=true)
     */
    protected $fone;
    /**
     ** @Column(type="string", name="clie_celular", length=15, nullable=true)
     */
    protected $celular;
    /**
     ** @Column(type="string", name="clie_email", length=100, nullable=true)
     */
    protected $email;
    /**
     ** @Column(type="string", name="clie_observacao", length=100, nullable=true)
     */
    protected $observacao;
    /*
    * A - Ativo, B - Bloqueado
    */
    /**
     ** @Column(type="string", name="clie_situacao", length=1, nullable=true)
     */
    protected $situacao;
    /**
     ** @Column(type="date", name="clie_dataCadastro", nullable=false)
     */
    protected $dataCad;
    /**
     ** @Column(type="integer", name="clie_empr_codigo", nullable=false)
     */
    protected $empr_Codigo;
    /**
     ** @Column(type="integer", name="clie_usua_codigo", nullable=false)
     */
    protected $usua_Codigo;

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
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * @param mixed $razaoSocial
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
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
    public function getCnpjCpf()
    {
        return $this->cnpjCpf;
    }

    /**
     * @param mixed $cnpjCpf
     */
    public function setCnpjCpf($cnpjCpf)
    {
        $this->cnpjCpf = $cnpjCpf;
    }

    /**
     * @return mixed
     */
    public function getRgIe()
    {
        return $this->rgIe;
    }

    /**
     * @param mixed $rgIe
     */
    public function setRgIe($rgIe)
    {
        $this->rgIe = $rgIe;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getEnderecoNumero()
    {
        return $this->enderecoNumero;
    }

    /**
     * @param mixed $enderecoNumero
     */
    public function setEnderecoNumero($enderecoNumero)
    {
        $this->enderecoNumero = $enderecoNumero;
    }

    /**
     * @return mixed
     */
    public function getEnderecoComplemento()
    {
        return $this->enderecoComplemento;
    }

    /**
     * @param mixed $enderecoComplemento
     */
    public function setEnderecoComplemento($enderecoComplemento)
    {
        $this->enderecoComplemento = $enderecoComplemento;
    }

    /**
     * @return mixed
     */
    public function getEnderecoBairro()
    {
        return $this->enderecoBairro;
    }

    /**
     * @param mixed $enderecoBairro
     */
    public function setEnderecoBairro($enderecoBairro)
    {
        $this->enderecoBairro = $enderecoBairro;
    }

    /**
     * @return mixed
     */
    public function getMuniCodigo()
    {
        return $this->muni_Codigo;
    }

    /**
     * @param mixed $muni_Codigo
     */
    public function setMuniCodigo($muni_Codigo)
    {
        $this->muni_Codigo = $muni_Codigo;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
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
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
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
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }

    /**
     * @return mixed
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param mixed $situacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    /**
     * @return mixed
     */
    public function getDataCad()
    {
        return $this->dataCad;
    }

    /**
     * @param mixed $dataCad
     */
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;
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
    public function getUsuaCodigo()
    {
        return $this->usua_Codigo;
    }

    /**
     * @param mixed $usua_Codigo
     */
    public function setUsuaCodigo($usua_Codigo)
    {
        $this->usua_Codigo = $usua_Codigo;
    }

}