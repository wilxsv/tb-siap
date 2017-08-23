<?php

namespace Minsal\CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CitCitaTransferida
 *
 * @ORM\Table(name="cit_cita_transferida", indexes={@ORM\Index(name="IDX_E3BBD60B64DB2212", columns={"id_cita_antigua"}), @ORM\Index(name="IDX_E3BBD60B33C1DC3", columns={"id_cita_nueva"})})
 * @ORM\Entity
 */
class CitCitaTransferida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cit_cita_transferida_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \CitCitasDia
     *
     * @ORM\ManyToOne(targetEntity="CitCitasDia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_antigua", referencedColumnName="id")
     * })
     */
    private $idCitaAntigua;

    /**
     * @var \CitCitasDia
     *
     * @ORM\ManyToOne(targetEntity="CitCitasDia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_nueva", referencedColumnName="id")
     * })
     */
    private $idCitaNueva;



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
     * Set idCitaAntigua
     *
     * @param \Minsal\CitasBundle\Entity\CitCitasDia $idCitaAntigua
     * @return CitCitaTransferida
     */
    public function setIdCitaAntigua(\Minsal\CitasBundle\Entity\CitCitasDia $idCitaAntigua = null)
    {
        $this->idCitaAntigua = $idCitaAntigua;

        return $this;
    }

    /**
     * Get idCitaAntigua
     *
     * @return \Minsal\CitasBundle\Entity\CitCitasDia
     */
    public function getIdCitaAntigua()
    {
        return $this->idCitaAntigua;
    }

    /**
     * Set idCitaNueva
     *
     * @param \Minsal\CitasBundle\Entity\CitCitasDia $idCitaNueva
     * @return CitCitaTransferida
     */
    public function setIdCitaNueva(\Minsal\CitasBundle\Entity\CitCitasDia $idCitaNueva = null)
    {
        $this->idCitaNueva = $idCitaNueva;

        return $this;
    }

    /**
     * Get idCitaNueva
     *
     * @return \Minsal\CitasBundle\Entity\CitCitasDia
     */
    public function getIdCitaNueva()
    {
        return $this->idCitaNueva;
    }

    public function __toString() {
        return $this->id ? (string) $this->id : '';
    }
}
