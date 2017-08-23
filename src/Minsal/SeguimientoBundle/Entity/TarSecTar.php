<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarSecTar
 *
 * @ORM\Table(name="tar_sec_tar", indexes={@ORM\Index(name="IDX_105A39A6A7C7EF6A", columns={"id_formulario"}), @ORM\Index(name="IDX_105A39A631827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_105A39A671EE8D58", columns={"id_clasificacion_clinica"}), @ORM\Index(name="IDX_105A39A6F6533EF7", columns={"id_criterio_cambio"}), @ORM\Index(name="IDX_105A39A6140653E8", columns={"id_motivo_indicacion"}), @ORM\Index(name="IDX_105A39A6F5D10954", columns={"id_motivo_profilaxis"}), @ORM\Index(name="IDX_105A39A613952486", columns={"id_motivo_tar"}), @ORM\Index(name="IDX_105A39A6197798D8", columns={"id_tipo_egreso"}), @ORM\Index(name="IDX_105A39A6AE2622F2", columns={"id_tipo_paciente"}), @ORM\Index(name="IDX_105A39A621DE3841", columns={"id_tipo_poblacion"})})
 * @ORM\Entity
 */
class TarSecTar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_sec_tar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_inicio_arv", type="boolean", nullable=false)
     */
    private $esInicioArv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_profilaxis", type="boolean", nullable=false)
     */
    private $esProfilaxis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio_arv", type="date", nullable=true)
     */
    private $fechaInicioArv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_profilaxis_isoniacida", type="boolean", nullable=true)
     */
    private $esProfilaxisIsoniacida;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_profilaxis_tmp_smz", type="boolean", nullable=true)
     */
    private $esProfilaxisTmpSmz;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_profilaxis_materna", type="boolean", nullable=true)
     */
    private $esProfilaxisMaterna;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \Application\CoreBundle\FrmFormulario
     *
     * @ORM\ManyToOne(targetEntity="Application\CoreBundle\Entity\FrmFormulario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formulario", referencedColumnName="id")
     * })
     */
    private $idFormulario;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historial_clinico", referencedColumnName="id")
     * })
     */
    private $idHistorialClinico;

    /**
     * @var \TarClasificacionClinica
     *
     * @ORM\ManyToOne(targetEntity="TarClasificacionClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_clasificacion_clinica", referencedColumnName="id")
     * })
     */
    private $idClasificacionClinica;

    /**
     * @var \TarCriterioCambio
     *
     * @ORM\ManyToOne(targetEntity="TarCriterioCambio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_criterio_cambio", referencedColumnName="id")
     * })
     */
    private $idCriterioCambio;

    /**
     * @var \TarMotivoIndicacion
     *
     * @ORM\ManyToOne(targetEntity="TarMotivoIndicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_indicacion", referencedColumnName="id")
     * })
     */
    private $idMotivoIndicacion;

    /**
     * @var \TarMotivoProfilaxis
     *
     * @ORM\ManyToOne(targetEntity="TarMotivoProfilaxis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_profilaxis", referencedColumnName="id")
     * })
     */
    private $idMotivoProfilaxis;

    /**
     * @var \TarMotivoTar
     *
     * @ORM\ManyToOne(targetEntity="TarMotivoTar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_tar", referencedColumnName="id")
     * })
     */
    private $idMotivoTar;

    /**
     * @var \TarTipoEgreso
     *
     * @ORM\ManyToOne(targetEntity="TarTipoEgreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_egreso", referencedColumnName="id")
     * })
     */
    private $idTipoEgreso;

    /**
     * @var \TarTipoPaciente
     *
     * @ORM\ManyToOne(targetEntity="TarTipoPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_paciente", referencedColumnName="id")
     * })
     */
    private $idTipoPaciente;

    /**
     * @var \TarTipoPoblacion
     *
     * @ORM\ManyToOne(targetEntity="TarTipoPoblacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_poblacion", referencedColumnName="id")
     * })
     */
    private $idTipoPoblacion;

    
    public function __toString() {
        return 'Ficha TAR';
    }

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
     * Set esInicioArv
     *
     * @param boolean $esInicioArv
     * @return TarSecTar
     */
    public function setEsInicioArv($esInicioArv)
    {
        $this->esInicioArv = $esInicioArv;

        return $this;
    }

    /**
     * Get esInicioArv
     *
     * @return boolean 
     */
    public function getEsInicioArv()
    {
        return $this->esInicioArv;
    }

    /**
     * Set esProfilaxis
     *
     * @param boolean $esProfilaxis
     * @return TarSecTar
     */
    public function setEsProfilaxis($esProfilaxis)
    {
        $this->esProfilaxis = $esProfilaxis;

        return $this;
    }

    /**
     * Get esProfilaxis
     *
     * @return boolean 
     */
    public function getEsProfilaxis()
    {
        return $this->esProfilaxis;
    }

    /**
     * Set fechaInicioArv
     *
     * @param \DateTime $fechaInicioArv
     * @return TarSecTar
     */
    public function setFechaInicioArv($fechaInicioArv)
    {
        $this->fechaInicioArv = $fechaInicioArv;

        return $this;
    }

    /**
     * Get fechaInicioArv
     *
     * @return \DateTime 
     */
    public function getFechaInicioArv()
    {
        return $this->fechaInicioArv;
    }

    /**
     * Set esProfilaxisIsoniacida
     *
     * @param boolean $esProfilaxisIsoniacida
     * @return TarSecTar
     */
    public function setEsProfilaxisIsoniacida($esProfilaxisIsoniacida)
    {
        $this->esProfilaxisIsoniacida = $esProfilaxisIsoniacida;

        return $this;
    }

    /**
     * Get esProfilaxisIsoniacida
     *
     * @return boolean 
     */
    public function getEsProfilaxisIsoniacida()
    {
        return $this->esProfilaxisIsoniacida;
    }

    /**
     * Set esProfilaxisTmpSmz
     *
     * @param boolean $esProfilaxisTmpSmz
     * @return TarSecTar
     */
    public function setEsProfilaxisTmpSmz($esProfilaxisTmpSmz)
    {
        $this->esProfilaxisTmpSmz = $esProfilaxisTmpSmz;

        return $this;
    }

    /**
     * Get esProfilaxisTmpSmz
     *
     * @return boolean 
     */
    public function getEsProfilaxisTmpSmz()
    {
        return $this->esProfilaxisTmpSmz;
    }

    /**
     * Set esProfilaxisMaterna
     *
     * @param boolean $esProfilaxisMaterna
     * @return TarSecTar
     */
    public function setEsProfilaxisMaterna($esProfilaxisMaterna)
    {
        $this->esProfilaxisMaterna = $esProfilaxisMaterna;

        return $this;
    }

    /**
     * Get esProfilaxisMaterna
     *
     * @return boolean 
     */
    public function getEsProfilaxisMaterna()
    {
        return $this->esProfilaxisMaterna;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return TarSecTar
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmFormulario $idFormulario
     * @return TarSecTar
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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return TarSecTar
     */
    public function setIdHistorialClinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico = null)
    {
        $this->idHistorialClinico = $idHistorialClinico;

        return $this;
    }

    /**
     * Get idHistorialClinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico 
     */
    public function getIdHistorialClinico()
    {
        return $this->idHistorialClinico;
    }

    /**
     * Set idClasificacionClinica
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarClasificacionClinica $idClasificacionClinica
     * @return TarSecTar
     */
    public function setIdClasificacionClinica(\Minsal\SeguimientoBundle\Entity\TarClasificacionClinica $idClasificacionClinica = null)
    {
        $this->idClasificacionClinica = $idClasificacionClinica;

        return $this;
    }

    /**
     * Get idClasificacionClinica
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarClasificacionClinica 
     */
    public function getIdClasificacionClinica()
    {
        return $this->idClasificacionClinica;
    }

    /**
     * Set idCriterioCambio
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarCriterioCambio $idCriterioCambio
     * @return TarSecTar
     */
    public function setIdCriterioCambio(\Minsal\SeguimientoBundle\Entity\TarCriterioCambio $idCriterioCambio = null)
    {
        $this->idCriterioCambio = $idCriterioCambio;

        return $this;
    }

    /**
     * Get idCriterioCambio
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarCriterioCambio 
     */
    public function getIdCriterioCambio()
    {
        return $this->idCriterioCambio;
    }

    /**
     * Set idMotivoIndicacion
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarMotivoIndicacion $idMotivoIndicacion
     * @return TarSecTar
     */
    public function setIdMotivoIndicacion(\Minsal\SeguimientoBundle\Entity\TarMotivoIndicacion $idMotivoIndicacion = null)
    {
        $this->idMotivoIndicacion = $idMotivoIndicacion;

        return $this;
    }

    /**
     * Get idMotivoIndicacion
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarMotivoIndicacion 
     */
    public function getIdMotivoIndicacion()
    {
        return $this->idMotivoIndicacion;
    }

    /**
     * Set idMotivoProfilaxis
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarMotivoProfilaxis $idMotivoProfilaxis
     * @return TarSecTar
     */
    public function setIdMotivoProfilaxis(\Minsal\SeguimientoBundle\Entity\TarMotivoProfilaxis $idMotivoProfilaxis = null)
    {
        $this->idMotivoProfilaxis = $idMotivoProfilaxis;

        return $this;
    }

    /**
     * Get idMotivoProfilaxis
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarMotivoProfilaxis 
     */
    public function getIdMotivoProfilaxis()
    {
        return $this->idMotivoProfilaxis;
    }

    /**
     * Set idMotivoTar
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarMotivoTar $idMotivoTar
     * @return TarSecTar
     */
    public function setIdMotivoTar(\Minsal\SeguimientoBundle\Entity\TarMotivoTar $idMotivoTar = null)
    {
        $this->idMotivoTar = $idMotivoTar;

        return $this;
    }

    /**
     * Get idMotivoTar
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarMotivoTar 
     */
    public function getIdMotivoTar()
    {
        return $this->idMotivoTar;
    }

    /**
     * Set idTipoEgreso
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarTipoEgreso $idTipoEgreso
     * @return TarSecTar
     */
    public function setIdTipoEgreso(\Minsal\SeguimientoBundle\Entity\TarTipoEgreso $idTipoEgreso = null)
    {
        $this->idTipoEgreso = $idTipoEgreso;

        return $this;
    }

    /**
     * Get idTipoEgreso
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarTipoEgreso 
     */
    public function getIdTipoEgreso()
    {
        return $this->idTipoEgreso;
    }

    /**
     * Set idTipoPaciente
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarTipoPaciente $idTipoPaciente
     * @return TarSecTar
     */
    public function setIdTipoPaciente(\Minsal\SeguimientoBundle\Entity\TarTipoPaciente $idTipoPaciente = null)
    {
        $this->idTipoPaciente = $idTipoPaciente;

        return $this;
    }

    /**
     * Get idTipoPaciente
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarTipoPaciente 
     */
    public function getIdTipoPaciente()
    {
        return $this->idTipoPaciente;
    }

    /**
     * Set idTipoPoblacion
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarTipoPoblacion $idTipoPoblacion
     * @return TarSecTar
     */
    public function setIdTipoPoblacion(\Minsal\SeguimientoBundle\Entity\TarTipoPoblacion $idTipoPoblacion = null)
    {
        $this->idTipoPoblacion = $idTipoPoblacion;

        return $this;
    }

    /**
     * Get idTipoPoblacion
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarTipoPoblacion 
     */
    public function getIdTipoPoblacion()
    {
        return $this->idTipoPoblacion;
    }
}
