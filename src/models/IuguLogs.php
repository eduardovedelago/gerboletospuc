<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class IuguLogs
 * @package DevSoft\Models
 * @Entity @Table(name="IuguLogs")
 *
 **/

class IuguLogs
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */
    /**
     * @Id
     * @Column(type="integer", name="ilog_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;
    /**
     ** @Column(type="string", name="ilog_tipo", length=250, nullable=false)
     */
    protected $tipo;//CON - Consulta de dados Iugu
    /**
     ** @Column(type="integer", name="ilog_usua_codigo", nullable=true)
     */
    protected $usuario;
    /**
     ** @Column(type="datetime", name="ilog_data", nullable=true)
     */
    protected $data;
    /**
     ** @Column(type="string", name="ilog_mensagem", length=1000, nullable=true)
     */
    protected $mensagem;

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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * @param mixed $mensagem
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }
}