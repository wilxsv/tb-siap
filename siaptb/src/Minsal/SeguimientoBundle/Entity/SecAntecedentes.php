<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentes
 *
 * @ORM\Table(name="sec_antecedentes", indexes={@ORM\Index(name="IDX_F1330D83961045CB", columns={"id_paciente"}), @ORM\Index(name="IDX_F1330D83A7C7EF6A", columns={"id_formulario"}), @ORM\Index(name="IDX_F1330D83890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_F1330D838627A85B", columns={"id_aten_area_mod_estab"})})
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\SecAntecedentesRepository")
 */
class SecAntecedentes {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=false)
     */
    private $fechaHoraRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="otras_enf_cronicas", type="text", nullable=true)
     */
    private $otrasEnfCronicas;

    /**
     * @var \Minsal\SiapsBundle\MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntPaciente",inversedBy="idAntecedentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;

    /**
     * @var \Minsal\SiapsBundle\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;
    
     /*ESTTOS ATRIBUTOS HAN SIDO AGREGADOS CON EL UNICO MOTIVO DE ACCEDER A CIERTOS ELEMENTOS EN LAS VISTAS.*/
     /**
     * @var Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos
     *
     * @ORM\OneToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos", mappedBy="idAntecedentes",
     * cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idAntecedentesObstetricos;
    
    /**
     * @var Minsal\SeguimientoBundle\Entity\SecAntecedentesOrientacionIdentidadSexual
     *
     * @ORM\OneToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecAntecedentesOrientacionIdentidadSexual", mappedBy="idAntecedentes",
     * cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idAntecedentesOrientacionIdentidadSexual;


    public function __toString() {
        return $this->getNombre()?:'Antecedentes';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return SecAntecedentes
     */
    public function setFechaHoraRegistro($fechaHoraRegistro) {
        $this->fechaHoraRegistro = $fechaHoraRegistro;

        return $this;
    }

    /**
     * Get fechaHoraRegistro
     *
     * @return \DateTime 
     */
    public function getFechaHoraRegistro() {
        return $this->fechaHoraRegistro;
    }

    /**
     * Set otrasEnfCronicas
     *
     * @param string $otrasEnfCronicas
     * @return SecAntecedentes
     */
    public function setOtrasEnfCronicas($otrasEnfCronicas) {
        $this->otrasEnfCronicas = $otrasEnfCronicas;

        return $this;
    }

    /**
     * Get otrasEnfCronicas
     *
     * @return string 
     */
    public function getOtrasEnfCronicas() {
        return $this->otrasEnfCronicas;
    }

    /**
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     * @return SecAntecedentes
     */
    public function setIdPaciente(\Minsal\SiapsBundle\Entity\MntPaciente $idPaciente = null) {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return \Minsal\SiapsBundle\Entity\MntPaciente 
     */
    public function getIdPaciente() {
        return $this->idPaciente;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecAntecedentes
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null) {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleado() {
        return $this->idEmpleado;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        $paciente = $this->getIdPaciente();
        return $paciente->getPrimerNombre() . ' ' . $paciente->getSegundoNombre() . ' ' . $paciente->getPrimerApellido() . ' ' . $paciente->getSegundoApellido();
    }

    /**
     * Get dui
     *
     * @return integer
     */
    public function getDui() {
        $paciente = $this->getIdPaciente();
        return $paciente->getNumeroDocIdePaciente();
    }



    /**
     * Set idAntecedentesObstetricos
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos $idAntecedentesObstetricos
     * @return SecAntecedentes
     */
    public function setIdAntecedentesObstetricos(\Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos $idAntecedentesObstetricos = null)
    {
        $this->idAntecedentesObstetricos = $idAntecedentesObstetricos;

        return $this;
    }

    /**
     * Get idAntecedentesObstetricos
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos 
     */
    public function getIdAntecedentesObstetricos()
    {
        return $this->idAntecedentesObstetricos;
    }

    /**
     * Set idAntecedentesOrientacionIdentidadSexual
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecAntecedentesOrientacionIdentidadSexual $idAntecedentesOrientacionIdentidadSexual
     * @return SecAntecedentes
     */
    public function setIdAntecedentesOrientacionIdentidadSexual(\Minsal\SeguimientoBundle\Entity\SecAntecedentesOrientacionIdentidadSexual $idAntecedentesOrientacionIdentidadSexual = null)
    {
        $this->idAntecedentesOrientacionIdentidadSexual = $idAntecedentesOrientacionIdentidadSexual;

        return $this;
    }

    /**
     * Get idAntecedentesOrientacionIdentidadSexual
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecAntecedentesOrientacionIdentidadSexual 
     */
    public function getIdAntecedentesOrientacionIdentidadSexual()
    {
        return $this->idAntecedentesOrientacionIdentidadSexual;
    }
}
