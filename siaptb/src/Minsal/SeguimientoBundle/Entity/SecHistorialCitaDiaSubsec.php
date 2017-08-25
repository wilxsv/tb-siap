<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecHistorialCitaDiaSubsec
 *
 * @ORM\Table(name="sec_historial_cita_dia_subsec", indexes={@ORM\Index(name="fki_historial_clinico_historial_cita_dia_subsec", columns={"id_historial_clinico"}), @ORM\Index(name="fki_ctl_tipo_cita_subsecuente", columns={"id_cita_dia"}), @ORM\Index(name="IDX_C3EF10E6AB505E07", columns={"id_tipo_cita_subsecuente"})})
 * @ORM\Entity
 */
class SecHistorialCitaDiaSubsec
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_historial_cita_dia_subsec_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \Minsal\CitasBundle\Entity\CitCitasDia
     *
     * @ORM\ManyToOne(targetEntity="Minsal\CitasBundle\Entity\CitCitasDia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_dia", referencedColumnName="id")
     * })
     */
    private $idCitaDia;

    /**
     * @var \CtlTipoCitaSubsecuente
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoCitaSubsecuente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_cita_subsecuente", referencedColumnName="id")
     * })
     */
    private $idTipoCitaSubsecuente;

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
     * Set idHistorialClinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idHistorialClinico
     * @return SecHistorialCitaDiaSubsec
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
     * Set idCitaDia
     *
     * @param \Minsal\CitasBundle\Entity\CitCitasDia $idCitaDia
     * @return SecHistorialCitaDiaSubsec
     */
    public function setIdCitaDia(\Minsal\CitasBundle\Entity\CitCitasDia $idCitaDia = null)
    {
        $this->idCitaDia = $idCitaDia;

        return $this;
    }

    /**
     * Get idCitaDia
     *
     * @return \Minsal\CitasBundle\Entity\CitCitasDia 
     */
    public function getIdCitaDia()
    {
        return $this->idCitaDia;
    }

    /**
     * Set idTipoCitaSubsecuente
     *
     * @param \Minsal\SeguimientoBundle\Entity\CtlTipoCitaSubsecuente $idTipoCitaSubsecuente
     * @return SecHistorialCitaDiaSubsec
     */
    public function setIdTipoCitaSubsecuente(\Minsal\SeguimientoBundle\Entity\CtlTipoCitaSubsecuente $idTipoCitaSubsecuente = null)
    {
        $this->idTipoCitaSubsecuente = $idTipoCitaSubsecuente;

        return $this;
    }

    /**
     * Get idTipoCitaSubsecuente
     *
     * @return \Minsal\SeguimientoBundle\Entity\CtlTipoCitaSubsecuente 
     */
    public function getIdTipoCitaSubsecuente()
    {
        return $this->idTipoCitaSubsecuente;
    }

    public function createQueryBuilder($alias) {
        return $this->_em->createQueryBuilder()
                         ->select($alias)
                         ->from($this->_entityName, $alias);
    }
}
