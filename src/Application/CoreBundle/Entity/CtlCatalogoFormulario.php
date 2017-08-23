<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CtlCatalogoFormulario
 *
 * @ORM\Table(name="ctl_catalogo_formulario", indexes={@ORM\Index(name="IDX_8E5C8793F1A1D4C9", columns={"id_campo_id"}), @ORM\Index(name="IDX_8E5C879377105966", columns={"id_campo_descripcion"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"idCampo"}, errorPath="idTabla", message="Ya hay un Catálogo asociado a la Tabla seleccionada.")
 * @UniqueEntity(fields={"nombre"}, errorPath="nombre", message="El Nombre ya existe. No pueden existir Catalogos con nombres similares.")
 */
class CtlCatalogoFormulario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_catalogo_formulario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=40, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \CtlCampo
     *
     * @ORM\ManyToOne(targetEntity="CtlCampo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_campo_id", referencedColumnName="id")
     * })
     */
    private $idCampo;

    /**
     * @var \CtlCampo
     *
     * @ORM\ManyToOne(targetEntity="CtlCampo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_campo_descripcion", referencedColumnName="id")
     * })
     */
    private $idCampoDescripcion;



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
     * @return CtlCatalogoFormulario
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlCatalogoFormulario
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idCampo
     *
     * @param \Application\CoreBundle\Entity\CtlCampo $idCampo
     * @return CtlCatalogoFormulario
     */
    public function setIdCampo(\Application\CoreBundle\Entity\CtlCampo $idCampo = null)
    {
        $this->idCampo = $idCampo;

        return $this;
    }

    /**
     * Get idCampo
     *
     * @return \Application\CoreBundle\Entity\CtlCampo
     */
    public function getIdCampo()
    {
        return $this->idCampo;
    }

    /**
     * Set idCampoDescripcion
     *
     * @param \Application\CoreBundle\Entity\CtlCampo $idCampoDescripcion
     * @return CtlCatalogoFormulario
     */
    public function setIdCampoDescripcion(\Application\CoreBundle\Entity\CtlCampo $idCampoDescripcion = null)
    {
        $this->idCampoDescripcion = $idCampoDescripcion;

        return $this;
    }

    /**
     * Get idCampoDescripcion
     *
     * @return \Application\CoreBundle\Entity\CtlCampo
     */
    public function getIdCampoDescripcion()
    {
        return $this->idCampoDescripcion;
    }

    public function __toString()
    {
        return $this->nombre ?: ' ';
    }
}
