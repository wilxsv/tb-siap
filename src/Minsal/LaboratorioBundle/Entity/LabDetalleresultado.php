<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabDetalleresultado
 *
 * @ORM\Table(name="lab_detalleresultado", indexes={@ORM\Index(name="fki_resultados_detalleresultado", columns={"idresultado"}), @ORM\Index(name="fki_subelemento_detalleresultado", columns={"idsubelemento"}), @ORM\Index(name="fki_baterias_detalleresultado", columns={"idbacteria"}), @ORM\Index(name="fki_elementos_detalleresultado", columns={"idelemento"}), @ORM\Index(name="fki_cantidad_detalleresultado", columns={"idcantidad"}), @ORM\Index(name="fki_tarjeta_detalleresultado", columns={"idtarjeta"}), @ORM\Index(name="fki_establecimiento", columns={"idestablecimiento"}), @ORM\Index(name="fki_procedimientos", columns={"idprocedimiento"}), @ORM\Index(name="IDX_3013028D3130FF2C", columns={"id_elementotincion"}), @ORM\Index(name="IDX_3013028D19211949", columns={"id_posible_resultado"}), @ORM\Index(name="IDX_3013028DAF62D408", columns={"id_posresult_elemento_referido"}), @ORM\Index(name="IDX_3013028D3B05AA65", columns={"id_posresult_subelemento_referido"})})
 * @ORM\Entity
 */
