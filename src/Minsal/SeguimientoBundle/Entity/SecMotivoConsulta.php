<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecMotivoConsulta
 *
 * @ORM\Table(name="sec_motivo_consulta", indexes={@ORM\Index(name="fki_historial_clinico_motivo_consulta", columns={"id_historial_clinico"})})
 * @ORM\Entity
 */
class SecMotivoConsulta {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_motivo_consulta_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="consulta_por", type="text", nullable=false)
     */
    private $consultaPor;

    /**
     * @var string
     *
     * @ORM\Column(name="presenta_enfermedad", type="text", nullable=false)
     */
    private $presentaEnfermedad;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\OneToOne(targetEntity="SecHistorialClinico",inversedBy="idMotivoConsulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */

    private $idHistorialClinico;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set consultaPor
     *
     * @param string $consultaPor
     * @return SecMotivoConsulta
     */
    public function setConsultaPor($consultaPor) {
        $this->consultaPor = $consultaPor;

        return $this;
    }

    /**
     * Get consultaPor
     *
     * @return string
     */
    public function getConsultaPor() {
        return $this->consultaPor;
    }

    /**
     * Set presentaEnfermedad
     *
     * @param string $presentaEnfermedad
     * @return SecMotivoConsulta
     */
    public function setPresentaEnfermedad($presentaEnfermedad) {
        $this->presentaEnfermedad = $presentaEnfermedad;

        return $this;
    }

    /**
     * Get presentaEnfermedad
     *
     * @return string
     */
    public function getPresentaEnfermedad() {
        return $this->presentaEnfermedad;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecMotivoConsulta
     */
    public function setIdHistorialClinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico = null) {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico
     */
    public function getIdHistorialClinico() {
        return $this->idHistorialClinico;
    }

    public function __toString() {
        return $this->consultaPor ? : '';
    }

}
