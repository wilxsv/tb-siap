<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FarmCatalogoproductosxestablecimiento
 *
 * @ORM\Table(name="farm_catalogoproductosxestablecimiento", indexes={@ORM\Index(name="IDX_1AAB6555F58EA699", columns={"idmedicina"})})
 * @ORM\Entity
 */
class FarmCatalogoproductosxestablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="farm_catalogoproductosxestablecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", nullable=false)
     */
    private $condicion = 'H';

    /**
     * @var string
     *
     * @ORM\Column(name="estupefaciente", type="string", nullable=false)
     */
    private $estupefaciente = 'N';

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id",nullable=false)
     * })
     */
    private $idusuarioreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=false)
     */
    private $fechahorareg;

     /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id",nullable=false)
     * })
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_dispensar", type="integer", nullable=true)
     */
    private $maximoDispensar;

    /**
     * @var integer
     *
     * @ORM\Column(name="medicamento_especializada", type="integer", nullable=true)
     */
    private $medicamentoEspecializada;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set condicion
     *
     * @param string $condicion
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get condicion
     *
     * @return string 
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set estupefaciente
     *
     * @param string $estupefaciente
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setEstupefaciente($estupefaciente)
    {
        $this->estupefaciente = $estupefaciente;

        return $this;
    }

    /**
     * Get estupefaciente
     *
     * @return string 
     */
    public function getEstupefaciente()
    {
        return $this->estupefaciente;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime 
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime 
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set maximoDispensar
     *
     * @param integer $maximoDispensar
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setMaximoDispensar($maximoDispensar)
    {
        $this->maximoDispensar = $maximoDispensar;

        return $this;
    }

    /**
     * Get maximoDispensar
     *
     * @return integer 
     */
    public function getMaximoDispensar()
    {
        return $this->maximoDispensar;
    }

    /**
     * Set medicamentoEspecializada
     *
     * @param integer $medicamentoEspecializada
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setMedicamentoEspecializada($medicamentoEspecializada)
    {
        $this->medicamentoEspecializada = $medicamentoEspecializada;

        return $this;
    }

    /**
     * Get medicamentoEspecializada
     *
     * @return integer 
     */
    public function getMedicamentoEspecializada()
    {
        return $this->medicamentoEspecializada;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return FarmCatalogoproductosxestablecimiento
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
     * @return FarmCatalogoproductosxestablecimiento
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
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return FarmCatalogoproductosxestablecimiento
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set idmedicina
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmCatalogoproductos $idmedicina
     * @return FarmCatalogoproductosxestablecimiento
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
}