class LabDetalleresultado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_detalleresultado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=200, nullable=true)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="text", nullable=true)
     */
    private $cantidad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_referido", type="boolean", nullable=true)
     */
    private $bReferido = false;

    /**
     * @var string
     *
     * @ORM\Column(name="elemento_referido", type="string", length=150, nullable=true)
     */
    private $elementoReferido;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado_elemento_referido", type="string", length=300, nullable=true)
     */
    private $resultadoElementoReferido;

    /**
     * @var string
     *
     * @ORM\Column(name="subelemento_referido", type="string", length=150, nullable=true)
     */
    private $subelementoReferido;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado_subelemento_referido", type="string", length=300, nullable=true)
     */
    private $resultadoSubelementoReferido;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad_elemento_referido", type="string", length=30, nullable=true)
     */
    private $unidadElementoReferido;

    /**
     * @var float
     *
     * @ORM\Column(name="rangoinicio_elemento_referido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangoinicioElementoReferido;

    /**
     * @var float
     *
     * @ORM\Column(name="rangofin_elemento_referido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangofinElementoReferido;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad_subelemento_referido", type="string", length=30, nullable=true)
     */
    private $unidadSubelementoReferido;

    /**
     * @var float
     *
     * @ORM\Column(name="rangoinicio_subelemento_referido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangoinicioSubelementoReferido;

    /**
     * @var float
     *
     * @ORM\Column(name="rangofin_subelemento_referido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rangofinSubelementoReferido;

    /**
     * @var \LabBacterias
     *
     * @ORM\ManyToOne(targetEntity="LabBacterias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idbacteria", referencedColumnName="id")
     * })
     */
    private $idbacteria;

    /**
     * @var \LabCantidadestincion
     *
     * @ORM\ManyToOne(targetEntity="LabCantidadestincion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcantidad", referencedColumnName="id")
     * })
     */
    private $idcantidad;

    /**
     * @var \LabElementos
     *
     * @ORM\ManyToOne(targetEntity="LabElementos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idelemento", referencedColumnName="id")
     * })
     */
    private $idelemento;

    /**
     * @var \LabElementostincion
     *
     * @ORM\ManyToOne(targetEntity="LabElementostincion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_elementotincion", referencedColumnName="id")
     * })
     */
    private $idElementotincion;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

    /**
     * @var \LabPosibleResultado
     *
     * @ORM\ManyToOne(targetEntity="LabPosibleResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posible_resultado", referencedColumnName="id")
     * })
     */
    private $idPosibleResultado;

    /**
     * @var \LabProcedimientosporexamen
     *
     * @ORM\ManyToOne(targetEntity="LabProcedimientosporexamen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idprocedimiento", referencedColumnName="id")
     * })
     */
    private $idprocedimiento;

    /**
     * @var \LabResultados
     *
     * @ORM\ManyToOne(targetEntity="LabResultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idresultado", referencedColumnName="id")
     * })
     */
    private $idresultado;

    /**
     * @var \LabSubelementos
     *
     * @ORM\ManyToOne(targetEntity="LabSubelementos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubelemento", referencedColumnName="id")
     * })
     */
    private $idsubelemento;

    /**
     * @var \LabTarjetasvitek
     *
     * @ORM\ManyToOne(targetEntity="LabTarjetasvitek")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtarjeta", referencedColumnName="id")
     * })
     */
    private $idtarjeta;

    /**
     * @var \LabPosibleResultado
     *
     * @ORM\ManyToOne(targetEntity="LabPosibleResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posresult_elemento_referido", referencedColumnName="id")
     * })
     */
    private $idPosresultElementoReferido;

    /**
     * @var \LabPosibleResultado
     *
     * @ORM\ManyToOne(targetEntity="LabPosibleResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_posresult_subelemento_referido", referencedColumnName="id")
     * })
     */
    private $idPosresultSubelementoReferido;



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
     * Set resultado
     *
     * @param string $resultado
     * @return LabDetalleresultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return LabDetalleresultado
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return LabDetalleresultado
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
     * Set bReferido
     *
     * @param boolean $bReferido
     * @return LabDetalleresultado
     */
    public function setBReferido($bReferido)
    {
        $this->bReferido = $bReferido;

        return $this;
    }

    /**
     * Get bReferido
     *
     * @return boolean
     */
    public function getBReferido()
    {
        return $this->bReferido;
    }

    /**
     * Set elementoReferido
     *
     * @param string $elementoReferido
     * @return LabDetalleresultado
     */
    public function setElementoReferido($elementoReferido)
    {
        $this->elementoReferido = $elementoReferido;

        return $this;
    }

    /**
     * Get elementoReferido
     *
     * @return string
     */
    public function getElementoReferido()
    {
        return $this->elementoReferido;
    }

    /**
     * Set resultadoElementoReferido
     *
     * @param string $resultadoElementoReferido
     * @return LabDetalleresultado
     */
    public function setResultadoElementoReferido($resultadoElementoReferido)
    {
        $this->resultadoElementoReferido = $resultadoElementoReferido;

        return $this;
    }

    /**
     * Get resultadoElementoReferido
     *
     * @return string
     */
    public function getResultadoElementoReferido()
    {
        return $this->resultadoElementoReferido;
    }

    /**
     * Set subelementoReferido
     *
     * @param string $subelementoReferido
     * @return LabDetalleresultado
     */
    public function setSubelementoReferido($subelementoReferido)
    {
        $this->subelementoReferido = $subelementoReferido;

        return $this;
    }

    /**
     * Get subelementoReferido
     *
     * @return string
     */
    public function getSubelementoReferido()
    {
        return $this->subelementoReferido;
    }

    /**
     * Set resultadoSubelementoReferido
     *
     * @param string $resultadoSubelementoReferido
     * @return LabDetalleresultado
     */
    public function setResultadoSubelementoReferido($resultadoSubelementoReferido)
    {
        $this->resultadoSubelementoReferido = $resultadoSubelementoReferido;

        return $this;
    }

    /**
     * Get resultadoSubelementoReferido
     *
     * @return string
     */
    public function getResultadoSubelementoReferido()
    {
        return $this->resultadoSubelementoReferido;
    }

    /**
     * Set unidadElementoReferido
     *
     * @param string $unidadElementoReferido
     * @return LabDetalleresultado
     */
    public function setUnidadElementoReferido($unidadElementoReferido)
    {
        $this->unidadElementoReferido = $unidadElementoReferido;

        return $this;
    }

    /**
     * Get unidadElementoReferido
     *
     * @return string
     */
    public function getUnidadElementoReferido()
    {
        return $this->unidadElementoReferido;
    }

    /**
     * Set rangoinicioElementoReferido
     *
     * @param float $rangoinicioElementoReferido
     * @return LabDetalleresultado
     */
    public function setRangoinicioElementoReferido($rangoinicioElementoReferido)
    {
        $this->rangoinicioElementoReferido = $rangoinicioElementoReferido;

        return $this;
    }

    /**
     * Get rangoinicioElementoReferido
     *
     * @return float
     */
    public function getRangoinicioElementoReferido()
    {
        return $this->rangoinicioElementoReferido;
    }

    /**
     * Set rangofinElementoReferido
     *
     * @param float $rangofinElementoReferido
     * @return LabDetalleresultado
     */
    public function setRangofinElementoReferido($rangofinElementoReferido)
    {
        $this->rangofinElementoReferido = $rangofinElementoReferido;

        return $this;
    }

    /**
     * Get rangofinElementoReferido
     *
     * @return float
     */
    public function getRangofinElementoReferido()
    {
        return $this->rangofinElementoReferido;
    }

    /**
     * Set unidadSubelementoReferido
     *
     * @param string $unidadSubelementoReferido
     * @return LabDetalleresultado
     */
    public function setUnidadSubelementoReferido($unidadSubelementoReferido)
    {
        $this->unidadSubelementoReferido = $unidadSubelementoReferido;

        return $this;
    }

    /**
     * Get unidadSubelementoReferido
     *
     * @return string
     */
    public function getUnidadSubelementoReferido()
    {
        return $this->unidadSubelementoReferido;
    }

    /**
     * Set rangoinicioSubelementoReferido
     *
     * @param float $rangoinicioSubelementoReferido
     * @return LabDetalleresultado
     */
    public function setRangoinicioSubelementoReferido($rangoinicioSubelementoReferido)
    {
        $this->rangoinicioSubelementoReferido = $rangoinicioSubelementoReferido;

        return $this;
    }

    /**
     * Get rangoinicioSubelementoReferido
     *
     * @return float
     */
    public function getRangoinicioSubelementoReferido()
    {
        return $this->rangoinicioSubelementoReferido;
    }

    /**
     * Set rangofinSubelementoReferido
     *
     * @param float $rangofinSubelementoReferido
     * @return LabDetalleresultado
     */
    public function setRangofinSubelementoReferido($rangofinSubelementoReferido)
    {
        $this->rangofinSubelementoReferido = $rangofinSubelementoReferido;

        return $this;
    }

    /**
     * Get rangofinSubelementoReferido
     *
     * @return float
     */
    public function getRangofinSubelementoReferido()
    {
        return $this->rangofinSubelementoReferido;
    }

    /**
     * Set idbacteria
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabBacterias $idbacteria
     * @return LabDetalleresultado
     */
    public function setIdbacteria(\Minsal\LaboratorioBundle\Entity\LabBacterias $idbacteria = null)
    {
        $this->idbacteria = $idbacteria;

        return $this;
    }

    /**
     * Get idbacteria
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabBacterias
     */
    public function getIdbacteria()
    {
        return $this->idbacteria;
    }

    /**
     * Set idcantidad
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabCantidadestincion $idcantidad
     * @return LabDetalleresultado
     */
    public function setIdcantidad(\Minsal\LaboratorioBundle\Entity\LabCantidadestincion $idcantidad = null)
    {
        $this->idcantidad = $idcantidad;

        return $this;
    }

    /**
     * Get idcantidad
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabCantidadestincion
     */
    public function getIdcantidad()
    {
        return $this->idcantidad;
    }

    /**
     * Set idelemento
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabElementos $idelemento
     * @return LabDetalleresultado
     */
    public function setIdelemento(\Minsal\LaboratorioBundle\Entity\LabElementos $idelemento = null)
    {
        $this->idelemento = $idelemento;

        return $this;
    }

    /**
     * Get idelemento
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabElementos
     */
    public function getIdelemento()
    {
        return $this->idelemento;
    }

    /**
     * Set idElementotincion
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabElementostincion $idElementotincion
     * @return LabDetalleresultado
     */
    public function setIdElementotincion(\Minsal\LaboratorioBundle\Entity\LabElementostincion $idElementotincion = null)
    {
        $this->idElementotincion = $idElementotincion;

        return $this;
    }

    /**
     * Get idElementotincion
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabElementostincion
     */
    public function getIdElementotincion()
    {
        return $this->idElementotincion;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return LabDetalleresultado
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
     * Set idPosibleResultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado
     * @return LabDetalleresultado
     */
    public function setIdPosibleResultado(\Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosibleResultado = null)
    {
        $this->idPosibleResultado = $idPosibleResultado;

        return $this;
    }

    /**
     * Get idPosibleResultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleResultado
     */
    public function getIdPosibleResultado()
    {
        return $this->idPosibleResultado;
    }

    /**
     * Set idprocedimiento
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabProcedimientosporexamen $idprocedimiento
     * @return LabDetalleresultado
     */
    public function setIdprocedimiento(\Minsal\LaboratorioBundle\Entity\LabProcedimientosporexamen $idprocedimiento = null)
    {
        $this->idprocedimiento = $idprocedimiento;

        return $this;
    }

    /**
     * Get idprocedimiento
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabProcedimientosporexamen
     */
    public function getIdprocedimiento()
    {
        return $this->idprocedimiento;
    }

    /**
     * Set idresultado
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabResultados $idresultado
     * @return LabDetalleresultado
     */
    public function setIdresultado(\Minsal\LaboratorioBundle\Entity\LabResultados $idresultado = null)
    {
        $this->idresultado = $idresultado;

        return $this;
    }

    /**
     * Get idresultado
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabResultados
     */
    public function getIdresultado()
    {
        return $this->idresultado;
    }

    /**
     * Set idsubelemento
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabSubelementos $idsubelemento
     * @return LabDetalleresultado
     */
    public function setIdsubelemento(\Minsal\LaboratorioBundle\Entity\LabSubelementos $idsubelemento = null)
    {
        $this->idsubelemento = $idsubelemento;

        return $this;
    }

    /**
     * Get idsubelemento
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabSubelementos
     */
    public function getIdsubelemento()
    {
        return $this->idsubelemento;
    }

    /**
     * Set idtarjeta
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabTarjetasvitek $idtarjeta
     * @return LabDetalleresultado
     */
    public function setIdtarjeta(\Minsal\LaboratorioBundle\Entity\LabTarjetasvitek $idtarjeta = null)
    {
        $this->idtarjeta = $idtarjeta;

        return $this;
    }

    /**
     * Get idtarjeta
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabTarjetasvitek
     */
    public function getIdtarjeta()
    {
        return $this->idtarjeta;
    }

    /**
     * Set idPosresultElementoReferido
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosresultElementoReferido
     * @return LabDetalleresultado
     */
    public function setIdPosresultElementoReferido(\Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosresultElementoReferido = null)
    {
        $this->idPosresultElementoReferido = $idPosresultElementoReferido;

        return $this;
    }

    /**
     * Get idPosresultElementoReferido
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleResultado
     */
    public function getIdPosresultElementoReferido()
    {
        return $this->idPosresultElementoReferido;
    }

    /**
     * Set idPosresultSubelementoReferido
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosresultSubelementoReferido
     * @return LabDetalleresultado
     */
    public function setIdPosresultSubelementoReferido(\Minsal\LaboratorioBundle\Entity\LabPosibleResultado $idPosresultSubelementoReferido = null)
    {
        $this->idPosresultSubelementoReferido = $idPosresultSubelementoReferido;

        return $this;
    }

    /**
     * Get idPosresultSubelementoReferido
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabPosibleResultado
     */
    public function getIdPosresultSubelementoReferido()
    {
        return $this->idPosresultSubelementoReferido;
    }
}
