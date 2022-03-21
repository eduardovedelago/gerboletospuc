<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 31/08/17
 * Time: 11:23
 */

namespace models;


class AccessUsers
{

    private $codigo;
    private $descricao;
    private $nivel;
    private $posicao;
    private $liberacaoInstall;

    /**
     * AccessUsers constructor.
     * @param $codigo
     * @param $descricao
     * @param $nivel
     * @param $posicao
     */
    public function __construct($descricao, $nivel, $posicao, $liberacaoInstall)
    {
        $this->codigo = 10000+$posicao;
        $this->descricao = $descricao;
        $this->nivel = $nivel;
        $this->posicao = $posicao;
        $this->liberacaoInstall = $liberacaoInstall;
    }


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
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    /**
     * @return mixed
     */
    public function getPosicao()
    {
        return $this->posicao;
    }

    /**
     * @param mixed $posicao
     */
    public function setPosicao($posicao)
    {
        $this->posicao = $posicao;
    }

    /**
     * @return mixed
     */
    public function getLiberacaoInstall()
    {
        return $this->liberacaoInstall;
    }

    /**
     * @param mixed $liberacaoInstall
     */
    public function setLiberacaoInstall($liberacaoInstall)
    {
        $this->liberacaoInstall = $liberacaoInstall;
    }

}