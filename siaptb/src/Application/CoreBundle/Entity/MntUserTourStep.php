<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntUserTourStep
 *
 * @ORM\Table(name="mnt_user_tour_step", indexes={@ORM\Index(name="IDX_232E556090650987", columns={"id_user_tour"})})
 * @ORM\Entity
 */
class MntUserTourStep
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_user_tour_step_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="element", type="text", nullable=true)
     */
    private $element = '';

    /**
     * @var string
     *
     * @ORM\Column(name="placement", type="text", nullable=true)
     */
    private $placement = 'right';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content = '';

    /**
     * @var string
     *
     * @ORM\Column(name="animation", type="text", nullable=true)
     */
    private $animation = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="container", type="text", nullable=true)
     */
    private $container = 'body';

    /**
     * @var string
     *
     * @ORM\Column(name="backdrop", type="text", nullable=true)
     */
    private $backdrop = 'false';

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
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="text", nullable=true)
     */
    private $template;

    /**
     * @var \MntUserTour
     *
     * @ORM\ManyToOne(targetEntity="MntUserTour", inversedBy="tourSteps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_tour", referencedColumnName="id")
     * })
     */
    private $idUserTour;



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
     * Set element
     *
     * @param string $element
     * @return MntUserTourStep
     */
    public function setElement($element)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return string
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set placement
     *
     * @param string $placement
     * @return MntUserTourStep
     */
    public function setPlacement($placement)
    {
        $this->placement = $placement;

        return $this;
    }

    /**
     * Get placement
     *
     * @return string
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MntUserTourStep
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return MntUserTourStep
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set animation
     *
     * @param string $animation
     * @return MntUserTourStep
     */
    public function setAnimation($animation)
    {
        $this->animation = $animation;

        return $this;
    }

    /**
     * Get animation
     *
     * @return string
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set container
     *
     * @param string $container
     * @return MntUserTourStep
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
     * Set backdrop
     *
     * @param string $backdrop
     * @return MntUserTourStep
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
     * @return MntUserTourStep
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
     * @return MntUserTourStep
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
     * @return MntUserTourStep
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
     * @return MntUserTourStep
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
     * Set orden
     *
     * @param integer $orden
     * @return MntUserTourStep
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return MntUserTourStep
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
     * Set idUserTour
     *
     * @param \Application\CoreBundle\Entity\MntUserTour $idUserTour
     * @return MntUserTourStep
     */
    public function setIdUserTour(\Application\CoreBundle\Entity\MntUserTour $idUserTour = null)
    {
        $this->idUserTour = $idUserTour;

        return $this;
    }

    /**
     * Get idUserTour
     *
     * @return \Application\CoreBundle\Entity\MntUserTour
     */
    public function getIdUserTour()
    {
        return $this->idUserTour;
    }
}
