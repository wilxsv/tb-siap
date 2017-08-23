<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FarmMedicinarecetada
 *
 * @ORM\Table(name="farm_medicinarecetada", indexes={@ORM\Index(name="IDX_D91F469BF58EA699", columns={"idmedicina"}), @ORM\Index(name="IDX_D91F469BD42EE4E2", columns={"idreceta"}), @ORM\Index(name="IDX_D91F469B1AE88AD7", columns={"idareadispensa"}), @ORM\Index(name="IDX_D91F469BB81FA06E", columns={"idareaorigen"})})
 * @ORM\Entity
 */
class FarmMedicinarecetada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="farm_medicinarecetada_idmedicinarecetada_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=11, scale=3, nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="dosis", type="text", nullable=false)
     */
    private $dosis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaentrega", type="date", nullable=true)
     */
    private $fechaentrega;

    /**
     * @var string
     *
     * @ORM\Column(name="idestado", type="string", nullable=true)
     */
    private $idestado;

    /**
     * @var \Minsal\FarmaciaBundle\Entity\FarmEstados
     *
     * @ORM\ManyToOne(targetEntity="Minsal\FarmaciaBundle\Entity\FarmEstados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estados", referencedColumnName="id")
     * })
     */
    private $idEstados;


    /**
     * @var \Minsal\SiapsBundle\Entity\Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

     /**
     * @var \Minsal\SiapsBundle\Entity\Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlModalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmodalidad", referencedColumnName="id")
     * })
     */
    private $idmodalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="frecuencia", type="integer", nullable=true)
     */
    private $frecuencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_frecuencia", type="string", length=10, nullable=false)
     */
    private $tiempoFrecuencia;

    /**
     * @var string
     *
     * @ORM\Column(name="durante", type="string", length=10, nullable=false)
     */
    private $durante;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_durante", type="string", length=10, nullable=false)
     */
    private $tiempoDurante;

    /**
     * @var string
     *
     * @ORM\Column(name="total_medicamento", type="string", length=10, nullable=false)
     */
    private $totalMedicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendacion", type="text", nullable=false)
     */
    private $recomendacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_medicamento", type="decimal", precision=11, scale=3, nullable=false)
     */
    private $cantidadMedicamento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="distribucion_especial", type="boolean", nullable=true)
     */
    private $distribucionEspecial=false;

    /**
     * @var string
     *
     * @ORM\Column(name="sincronizadofc", type="string", length=1, nullable=false)
     */
    private $sincronizadofc;

    /**
     * @var \FarmCatalogoproductos
     *
     * @ORM\ManyToOne(targetEntity="FarmCatalogoproductos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmedicina", referencedColumnName="id")
     * })
     */
    private $idmedicina;

    /**
     * @var \FarmRecetas
     *
     * @ORM\ManyToOne(targetEntity="FarmRecetas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idreceta", referencedColumnName="id")
     * })
     */
    private $idreceta;

    /**
     * @var \MntAreafarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntAreafarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idareadispensa", referencedColumnName="id")
     * })
     */
    private $idareadispensa;

    /**
     * @var \MntAreafarmacia
     *
     * @ORM\ManyToOne(targetEntity="MntAreafarmacia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idareaorigen", referencedColumnName="id")
     * })
     */
    private $idareaorigen;

    /**
     * @ORM\OneToMany(targetEntity="FarmMedicinaDistribucion", mappedBy="idMedicinaRecetada")
     */
    private $distribuciones;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_prescripcion", type="text", nullable=false)
     */
    private $justificacionPrescripcion;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_despacha", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoDespacha;

    /**
     * @var \Minsal\FarmaciaBundle\Entity\FarmDosificacion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\FarmaciaBundle\Entity\FarmDosificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_dosificacion", referencedColumnName="id")
     * })
     */
    private $idDosificacion;

    public function __construct() {
        $this->distribuciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return FarmMedicinarecetada
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set dosis
     *
     * @param string $dosis
     * @return FarmMedicinarecetada
     */
    public function setDosis($dosis)
    {
        $this->dosis = $dosis;

        return $this;
    }

    /**
     * Get dosis
     *
     * @return string
     */
    public function getDosis()
    {
        return $this->dosis;
    }

    /**
     * Set fechaentrega
     *
     * @param \DateTime $fechaentrega
     * @return FarmMedicinarecetada
     */
    public function setFechaentrega($fechaentrega)
    {
        $this->fechaentrega = $fechaentrega;

        return $this;
    }

    /**
     * Get fechaentrega
     *
     * @return \DateTime
     */
    public function getFechaentrega()
    {
        return $this->fechaentrega;
    }

    /**
     * Set idestado
     *
     * @param string $idestado
     * @return FarmMedicinarecetada
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
     * Set frecuencia
     *
     * @param integer $frecuencia
     * @return FarmMedicinarecetada
     */
    public function setFrecuencia($frecuencia)
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    /**
     * Get frecuencia
     *
     * @return integer
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    /**
     * Set tiempoFrecuencia
     *
     * @param string $tiempoFrecuencia
     * @return FarmMedicinarecetada
     */
    public function setTiempoFrecuencia($tiempoFrecuencia)
    {
        $this->tiempoFrecuencia = $tiempoFrecuencia;

        return $this;
    }

    /**
     * Get tiempoFrecuencia
     *
     * @return string
     */
    public function getTiempoFrecuencia()
    {
        return $this->tiempoFrecuencia;
    }

    /**
     * Set durante
     *
     * @param string $durante
     * @return FarmMedicinarecetada
     */
    public function setDurante($durante)
    {
        $this->durante = $durante;

        return $this;
    }

    /**
     * Get durante
     *
     * @return string
     */
    public function getDurante()
    {
        return $this->durante;
    }

    /**
     * Set tiempoDurante
     *
     * @param string $tiempoDurante
     * @return FarmMedicinarecetada
     */
    public function setTiempoDurante($tiempoDurante)
    {
        $this->tiempoDurante = $tiempoDurante;

        return $this;
    }

    /**
     * Get tiempoDurante
     *
     * @return string
     */
    public function getTiempoDurante()
    {
        return $this->tiempoDurante;
    }

    /**
     * Set totalMedicamento
     *
     * @param string $totalMedicamento
     * @return FarmMedicinarecetada
     */
    public function setTotalMedicamento($totalMedicamento)
    {
        $this->totalMedicamento = $totalMedicamento;

        return $this;
    }

    /**
     * Get totalMedicamento
     *
     * @return string
     */
    public function getTotalMedicamento()
    {
        return $this->totalMedicamento;
    }

    /**
     * Set recomendacion
     *
     * @param string $recomendacion
     * @return FarmMedicinarecetada
     */
    public function setRecomendacion($recomendacion)
    {
        $this->recomendacion = $recomendacion;

        return $this;
    }

    /**
     * Get recomendacion
     *
     * @return string
     */
    public function getRecomendacion()
    {
        return $this->recomendacion;
    }

    /**
     * Set cantidadMedicamento
     *
     * @param integer $cantidadMedicamento
     * @return FarmMedicinarecetada
     */
    public function setCantidadMedicamento($cantidadMedicamento)
    {
        $this->cantidadMedicamento = $cantidadMedicamento;

        return $this;
    }

    /**
     * Get cantidadMedicamento
     *
     * @return integer
     */
    public function getCantidadMedicamento()
    {
        return $this->cantidadMedicamento;
    }



    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return FarmMedicinarecetada
     */
    public function setIdestablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento = null)
    {
        $this->idestablecimiento = $idestablecimiento;

        return $this;
    }

    /**
     * Get idestablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdestablecimiento()
    {
        return $this->idestablecimiento;
    }

    /**
     * Set idmodalidad
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad
     * @return FarmMedicinarecetada
     */
    public function setIdmodalidad(\Minsal\SiapsBundle\Entity\CtlModalidad $idmodalidad = null)
    {
        $this->idmodalidad = $idmodalidad;

        return $this;
    }

    /**
     * Get idmodalidad
     *
     * @return \Minsal\SiapsBundle\Entity\CtlModalidad
     */
    public function getIdmodalidad()
    {
        return $this->idmodalidad;
    }

    /**
     * Set idmedicina
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmCatalogoproductos $idmedicina
     * @return FarmMedicinarecetada
     */
    public function setIdmedicina(\Minsal\FarmaciaBundle\Entity\FarmCatalogoproductos $idmedicina = null)
    {
        $this->idmedicina = $idmedicina;

        return $this;
    }

    /**
     * Get idmedicina
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmCatalogoproductos
     */
    public function getIdmedicina()
    {
        return $this->idmedicina;
    }

    /**
     * Set idreceta
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmRecetas $idreceta
     * @return FarmMedicinarecetada
     */
    public function setIdreceta(\Minsal\FarmaciaBundle\Entity\FarmRecetas $idreceta = null)
    {
        $this->idreceta = $idreceta;

        return $this;
    }

    /**
     * Get idreceta
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmRecetas
     */
    public function getIdreceta()
    {
        return $this->idreceta;
    }

    /**
     * Set idareadispensa
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idareadispensa
     * @return FarmMedicinarecetada
     */
    public function setIdareadispensa(\Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idareadispensa = null)
    {
        $this->idareadispensa = $idareadispensa;

        return $this;
    }

    /**
     * Get idareadispensa
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntAreafarmacia
     */
    public function getIdareadispensa()
    {
        return $this->idareadispensa;
    }

    /**
     * Set idareaorigen
     *
     * @param \Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idareaorigen
     * @return FarmMedicinarecetada
     */
    public function setIdareaorigen(\Minsal\FarmaciaBundle\Entity\MntAreafarmacia $idareaorigen = null)
    {
        $this->idareaorigen = $idareaorigen;

        return $this;
    }

    /**
     * Get idareaorigen
     *
     * @return \Minsal\FarmaciaBundle\Entity\MntAreafarmacia
     */
    public function getIdareaorigen()
    {
        return $this->idareaorigen;
    }

    /**
     * Set distribucionEspecial
     *
     * @param boolean $distribucionEspecial
     * @return FarmMedicinarecetada
     */
    public function setDistribucionEspecial($distribucionEspecial)
    {
        $this->distribucionEspecial = $distribucionEspecial;

        return $this;
    }

    /**
     * Get distribucionEspecial
     *
     * @return boolean
     */
    public function getDistribucionEspecial()
    {
        return $this->distribucionEspecial;
    }

    public function getNombreMedicamentoReceta(){
        return $this->idmedicina->getNombre().'-'.$this->idmedicina->getFormafarmaceutica();
    }

    /**
     * Add distribuciones
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion $distribuciones
     * @return FarmMedicinarecetada
     */
    public function addDistribucione(\Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion $distribuciones)
    {
        $this->distribuciones[] = $distribuciones;

        return $this;
    }

    /**
     * Remove distribuciones
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion $distribuciones
     */
    public function removeDistribucione(\Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion $distribuciones)
    {
        $this->distribuciones->removeElement($distribuciones);
    }

    /**
     * Get distribuciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDistribuciones()
    {
        return $this->distribuciones;
    }

    /**
     * Set justificacionPrescripcion
     *
     * @param string $justificacionPrescripcion
     * @return FarmMedicinarecetada
     */
    public function setJustificacionPrescripcion($justificacionPrescripcion)
    {
        $this->justificacionPrescripcion = $justificacionPrescripcion;

        return $this;
    }

    /**
     * Get justificacionPrescripcion
     *
     * @return string
     */
    public function getJustificacionPrescripcion()
    {
        return $this->justificacionPrescripcion;
    }


    /**
     * Set idEstablecimientoDespacha
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return FarmMedicinarecetada
     */
    public function setIdEstablecimientoDespacha(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoDespacha = null)
    {
        $this->idEstablecimientoDespacha = $idEstablecimientoDespacha;

        return $this;
    }

    /**
     * Get idEstablecimientoDespacha
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoDespacha()
    {
        return $this->idEstablecimientoDespacha;
    }

    /**
     * Set idEstados
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmEstados $idEstados
     * @return FarmMedicinarecetada
     */
    public function setIdEstados(\Minsal\FarmaciaBundle\Entity\FarmEstados $idEstados = null)
    {
        $this->idEstados = $idEstados;

        return $this;
    }

    /**
     * Get idEstados
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmEstados
     */
    public function getIdEstados()
    {
        return $this->idEstados;
    }

    /**
     * Set idDosificacion
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmDosificacion $idDosificacion
     * @return FarmMedicinarecetada
     */
    public function setIdDosificacion(\Minsal\FarmaciaBundle\Entity\FarmDosificacion $idDosificacion = null)
    {
        $this->idDosificacion = $idDosificacion;

        return $this;
    }

    /**
     * Get idDosificacion
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmDosificacion
     */
    public function getIdDosificacion()
    {
        return $this->idDosificacion;
    }

    /**
     * Set sincronizadofc
     *
     * @param string $sincronizadofc
     * @return FarmMedicinarecetada
     */
    public function setSincronizadofc($sincronizadofc)
    {
        $this->sincronizadofc = $sincronizadofc;

        return $this;
    }

    /**
     * Get sincronizadofc
     *
     * @return string
     */
    public function getSincronizadofc()
    {
        return $this->$sincronizadofc;
    }


}
