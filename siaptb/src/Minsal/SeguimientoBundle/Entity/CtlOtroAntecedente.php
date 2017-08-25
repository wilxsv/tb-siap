<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlOtroAntecedente
 *
 * @ORM\Table(name="ctl_otro_antecedente", indexes={@ORM\Index(name="fki_tipo_antecedente_otro_antecedente", columns={"id_tipo_antecedente"})})
 * @ORM\Entity
 */
class CtlOtroAntecedente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_otro_antecedente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_alternativo", type="string", length=100, nullable=true)
     */
    private $nombreAlternativo;

    /**
     * @var \CtlTipoAntecedente
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoAntecedente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_antecedente", referencedColumnName="id")
     * })
     */
    private $idTipoAntecedente;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CtlOtroAntecedente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set nombreAlternativo
     *
     * @param string $nombreAlternativo
     * @return CtlOtroAntecedente
     */
    public function setNombreAlternativo($nombreAlternativo)
    {
        $this->nombreAlternativo = $nombreAlternativo;

        return $this;
    }

    /**
     * Get nombreAlternativo
     *
     * @return string 
     */
    public function getNombreAlternativo()
    {
        return $this->nombreAlternativo;
    }

    /**
     * Set idTipoAntecedente
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoAntecedente $idTipoAntecedente
     * @return CtlOtroAntecedente
     */
    public function setIdTipoAntecedente(\Minsal\SeguimientoBundle\Entity\CtlTipoAntecedente $idTipoAntecedente = null)
    {
        $this->idTipoAntecedente = $idTipoAntecedente;

        return $this;
    }

    /**
     * Get idTipoAntecedente
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoAntecedente 
     */
    public function getIdTipoAntecedente()
    {
        return $this->idTipoAntecedente;
    }
}
