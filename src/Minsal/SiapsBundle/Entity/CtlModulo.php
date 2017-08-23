<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlModulo
 *
 * @ORM\Table(name="ctl_modulo")
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repositorio\CtlModuloRepository")
 */
class CtlModulo {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_modulo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_modulo", type="string", length=3, nullable=true)
     */
    private $codModulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_menu_siap", type="integer", nullable=false)
     */
    private $ordenMenuSiap;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CtlModulo
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set codModulo
     *
     * @param string $codModulo
     * @return CtlModulo
     */
    public function setCodModulo($codModulo) {
        $this->codModulo = $codModulo;

        return $this;
    }

    /**
     * Get codModulo
     *
     * @return string
     */
    public function getCodModulo() {
        return $this->codModulo;
    }

    public function __toString() {
        return $this->getNombre();
    }


    /**
     * Set ordenMenuSiap
     *
     * @param integer $ordenMenuSiap
     * @return CtlModulo
     */
    public function setOrdenMenuSiap($ordenMenuSiap)
    {
        $this->ordenMenuSiap = $ordenMenuSiap;

        return $this;
    }

    /**
     * Get ordenMenuSiap
     *
     * @return integer
     */
    public function getOrdenMenuSiap()
    {
        return $this->ordenMenuSiap;
    }
}
