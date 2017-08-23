<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarSolicitudFvih
 *
 * @ORM\Table(name="tar_solicitud_fvih", indexes={@ORM\Index(name="IDX_A618C9DFA7C7EF6A", columns={"id_formulario"}), @ORM\Index(name="IDX_A618C9DFD01DB7AA", columns={"id_identidad_genero"}), @ORM\Index(name="IDX_A618C9DF31827296", columns={"id_historial_clinico"}), @ORM\Index(name="IDX_A618C9DFC2612308", columns={"id_datos_clinicos"}), @ORM\Index(name="IDX_A618C9DFAEE2FD4E", columns={"id_datos_manejo"}), @ORM\Index(name="IDX_A618C9DFBF09234F", columns={"id_formas_transmision"}), @ORM\Index(name="IDX_A618C9DF4E236325", columns={"id_indicacion_examen"}), @ORM\Index(name="IDX_A618C9DF63B6488D", columns={"id_motivo_solicitud"}), @ORM\Index(name="IDX_A618C9DF31AFB3AD", columns={"id_orientacion_sexual"}), @ORM\Index(name="IDX_A618C9DF9650C788", columns={"id_grupo_estado_detalle"})})
 * @ORM\Entity(repositoryClass="Minsal\SeguimientoBundle\Repositorio\TarSolicitudFvihRepository")
 */
