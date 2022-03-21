<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/09/17
 * Time: 16:31
 */

namespace models;

/**
 * Class ConfGer
 * @package DevSoft\Models
 * @Entity @Table(name="ConfGer")
 *
 **/

class ConfGer
{

    /*
     * -----------------------------------------------------------
     *  ####                  Atributos
     * -----------------------------------------------------------
     */

    /**
     * @Id
     * @Column(type="integer", name="cger_codigo", nullable=false)
     * @GeneratedValue
     */
    protected $codigo;

    /**
     ** @Column(type="string", name="cger_textoboleto", length=500, nullable=false)
     */
    protected $textoboleto;

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
    public function getTextoboleto()
    {
        return $this->textoboleto;
    }

    /**
     * @param mixed $textoboleto
     */
    public function setTextoboleto($textoboleto)
    {
        $this->textoboleto = $textoboleto;
    }
    
}