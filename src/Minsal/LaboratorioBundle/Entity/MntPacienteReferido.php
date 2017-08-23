<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MntPacienteReferido
 *
 * @ORM\Table(name="mnt_paciente_referido", indexes={@ORM\Index(name="IDX_29EB2C67A7194A90", columns={"id_sexo"}), @ORM\Index(name="IDX_29EB2C676B3CA4B", columns={"id_user"}), @ORM\Index(name="IDX_29EB2C67AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_29EB2C67220BCD31", columns={"id_area_cotizacion"})})
 * @ORM\Entity
 */
class MntPacienteReferido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_paciente_referido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=25, nullable=false)
     */
    private $primerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=25, nullable=true)
     */
    private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tercer_nombre", type="string", length=25, nullable=true)
     */
    private $tercerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=25, nullable=false)
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=25, nullable=true)
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_casada", type="string", length=25, nullable=true)
     */
    private $apellidoCasada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_responsable", type="string", length=80, nullable=true)
     */
    private $nombreResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_madre", type="string", length=80, nullable=true)
     */
    private $nombreMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_padre", type="string", length=80, nullable=true)
     */
    private $nombrePadre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mod", type="datetime", nullable=true)
     */
    private $fechaMod;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_afiliacion", type="string", length=12, nullable=true)
     */
    private $numeroAfiliacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asegurado", type="boolean", nullable=true)
     */
    private $asegurado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAreaCotizante
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAreaCotizante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_cotizacion", referencedColumnName="id")
     * })
     */
    private $idAreaCotizacion;

    /**
     * @var \CtlModulo
     *
     * @ORM\ManyToOne(targetEntity="CtlModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id")
     * })
     */
    private $idModulo;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=true)
     * @Assert\Length(min = "10")
     */
    private $direccion;


     /**
     * @var integer
     *
     * @ORM\Column(name="area_geografica_domicilio", type="integer", nullable=true)
     */
    private $areaGeograficaDomicilio;


    /**
     * @var integer
     *
     * @ORM\Column(name="id_departamento_domicilio", type="integer", nullable=true)
     */
    private $idDepartamentoDomicilio;


     /**
     * @var integer
     *
     * @ORM\Column(name="id_municipio_domicilio", type="integer", nullable=true)
     */
    private $idMunicipioDomicilio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_referencia_origen", type="integer", length=20, nullable=true)
     */
    private $idReferenciaOrigen;


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
     * Set primerNombre
     *
     * @param string $primerNombre
     * @return MntPacienteReferido
     */
    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     * @return MntPacienteReferido
     */
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set tercerNombre
     *
     * @param string $tercerNombre
     * @return MntPacienteReferido
     */
    public function setTercerNombre($tercerNombre)
    {
        $this->tercerNombre = $tercerNombre;

        return $this;
    }

    /**
     * Get tercerNombre
     *
     * @return string
     */
    public function getTercerNombre()
    {
        return $this->tercerNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     * @return MntPacienteReferido
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     * @return MntPacienteReferido
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set apellidoCasada
     *
     * @param string $apellidoCasada
     * @return MntPacienteReferido
     */
    public function setApellidoCasada($apellidoCasada)
    {
        $this->apellidoCasada = $apellidoCasada;

        return $this;
    }

    /**
     * Get apellidoCasada
     *
     * @return string
     */
    public function getApellidoCasada()
    {
        return $this->apellidoCasada;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return MntPacienteReferido
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set nombreResponsable
     *
     * @param string $nombreResponsable
     * @return MntPacienteReferido
     */
    public function setNombreResponsable($nombreResponsable)
    {
        $this->nombreResponsable = $nombreResponsable;

        return $this;
    }

    /**
     * Get nombreResponsable
     *
     * @return string
     */
    public function getNombreResponsable()
    {
        return $this->nombreResponsable;
    }

    /**
     * Set nombreMadre
     *
     * @param string $nombreMadre
     * @return MntPacienteReferido
     */
    public function setNombreMadre($nombreMadre)
    {
        $this->nombreMadre = $nombreMadre;

        return $this;
    }

    /**
     * Get nombreMadre
     *
     * @return string
     */
    public function getNombreMadre()
    {
        return $this->nombreMadre;
    }

    /**
     * Set nombrePadre
     *
     * @param string $nombrePadre
     * @return MntPacienteReferido
     */
    public function setNombrePadre($nombrePadre)
    {
        $this->nombrePadre = $nombrePadre;

        return $this;
    }

    /**
     * Get nombrePadre
     *
     * @return string
     */
    public function getNombrePadre()
    {
        return $this->nombrePadre;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return MntPacienteReferido
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaMod
     *
     * @param \DateTime $fechaMod
     * @return MntPacienteReferido
     */
    public function setFechaMod($fechaMod)
    {
        $this->fechaMod = $fechaMod;

        return $this;
    }

    /**
     * Get fechaMod
     *
     * @return \DateTime
     */
    public function getFechaMod()
    {
        return $this->fechaMod;
    }

    /**
     * Set numeroAfiliacion
     *
     * @param string $numeroAfiliacion
     * @return MntPacienteReferido
     */
    public function setNumeroAfiliacion($numeroAfiliacion)
    {
        $this->numeroAfiliacion = $numeroAfiliacion;

        return $this;
    }

    /**
     * Get numeroAfiliacion
     *
     * @return string
     */
    public function getNumeroAfiliacion()
    {
        return $this->numeroAfiliacion;
    }

    /**
     * Set asegurado
     *
     * @param boolean $asegurado
     * @return MntPacienteReferido
     */
    public function setAsegurado($asegurado)
    {
        $this->asegurado = $asegurado;

        return $this;
    }

    /**
     * Get asegurado
     *
     * @return boolean
     */
    public function getAsegurado()
    {
        return $this->asegurado;
    }

    /**
     * Set idSexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idSexo
     * @return MntPacienteReferido
     */
    public function setIdSexo(\Minsal\SiapsBundle\Entity\CtlSexo $idSexo = null)
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    /**
     * Get idSexo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlSexo
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }

    /**
     * Set idUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUser
     * @return MntPacienteReferido
     */
    public function setIdUser(\Application\Sonata\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return MntPacienteReferido
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idAreaCotizacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaCotizante $idAreaCotizacion
     * @return MntPacienteReferido
     */
    public function setIdAreaCotizacion(\Minsal\SiapsBundle\Entity\CtlAreaCotizante $idAreaCotizacion = null)
    {
        $this->idAreaCotizacion = $idAreaCotizacion;

        return $this;
    }

    /**
     * Get idAreaCotizacion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaCotizante
     */
    public function getIdAreaCotizacion()
    {
        return $this->idAreaCotizacion;
    }

     /**
     * Set idModulo
     *
     * @param \Minsal\LaboratorioBundle\Entity\CtlModulo $idModulo
     * @return MntPacienteReferido
     */
    public function setIdModulo(\Minsal\LaboratorioBundle\Entity\CtlModulo $idModulo = null)
    {
        $this->idModulo = $idModulo;

        return $this;
    }

    /**
     * Get idModulo
     *
     * @return \Minsal\LaboratorioBundle\Entity\CtlModulo
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }

     /**
     * Set areaGeograficaDomicilio
     *
     * @param integer $areaGeograficaDomicilio
     * @return MntPacienteReferido
     */
    public function setAreaGeograficaDomicilio($areaGeograficaDomicilio) {
        $this->areaGeograficaDomicilio = $areaGeograficaDomicilio;

        return $this;
    }

    /**
     * Get areaGeograficaDomicilio
     *
     * @return integer
     */
    public function getAreaGeograficaDomicilio() {
        return $this->areaGeograficaDomicilio;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return MntPacienteReferido
     */
    public function setDireccion($direccion) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set idDepartamentoDomicilio
     *
     * @param integer $idDepartamentoDomicilio
     * @return MntPacienteReferido
     */
    public function setIdDepartamentoDomicilio($idDepartamentoDomicilio) {
        $this->idDepartamentoDomicilio = $idDepartamentoDomicilio;

        return $this;
    }

    /**
     * Get idDepartamentoDomicilio
     *
     * @return integer
     */
    public function getIdDepartamentoDomicilio() {
        return $this->idDepartamentoDomicilio;
    }

    /**
     * Set idMunicipioDomicilio
     *
     * @param integer $idMunicipioDomicilio
     * @return MntPacienteReferido
     */
    public function setIdMunicipioDomicilio($idMunicipioDomicilio) {
        $this->idMunicipioDomicilio = $idMunicipioDomicilio;

        return $this;
    }

    /**
     * Get areaGeograficaDomicilio
     *
     * @return integer
     */
    public function getIdMunicipioDomicilio() {
        return $this->idMunicipioDomicilio;
    }

    /**
     * Set idReferenciaOrigen
     *
     * @param integer $idReferenciaOrigen
     * @return MntPacienteReferido
     */
    public function setIdReferenciaOrigen($idReferenciaOrigen) {
        $this->idReferenciaOrigen = $idReferenciaOrigen;

        return $this;
    }

    /**
     * Get idReferenciaOrigen
     *
     * @return integer
     */
    public function getIdReferenciaOrigen() {
        return $this->idReferenciaOrigen;
    }

    public function __toString() {
        return ucfirst(strtolower($this->primerApellido)) . ' ' . ucfirst(strtolower($this->segundoApellido)) . ' ' . ucfirst(strtolower($this->apellidoCasada)) . ', ' . ucfirst(strtolower($this->primerNombre)) . ' ' . ucfirst(strtolower($this->segundoNombre)) ? : '';
    }

    public function getNombrePaciente() {
        return ucfirst(strtolower($this->primerNombre)) . ' ' . ucfirst(strtolower($this->segundoNombre)) . ' ' . ucfirst(strtolower($this->primerApellido)) . ' ' . ucfirst(strtolower($this->segundoApellido)) . ' ' . ucfirst(strtolower($this->apellidoCasada)) ? : '';
    }
}
