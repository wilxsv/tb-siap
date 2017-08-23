<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecAntecedentesLaboralLugar
 *
 * @ORM\Table(name="sec_antecedentes_laboral_lugar", indexes={@ORM\Index(name="IDX_C08649018941C3E2", columns={"id_antecedentes_laboral"}), @ORM\Index(name="IDX_C08649016325E299", columns={"id_departamento"}), @ORM\Index(name="IDX_C0864901D166B38A", columns={"id_tipo_lugar_trabajo"})})
 * @ORM\Entity
 */
class SecAntecedentesLaboralLugar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_antecedentes_laboral_lugar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var \SecAntecedentesLaboral
     *
     * @ORM\ManyToOne(targetEntity="SecAntecedentesLaboral")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_antecedentes_laboral", referencedColumnName="id")
     * })
     */
    private $idAntecedentesLaboral;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlDepartamento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento", referencedColumnName="id")
     * })
     */
    private $idDepartamento;

    /**
     * @var \CtlTipoLugarTrabajo
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoLugarTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_lugar_trabajo", referencedColumnName="id")
     * })
     */
    private $idTipoLugarTrabajo;


}