class TarSolicitudFvih {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tar_solicitud_fvih_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_consejeria", type="boolean", nullable=false)
     */
    private $esConsejeria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_solicitud_sumeve", type="integer", nullable=true)
     */
    private $idSolicitudSumeve;

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
     * @var \CtlIdentidadGenero
     *
     * @ORM\ManyToOne(targetEntity="CtlIdentidadGenero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_identidad_genero", referencedColumnName="id")
     * })
     */
    private $identidadGenero;

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
     * @var \TarDatosClinicos
     *
     * @ORM\ManyToOne(targetEntity="TarDatosClinicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_datos_clinicos", referencedColumnName="id")
     * })
     */
    private $idDatosClinicos;

    /**
     * @var \TarDatosManejo
     *
     * @ORM\ManyToOne(targetEntity="TarDatosManejo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_datos_manejo", referencedColumnName="id")
     * })
     */
    private $idDatosManejo;

    /**
     * @var \TarFormasTransmision
     *
     * @ORM\ManyToOne(targetEntity="TarFormasTransmision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formas_transmision", referencedColumnName="id")
     * })
     */
    private $idFormasTransmision;

    /**
     * @var \TarIndicacionExamen
     *
     * @ORM\ManyToOne(targetEntity="TarIndicacionExamen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_indicacion_examen", referencedColumnName="id")
     * })
     */
    private $idIndicacionExamen;

    /**
     * @var \TarMotivoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="TarMotivoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motivo_solicitud", referencedColumnName="id")
     * })
     */
    private $idMotivoSolicitud;

    /**
     * @var \CtlOrientacionSexual
     *
     * @ORM\ManyToOne(targetEntity="CtlOrientacionSexual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orientacion_sexual", referencedColumnName="id")
     * })
     */
    private $idOrientacionSexual;

    /**
     * @var \CtlGrupoEstadoDetalle
     *
     * @ORM\ManyToOne(targetEntity="CtlGrupoEstadoDetalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_estado_detalle", referencedColumnName="id")
     * })
     */
    private $idGrupoEstadoDetalle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TarFactoresRiesgo", inversedBy="idSolicitudFvih")
     * @ORM\JoinTable(name="tar_sol_factores",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_solicitud_fvih", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_factores_riesgo", referencedColumnName="id")
     *   }
     * )
     */
    private $idFactoresRiesgo;

    /**
     * @var Minsal\SeguimientoBundle\Entity\TarDatosEmbarazada
     *
     * @ORM\OneToOne(targetEntity="Minsal\SeguimientoBundle\Entity\TarDatosEmbarazada", mappedBy="idSolicitud",
     * cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $idDatoEmbarazo;

    /**
     * @var \CtlTipoRelacionSexual
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoRelacionSexual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_relacion_sexual_sin_proteccion", referencedColumnName="id")
     * })
     */
    private $idTipoRelacionSexualSinProteccion;

    /**
     * @var \CtlPoblacionMeta
     *
     * @ORM\ManyToOne(targetEntity="CtlPoblacionMeta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_poblacion_meta", referencedColumnName="id")
     * })
     */
    private $idPoblacionMeta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alfabeta", type="boolean", nullable=true)
     */
    private $alfabeta;

    /**
     * @var \Minsal\SiapsBundle\CtlOcupacion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlOcupacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ocupacion", referencedColumnName="id")
     * })
     */
    private $idOcupacion;

    /**
     * @var \Minsal\SiapsBundle\CtlNivelEducacion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlNivelEducacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_educacion", referencedColumnName="id")
     * })
     */
    private $idNivelEducacion;

    /**
     * Constructor
     */
    public function __construct() {
        $this->idFactoresRiesgo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set esConsejeria
     *
     * @param boolean $esConsejeria
     * @return TarSolicitudFvih
     */
    public function setEsConsejeria($esConsejeria) {
        $this->esConsejeria = $esConsejeria;

        return $this;
    }

    /**
     * Get esConsejeria
     *
     * @return boolean
     */
    public function getEsConsejeria() {
        return $this->esConsejeria;
    }

    /**
     * Set idSolicitudSumeve
     *
     * @param integer $idSolicitudSumeve
     * @return TarSolicitudFvih
     */
    public function setIdSolicitudSumeve($idSolicitudSumeve) {
        $this->idSolicitudSumeve = $idSolicitudSumeve;

        return $this;
    }

    /**
     * Get idSolicitudSumeve
     *
     * @return integer
     */
    public function getIdSolicitudSumeve() {
        return $this->idSolicitudSumeve;
    }

    /**
     * Set idFormulario
     *
     * @param \Application\CoreBundle\Entity\FrmFormulario $idFormulario
     * @return TarSolicitudFvih
     */
    public function setIdFormulario(\Application\CoreBundle\Entity\FrmFormulario $idFormulario = null) {
        $this->idFormulario = $idFormulario;

        return $this;
    }

    /**
     * Get idFormulario
     *
     * @return \Application\CoreBundle\Entity\FrmFormulario
     */
    public function getIdFormulario() {
        return $this->idFormulario;
    }

    /**
     * Set identidadGenero
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero $identidadGenero
     * @return TarSolicitudFvih
     */
    public function setIdentidadGenero(\Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero $identidadGenero = null) {
        $this->identidadGenero = $identidadGenero;

        return $this;
    }

    /**
     * Get identidadGenero
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlIdentidadGenero
     */
    public function getIdentidadGenero() {
        return $this->identidadGenero;
    }

    /**
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return TarSolicitudFvih
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

    /**
     * Set idDatosClinicos
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarDatosClinicos $idDatosClinicos
     * @return TarSolicitudFvih
     */
    public function setIdDatosClinicos(\Minsal\SeguimientoBundle\Entity\TarDatosClinicos $idDatosClinicos = null) {
        $this->idDatosClinicos = $idDatosClinicos;

        return $this;
    }

    /**
     * Get idDatosClinicos
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarDatosClinicos
     */
    public function getIdDatosClinicos() {
        return $this->idDatosClinicos;
    }

    /**
     * Set idDatosManejo
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarDatosManejo $idDatosManejo
     * @return TarSolicitudFvih
     */
    public function setIdDatosManejo(\Minsal\SeguimientoBundle\Entity\TarDatosManejo $idDatosManejo = null) {
        $this->idDatosManejo = $idDatosManejo;

        return $this;
    }

    /**
     * Get idDatosManejo
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarDatosManejo
     */
    public function getIdDatosManejo() {
        return $this->idDatosManejo;
    }

    /**
     * Set idFormasTransmision
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarFormasTransmision $idFormasTransmision
     * @return TarSolicitudFvih
     */
    public function setIdFormasTransmision(\Minsal\SeguimientoBundle\Entity\TarFormasTransmision $idFormasTransmision = null) {
        $this->idFormasTransmision = $idFormasTransmision;

        return $this;
    }

    /**
     * Get idFormasTransmision
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarFormasTransmision
     */
    public function getIdFormasTransmision() {
        return $this->idFormasTransmision;
    }

    /**
     * Set idIndicacionExamen
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarIndicacionExamen $idIndicacionExamen
     * @return TarSolicitudFvih
     */
    public function setIdIndicacionExamen(\Minsal\SeguimientoBundle\Entity\TarIndicacionExamen $idIndicacionExamen = null) {
        $this->idIndicacionExamen = $idIndicacionExamen;

        return $this;
    }

    /**
     * Get idIndicacionExamen
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarIndicacionExamen
     */
    public function getIdIndicacionExamen() {
        return $this->idIndicacionExamen;
    }

    /**
     * Set idMotivoSolicitud
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarMotivoSolicitud $idMotivoSolicitud
     * @return TarSolicitudFvih
     */
    public function setIdMotivoSolicitud(\Minsal\SeguimientoBundle\Entity\TarMotivoSolicitud $idMotivoSolicitud = null) {
        $this->idMotivoSolicitud = $idMotivoSolicitud;

        return $this;
    }

    /**
     * Get idMotivoSolicitud
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarMotivoSolicitud
     */
    public function getIdMotivoSolicitud() {
        return $this->idMotivoSolicitud;
    }

    /**
     * Set idOrientacionSexual
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual $idOrientacionSexual
     * @return TarSolicitudFvih
     */
    public function setIdOrientacionSexual(\Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual $idOrientacionSexual = null) {
        $this->idOrientacionSexual = $idOrientacionSexual;

        return $this;
    }

    /**
     * Get idOrientacionSexual
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlOrientacionSexual
     */
    public function getIdOrientacionSexual() {
        return $this->idOrientacionSexual;
    }

    /**
     * Set idGrupoEstadoDetalle
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlGrupoEstadoDetalle $idGrupoEstadoDetalle
     * @return TarSolicitudFvih
     */
    public function setIdGrupoEstadoDetalle(\Minsal\SeguimientoBundle\Entity\CtlGrupoEstadoDetalle $idGrupoEstadoDetalle = null) {
        $this->idGrupoEstadoDetalle = $idGrupoEstadoDetalle;

        return $this;
    }

    /**
     * Get idGrupoEstadoDetalle
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlGrupoEstadoDetalle
     */
    public function getIdGrupoEstadoDetalle() {
        return $this->idGrupoEstadoDetalle;
    }

    /**
     * Add idFactoresRiesgo
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarFactoresRiesgo $idFactoresRiesgo
     * @return TarSolicitudFvih
     */
    public function addIdFactoresRiesgo(\Minsal\SeguimientoBundle\Entity\TarFactoresRiesgo $idFactoresRiesgo) {
        $this->idFactoresRiesgo[] = $idFactoresRiesgo;

        return $this;
    }

    /**
     * Remove idFactoresRiesgo
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarFactoresRiesgo $idFactoresRiesgo
     */
    public function removeIdFactoresRiesgo(\Minsal\SeguimientoBundle\Entity\TarFactoresRiesgo $idFactoresRiesgo) {
        $this->idFactoresRiesgo->removeElement($idFactoresRiesgo);
    }

    /**
     * Get idFactoresRiesgo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdFactoresRiesgo() {
        return $this->idFactoresRiesgo;
    }


    /**
     * Set idDatoEmbarazo
     *
     * @param \Minsal\SeguimientoBundle\Entity\TarDatosEmbarazada $idDatoEmbarazo
     * @return TarSolicitudFvih
     */
    public function setIdDatoEmbarazo(\Minsal\SeguimientoBundle\Entity\TarDatosEmbarazada $idDatoEmbarazo = null)
    {
        $this->idDatoEmbarazo = $idDatoEmbarazo;

        return $this;
    }

    /**
     * Get idDatoEmbarazo
     *
     * @return \Minsal\SeguimientoBundle\Entity\TarDatosEmbarazada
     */
    public function getIdDatoEmbarazo()
    {
        return $this->idDatoEmbarazo;
    }

    /**
     * Set idPoblacionMeta
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlPoblacionMeta $idPoblacionMeta
     * @return TarSolicitudFvih
     */
    public function setIdPoblacionMeta(\Minsal\SeguimientoBundle\Entity\CtlPoblacionMeta $idPoblacionMeta = null) {
        $this->idPoblacionMeta = $idPoblacionMeta;

        return $this;
    }

    /**
     * Get idPoblacionMeta
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlPoblacionMeta
     */
    public function getIdPoblacionMeta() {
        return $this->idPoblacionMeta;
    }

    /**
     * Set idTipoRelacionSexualSinProteccion
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoRelacionSexual $idTipoRelacionSexualSinProteccion
     * @return TarSolicitudFvih
     */
    public function setIdTipoRelacionSexualSinProteccion(\Minsal\SeguimientoBundle\Entity\CtlTipoRelacionSexual $idTipoRelacionSexualSinProteccion = null) {
        $this->idTipoRelacionSexualSinProteccion = $idTipoRelacionSexualSinProteccion;

        return $this;
    }

    /**
     * Get idTipoRelacionSexualSinProteccion
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoRelacionSexual
     */
    public function getIdTipoRelacionSexualSinProteccion() {
        return $this->idTipoRelacionSexualSinProteccion;
    }

    /**
     * Set alfabeta
     *
     * @param boolean $alfabeta
     * @return TarSecTar
     */
    public function setAlfabeta($alfabeta)
    {
        $this->alfabeta = $alfabeta;

        return $this;
    }

    /**
     * Get alfabeta
     *
     * @return boolean
     */
    public function getAlfabeta()
    {
        return $this->alfabeta;
    }

    /**
     * Set idOcupacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlOcupacion $idOcupacion
     * @return TarSolicitudFvih
     */
    public function setIdOcupacion(\Minsal\SiapsBundle\Entity\CtlOcupacion $idOcupacion = null) {
        $this->idOcupacion = $idOcupacion;

        return $this;
    }

    /**
     * Get idOcupacion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlOcupacion
     */
    public function getIdOcupacion() {
        return $this->idOcupacion;
    }

    /**
     * Set idNivelEducacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlNivelEducacion $idNivelEducacion
     * @return TarSolicitudFvih
     */
    public function setIdNivelEducacion(\Minsal\SiapsBundle\Entity\CtlNivelEducacion $idNivelEducacion = null) {
        $this->idNivelEducacion = $idNivelEducacion;

        return $this;
    }

    /**
     * Get idNivelEducacion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlNivelEducacion
     */
    public function getIdNivelEducacion() {
        return $this->idNivelEducacion;
    }


}
