<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class MovAntecipacaoAnalise
 * @package DevSoft\Models
 * @Entity @Table(name="MovAntecipacaoAnalise")
 *
 **/

class MovAntecipacaoAnalise
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="maan_id", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="bigint", length=20, name="maan_transacao", length=15, nullable=false)
     */
    protected $transacao;
    /**
     ** @Column(type="bigint", length=20, name="maan_operacao", length=15, nullable=false)
     */
    protected $operacao;
    /**
     ** @Column(type="string", name="maan_status", length=1, nullable=false)
     */
    protected $status;
    /**
     ** @Column(type="date", name="maan_dataLcto", nullable=false)
     */
    protected $dataLcto;
    /**
     ** @Column(type="date", name="maan_dataMvto", nullable=false)
     */
    protected $dataMvto;
    /**
     ** @Column(type="integer", name="maan_numAvaliacoes", nullable=false)
     */
    protected $numAvaliacoes;
    /**
     ** @Column(type="integer", name="maan_numAprovados", nullable=false)
     */
    protected $numAprovados;
    /**
     ** @Column(type="integer", name="maan_numRejeitados", nullable=false)
     */
    protected $numRejeitados;
    /**
     ** @Column(type="float", name="maan_valor", nullable=false)
     */
    protected $valor;
    /**
     ** @Column(type="float", name="maan_valorRepasse", nullable=false)
     */
    protected $valorRepasse;
    /**
     ** @Column(type="integer", name="maan_usuaLcto", nullable=false)
     */
    protected $usuaLcto;
    /**
     ** @Column(type="integer", name="maan_empr_codigo", nullable=false)
     */
    protected $empr_Codigo;

    /**
     * MovAntecipacaoAnalise constructor.
     * @param $transacao
     * @param $operacao
     * @param $valor
     * @param $valorRepasse
     * @param $usuaLcto
     */
    public function __construct($transacao, $operacao, $dataLcto, $dataMvto, $numOcorrencias, $aprovados, $rejeitados, $valor, $valorRepasse, $usuaLcto, $empresa)
    {
        $this->status = "N";
        $this->dataLcto = $dataLcto;
        $this->transacao = $transacao;
        $this->numAvaliacoes = $numOcorrencias;
        $this->dataMvto = $dataMvto;
        $this->operacao = $operacao;
        $this->valor = $valor;
        $this->valorRepasse = $valorRepasse;
        $this->usuaLcto = $usuaLcto;
        $this->numAprovados = $aprovados;
        $this->numRejeitados = $rejeitados;
        $this->empr_Codigo = $empresa;
    }


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
    public function getTransacao()
    {
        return $this->transacao;
    }

    /**
     * @param mixed $transacao
     */
    public function setTransacao($transacao)
    {
        $this->transacao = $transacao;
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
    public function getDataLcto()
    {
        return $this->dataLcto;
    }

    /**
     * @param mixed $dataLcto
     */
    public function setDataLcto($dataLcto)
    {
        $this->dataLcto = $dataLcto;
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

    /**
     * @return mixed
     */
    public function getUsuaLcto()
    {
        return $this->usuaLcto;
    }

    /**
     * @param mixed $usuaLcto
     */
    public function setUsuaLcto($usuaLcto)
    {
        $this->usuaLcto = $usuaLcto;
    }

    /**
     * @return mixed
     */
    public function getDataMvto()
    {
        return $this->dataMvto;
    }

    /**
     * @param mixed $dataMvto
     */
    public function setDataMvto($dataMvto)
    {
        $this->dataMvto = $dataMvto;
    }

    /**
     * @return mixed
     */
    public function getNumAvaliacoes()
    {
        return $this->numAvaliacoes;
    }

    /**
     * @param mixed $numAvaliacoes
     */
    public function setNumAvaliacoes($numAvaliacoes)
    {
        $this->numAvaliacoes = $numAvaliacoes;
    }

    /**
     * @return mixed
     */
    public function getValorRepasse()
    {
        return $this->valorRepasse;
    }

    /**
     * @param mixed $valorRepasse
     */
    public function setValorRepasse($valorRepasse)
    {
        $this->valorRepasse = $valorRepasse;
    }

    /**
     * @return mixed
     */
    public function getNumAprovados()
    {
        return $this->numAprovados;
    }

    /**
     * @param mixed $numAprovados
     */
    public function setNumAprovados($numAprovados)
    {
        $this->numAprovados = $numAprovados;
    }

    /**
     * @return mixed
     */
    public function getNumRejeitados()
    {
        return $this->numRejeitados;
    }

    /**
     * @param mixed $numRejeitados
     */
    public function setNumRejeitados($numRejeitados)
    {
        $this->numRejeitados = $numRejeitados;
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

}