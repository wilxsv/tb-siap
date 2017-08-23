<?php

namespace Minsal\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FarmMedicinaDistribucion
 *
 * @ORM\Table(name="farm_medicina_distribucion", indexes={@ORM\Index(name="IDX_3C5C6B4519D9C8C7", columns={"id_medicina_recetada"})})
 * @ORM\Entity
 */
class FarmMedicinaDistribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="farm_medicina_distribucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_distribucion", type="decimal", precision=11, scale=2, nullable=true)
     */
    private $cantidadDistribucion;

    /**
     * @var string
     *
     * @ORM\Column(name="indicacion", type="string", length=15, nullable=true)
     */
    private $indicacion;

    /**
     * @var \FarmMedicinarecetada
     *
     * @ORM\ManyToOne(targetEntity="FarmMedicinarecetada",cascade={"persist"}, inversedBy="distribuciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medicina_recetada", referencedColumnName="id")
     * })
     */
    private $idMedicinaRecetada;



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
     * Set cantidadDistribucion
     *
     * @param integer $cantidadDistribucion
     * @return FarmMedicinaDistribucion
     */
    public function setCantidadDistribucion($cantidadDistribucion)
    {
        $this->cantidadDistribucion = $cantidadDistribucion;

        return $this;
    }

    /**
     * Get cantidadDistribucion
     *
     * @return integer 
     */
    public function getCantidadDistribucion()
    {
        return $this->cantidadDistribucion;
    }

    /**
     * Set indicacion
     *
     * @param string $indicacion
     * @return FarmMedicinaDistribucion
     */
    public function setIndicacion($indicacion)
    {
        $this->indicacion = $indicacion;

        return $this;
    }

    /**
     * Get indicacion
     *
     * @return string 
     */
    public function getIndicacion()
    {
        return $this->indicacion;
    }

    /**
     * Set idMedicinaRecetada
     *
     * @param \Minsal\FarmaciaBundle\Entity\FarmMedicinarecetada $idMedicinaRecetada
     * @return FarmMedicinaDistribucion
     */
    public function setIdMedicinaRecetada(\Minsal\FarmaciaBundle\Entity\FarmMedicinarecetada $idMedicinaRecetada = null)
    {
        $this->idMedicinaRecetada = $idMedicinaRecetada;

        return $this;
    }

    /**
     * Get idMedicinaRecetada
     *
     * @return \Minsal\FarmaciaBundle\Entity\FarmMedicinarecetada 
     */
    public function getIdMedicinaRecetada()
    {
        return $this->idMedicinaRecetada;
    }
}
