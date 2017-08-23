<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FrmGrupoFormulario
 *
 * @ORM\Table(name="frm_grupo_formulario", indexes={@ORM\Index(name="IDX_DE60FB56695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_DE60FB56422A96FE", columns={"id_rango_edad"}), @ORM\Index(name="IDX_DE60FB569CC1698E", columns={"id_condicion_persona"}), @ORM\Index(name="IDX_DE60FB56A7C7EF6A", columns={"id_formulario"}), @ORM\Index(name="IDX_DE60FB56695EA359", columns={"id_sexo"})})
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\FrmGrupoFormularioRepository")
 * @UniqueEntity(fields={"idFormulario","idAtencion","idSexo","idRangoEdad","idCondicionPersona"}, errorPath="idFormulario", message="Ya existe una clasificacion similar registrada en la BD.")
 */
class FrmGrupoFormulario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="frm_grupo_formulario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="primera_vez", type="boolean", nullable=false)
     */
    private $primeraVez = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="\Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * @var \CtlCondicionPersona
     *
     * @ORM\ManyToOne(targetEntity="CtlCondicionPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_condicion_persona", referencedColumnName="id")
     * })
     */
    private $idCondicionPersona;

    /**
     * @var \Application\CoreBundle\Entity\FrmFormulario
     *
     * @ORM\ManyToOne(targetEntity="\Application\CoreBundle\Entity\FrmFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formulario", referencedColumnName="id")
     * })
     */
    private $idFormulario;

    /**
     * @var \CtlRangoEdad
     *
     * @ORM\ManyToOne(targetEntity="CtlRangoEdad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rango_edad", referencedColumnName="id")
     * })
     */
    private $idRangoEdad;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="\Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=true)
     */
    private $prioridad;



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
     * Set primeraVez
     *
     * @param boolean $primeraVez
     * @return FrmGrupoFormulario
     */
    public function setPrimeraVez($primeraVez)
    {
        $this->primeraVez = $primeraVez;

        return $this;
    }

    /**
     * Get primeraVez
     *
     * @return boolean 
     */
    public function getPrimeraVez()
    {
        return $this->primeraVez;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return FrmGrupoFormulario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return FrmGrupoFormulario
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

    /**
     * Set idCondicionPersona
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlCondicionPersona $idCondicionPersona
     * @return FrmGrupoFormulario
     */
    public function setIdCondicionPersona(\Minsal\SeguimientoBundle\Entity\CtlCondicionPersona $idCondicionPersona = null)
    {
        $this->idCondicionPersona = $idCondicionPersona;

        return $this;
    }

    /**
     * Get idCondicionPersona
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlCondicionPersona 
     */
    public function getIdCondicionPersona()
    {
        return $this->idCondicionPersona;
    }

    /**
     * Set idFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmFormulario $idFormulario
     * @return FrmGrupoFormulario
     */
    public function setIdFormulario(\Application\CoreBundle\Entity\FrmFormulario $idFormulario = null)
    {
        $this->idFormulario = $idFormulario;

        return $this;
    }

    /**
     * Get idFormulario
     *
     * @return \Application\CoreBundle\Entity\FrmFormulario 
     */
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }

    /**
     * Set idRangoEdad
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idRangoEdad
     * @return FrmGrupoFormulario
     */
    public function setIdRangoEdad(\Minsal\SeguimientoBundle\Entity\CtlRangoEdad $idRangoEdad = null)
    {
        $this->idRangoEdad = $idRangoEdad;

        return $this;
    }

    /**
     * Get idRangoEdad
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlRangoEdad 
     */
    public function getIdRangoEdad()
    {
        return $this->idRangoEdad;
    }

    /**
     * Set idSexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idSexo
     * @return FrmGrupoFormulario
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
     * Set prioridad
     *
     * @param integer $prioridad
     * @return FrmGrupoFormulario
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }
}
