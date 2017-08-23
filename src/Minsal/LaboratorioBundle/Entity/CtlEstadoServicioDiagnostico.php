<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlEstadoServicioDiagnostico
 *
 * @ORM\Table(name="ctl_estado_servicio_diagnostico", indexes={@ORM\Index(name="IDX_8D5C8BAA695EA351", columns={"id_atencion"})})
 * @ORM\Entity
 */
class CtlEstadoServicioDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_estado_servicio_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idestado", type="string", length=2, nullable=false)
     */
    private $idestado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=40, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;



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
     * Set idestado
     *
     * @param string $idestado
     * @return CtlEstadoServicioDiagnostico
     */
    public function setIdestado($idestado)
    {
        $this->idestado = $idestado;

        return $this;
    }

    /**
     * Get idestado
     *
     * @return string
     */
    public function getIdestado()
    {
        return $this->idestado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlEstadoServicioDiagnostico
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
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return CtlEstadoServicioDiagnostico
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    public function __toString() {
        return $this->descripcion ? $this->descripcion : '';
    }
}
