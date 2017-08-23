<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntUserTour
 *
 * @ORM\Table(name="mnt_user_tour")
 * @ORM\Entity
 */
class MntUserTour
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_user_tour_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="text", nullable=true)
     */
    private $route;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=true)
     */
    private $fechaHoraRegistro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = false;

    /**
     * @var string
     *
     * @ORM\Column(name="object_name", type="text", nullable=true)
     */
    private $objectName;

    /**
     * @var string
     *
     * @ORM\Column(name="container", type="text", nullable=true)
     */
    private $container = 'body';

    /**
     * @var string
     *
     * @ORM\Column(name="keyboard", type="text", nullable=true)
     */
    private $keyboard = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="autoscroll", type="text", nullable=true)
     */
    private $autoscroll = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="backdrop", type="text", nullable=true)
     */
    private $backdrop = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="backdropcontainer", type="text", nullable=true)
     */
    private $backdropcontainer = 'body';

    /**
     * @var string
     *
     * @ORM\Column(name="backdroppadding", type="text", nullable=true)
     */
    private $backdroppadding = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="orphan", type="text", nullable=true)
     */
    private $orphan = 'false';

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="text", nullable=true)
     */
    private $duration = 'false';

    /**
     * @var string
     *
     * @ORM\Column(name="basepath", type="text", nullable=true)
     */
    private $basepath;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="text", nullable=true)
     */
    private $template;

    /**
    *
    * @ORM\OneToMany(targetEntity="MntUserTourStep", mappedBy="idUserTour", cascade={"all"}, orphanRemoval=true)
    *
    */
   private $tourSteps;

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
     * Set nombre
     *
     * @param string $nombre
     * @return MntUserTour
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return MntUserTour
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return MntUserTour
     */
    public function setFechaHoraRegistro($fechaHoraRegistro)
    {
        $this->fechaHoraRegistro = $fechaHoraRegistro;

        return $this;
    }

    /**
     * Get fechaHoraRegistro
     *
     * @return \DateTime
     */
    public function getFechaHoraRegistro()
    {
        return $this->fechaHoraRegistro;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return MntUserTour
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
     * Set objectName
     *
     * @param string $objectName
     * @return MntUserTour
     */
    public function setObjectName($objectName)
    {
        $this->objectName = $objectName;

        return $this;
    }

    /**
     * Get objectName
     *
     * @return string
     */
    public function getObjectName()
    {
        return $this->objectName;
    }

    /**
     * Set container
     *
     * @param string $container
     * @return MntUserTour
     */
    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set keyboard
     *
     * @param string $keyboard
     * @return MntUserTour
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    /**
     * Get keyboard
     *
     * @return string
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * Set autoscroll
     *
     * @param string $autoscroll
     * @return MntUserTour
     */
    public function setAutoscroll($autoscroll)
    {
        $this->autoscroll = $autoscroll;

        return $this;
    }

    /**
     * Get autoscroll
     *
     * @return string
     */
    public function getAutoscroll()
    {
        return $this->autoscroll;
    }

    /**
     * Set backdrop
     *
     * @param string $backdrop
     * @return MntUserTour
     */
    public function setBackdrop($backdrop)
    {
        $this->backdrop = $backdrop;

        return $this;
    }

    /**
     * Get backdrop
     *
     * @return string
     */
    public function getBackdrop()
    {
        return $this->backdrop;
    }

    /**
     * Set backdropcontainer
     *
     * @param string $backdropcontainer
     * @return MntUserTour
     */
    public function setBackdropcontainer($backdropcontainer)
    {
        $this->backdropcontainer = $backdropcontainer;

        return $this;
    }

    /**
     * Get backdropcontainer
     *
     * @return string
     */
    public function getBackdropcontainer()
    {
        return $this->backdropcontainer;
    }

    /**
     * Set backdroppadding
     *
     * @param string $backdroppadding
     * @return MntUserTour
     */
    public function setBackdroppadding($backdroppadding)
    {
        $this->backdroppadding = $backdroppadding;

        return $this;
    }

    /**
     * Get backdroppadding
     *
     * @return string
     */
    public function getBackdroppadding()
    {
        return $this->backdroppadding;
    }

    /**
     * Set orphan
     *
     * @param string $orphan
     * @return MntUserTour
     */
    public function setOrphan($orphan)
    {
        $this->orphan = $orphan;

        return $this;
    }

    /**
     * Get orphan
     *
     * @return string
     */
    public function getOrphan()
    {
        return $this->orphan;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return MntUserTour
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set basepath
     *
     * @param string $basepath
     * @return MntUserTour
     */
    public function setBasepath($basepath)
    {
        $this->basepath = $basepath;

        return $this;
    }

    /**
     * Get basepath
     *
     * @return string
     */
    public function getBasepath()
    {
        return $this->basepath;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return MntUserTour
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tourSteps = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tourSteps
     *
     * @param \Application\CoreBundle\Entity\MntUserTourStep $tourSteps
     * @return MntUserTour
     */
    public function addTourStep(\Application\CoreBundle\Entity\MntUserTourStep $tourSteps)
    {
        $this->tourSteps[] = $tourSteps;

        return $this;
    }

    /**
     * Remove tourSteps
     *
     * @param \Application\CoreBundle\Entity\MntUserTourStep $tourSteps
     */
    public function removeTourStep(\Application\CoreBundle\Entity\MntUserTourStep $tourSteps)
    {
        $this->tourSteps->removeElement($tourSteps);
    }

    /**
     * Get tourSteps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourSteps()
    {
        return $this->tourSteps;
    }
}
