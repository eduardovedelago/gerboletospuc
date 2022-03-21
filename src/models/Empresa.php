<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 21/01/18
 * Time: 16:31
 */

namespace models;

/**
 * Class Empresa
 * @package DevSoft\Models
 * @Entity @Table(name="Empresas")
 *
 **/

class Empresa
{
    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="empr_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="empr_nome", length=250, nullable=false)
     */
    protected $nome;

    /**
     ** @Column(type="string", name="empr_razaosocial", length=250, nullable=false)
     */
    protected $razaosocial;

    /**
     ** @Column(type="string", name="empr_cnpj", length=20, nullable=false)
     */
    protected $cnpj;

    /**
     ** @Column(type="string", name="empr_email", length=100, nullable=false)
     */
    protected $email;

    /**
     ** @Column(type="integer", name="empr_muni_codigo", length=10, nullable=true)
     */
    protected $municipio;

    /**
     ** @Column(type="string", name="empr_endereco", length=150, nullable=true)
     */
    protected $endereco;
    /**
     ** @Column(type="string", name="empr_endereconumero", length=20, nullable=true)
     */
    protected $endereconumero;
    /**
     ** @Column(type="string", name="empr_enderecocompl", length=50, nullable=true)
     */
    protected $enderecocompl;
    /**
     ** @Column(type="string", name="empr_clireparcelar", length=1, nullable=true)
     */
    protected $clireparcelar;
    /**
     ** @Column(type="integer", name="empr_$clinumparcelas", length=5, nullable=true)
     */
    protected $clinumparcelas;
    /**
     ** @Column(type="float", name="empr_cliparcvalorminimo", nullable=true)
     */
    protected $cliparcvalorminimo;

    /**
     ** @Column(type="float", name="empr_taxaboleto", nullable=true)
     */
    protected $taxaboleto;

    /**
     ** @Column(type="float", name="empr_taxacheque", nullable=true)
     */
    protected $taxacheque;

    /**
     ** @Column(type="float", name="empr_jurosboleto", nullable=true)
     */
    protected $jurosboleto;

    /**
     ** @Column(type="float", name="empr_multaboleto", nullable=true)
     */
    protected $multaboleto;

    /**
     ** @Column(type="float", name="empr_moraboleto", nullable=true)
     */
    protected $moraboleto;

    /**
     ** @Column(type="string", length=1, name="empr_carteiragarantida", nullable=true)
     */
    protected $carteiragarantida;
    /**
     ** @Column(type="date", name="empr_datacontrato", nullable=true)
     */
    protected $dataContrato;

    /**
     ** @Column(type="float", name="empr_fatorcompra", nullable=true)
     */
    protected $fatorCompra;

    /**
     ** @Column(type="float", name="empr_percadvaloren", nullable=true)
     */
    protected $percAdValoren;
    /**
     ** @Column(type="float", name="empr_percIOF", nullable=true)
     */
    protected $percIOF;
    /**
     ** @Column(type="float", name="empr_percIOFDiario", nullable=true)
     */
    protected $percIOFDiario;


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
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
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
    public function getEndereconumero()
    {
        return $this->endereconumero;
    }

    /**
     * @param mixed $endereconumero
     */
    public function setEndereconumero($endereconumero)
    {
        $this->endereconumero = $endereconumero;
    }


    /**
     * @return mixed
     */
    public function getTaxaboleto()
    {
        return $this->taxaboleto;
    }

    /**
     * @param mixed $taxaboleto
     */
    public function setTaxaboleto($taxaboleto)
    {
        $this->taxaboleto = $taxaboleto;
    }

    /**
     * @return mixed
     */
    public function getTaxacheque()
    {
        return $this->taxacheque;
    }

    /**
     * @param mixed $taxacheque
     */
    public function setTaxacheque($taxacheque)
    {
        $this->taxacheque = $taxacheque;
    }

    /**
     * @return mixed
     */
    public function getEnderecocompl()
    {
        return $this->enderecocompl;
    }

    /**
     * @param mixed $enderecocompl
     */
    public function setEnderecocompl($enderecocompl)
    {
        $this->enderecocompl = $enderecocompl;
    }

    /**
     * @return mixed
     */
    public function getJurosboleto()
    {
        return $this->jurosboleto;
    }

    /**
     * @param mixed $jurosboleto
     */
    public function setJurosboleto($jurosboleto)
    {
        $this->jurosboleto = $jurosboleto;
    }

    /**
     * @return mixed
     */
    public function getMultaboleto()
    {
        return $this->multaboleto;
    }

    /**
     * @param mixed $multaboleto
     */
    public function setMultaboleto($multaboleto)
    {
        $this->multaboleto = $multaboleto;
    }

    /**
     * @return mixed
     */
    public function getMoraboleto()
    {
        return $this->moraboleto;
    }

    /**
     * @param mixed $moraboleto
     */
    public function setMoraboleto($moraboleto)
    {
        $this->moraboleto = $moraboleto;
    }

    /**
     * @return mixed
     */
    public function getCarteiragarantida()
    {
        return $this->carteiragarantida;
    }

    /**
     * @param mixed $carteiragarantida
     */
    public function setCarteiragarantida($carteiragarantida)
    {
        $this->carteiragarantida = $carteiragarantida;
    }

    /**
     * @return mixed
     */
    public function getCliereparcelar()
    {
        return $this->cliereparcelar;
    }

    /**
     * @param mixed $clireparcelar
     */
    public function setClireparcelar($clireparcelar)
    {
        $this->clireparcelar = $clireparcelar;
    }

    /**
     * @return mixed
     */
    public function getClinumparcelas()
    {
        return $this->clinumparcelas;
    }

    /**
     * @param mixed $clinumparcelas
     */
    public function setClinumparcelas($clinumparcelas)
    {
        $this->clinumparcelas = $clinumparcelas;
    }

    /**
     * @return mixed
     */
    public function getCliparcvalorminimo()
    {
        return $this->cliparcvalorminimo;
    }

    /**
     * @param mixed $cliparcvalorminimo
     */
    public function setCliparcvalorminimo($cliparcvalorminimo)
    {
        $this->cliparcvalorminimo = $cliparcvalorminimo;
    }

    /**
     * @return mixed
     */
    public function getDataContrato()
    {
        return $this->dataContrato;
    }

    /**
     * @param mixed $dataContrato
     */
    public function setDataContrato($dataContrato)
    {
        $this->dataContrato = $dataContrato;
    }

    /**
     * @return mixed
     */
    public function getFatorCompra()
    {
        return $this->fatorCompra;
    }

    /**
     * @param mixed $fatorCompra
     */
    public function setFatorCompra($fatorCompra)
    {
        $this->fatorCompra = $fatorCompra;
    }

    /**
     * @return mixed
     */
    public function getPercAdValoren()
    {
        return $this->percAdValoren;
    }

    /**
     * @param mixed $percAdValoren
     */
    public function setPercAdValoren($percAdValoren)
    {
        $this->percAdValoren = $percAdValoren;
    }

    /**
     * @return mixed
     */
    public function getPercIOF()
    {
        return $this->percIOF;
    }

    /**
     * @param mixed $percIOF
     */
    public function setPercIOF($percIOF)
    {
        $this->percIOF = $percIOF;
    }

    /**
     * @return mixed
     */
    public function getPercIOFDiario()
    {
        return $this->percIOFDiario;
    }

    /**
     * @param mixed $percIOFDiario
     */
    public function setPercIOFDiario($percIOFDiario)
    {
        $this->percIOFDiario = $percIOFDiario;
    }

}