<?php

namespace Minsal\LaboratorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabSuministrante
 *
 * @ORM\Table(name="lab_suministrante", indexes={@ORM\Index(name="IDX_C05C3C7EC9B1A6D", columns={"id_tipo_conexion"})})
 * @ORM\Entity
 */
class LabSuministrante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lab_suministrante_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="suministrante", type="string", length=150, nullable=false)
     */
    private $suministrante;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_suministrante", type="string", length=15, nullable=true)
     */
    private $codigoSuministrante;

    /**
     * @var string
     *
     * @ORM\Column(name="base_url", type="string", length=150, nullable=true)
     */
    private $baseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=15, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=15, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_equipo", type="string", length=15, nullable=true)
     */
    private $ipEquipo;

    /**
     * @var string
     *
     * @ORM\Column(name="aplicacion", type="string", length=50, nullable=true)
     */
    private $aplicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento_url", type="string", length=150, nullable=true)
     */
    private $complementoUrl;

    /**
     * @var \LabTipoConexion
     *
     * @ORM\ManyToOne(targetEntity="LabTipoConexion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_conexion", referencedColumnName="id")
     * })
     */
    private $idTipoConexion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_web_service", type="integer", nullable=true)
     */
    private $tipoWebService;


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
     * Set suministrante
     *
     * @param string $suministrante
     * @return LabSuministrante
     */
    public function setSuministrante($suministrante)
    {
        $this->suministrante = $suministrante;

        return $this;
    }

    /**
     * Get suministrante
     *
     * @return string
     */
    public function getSuministrante()
    {
        return $this->suministrante;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return LabSuministrante
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
     * Set codigoSuministrante
     *
     * @param string $codigoSuministrante
     * @return LabSuministrante
     */
    public function setCodigoSuministrante($codigoSuministrante)
    {
        $this->codigoSuministrante = $codigoSuministrante;

        return $this;
    }

    /**
     * Get codigoSuministrante
     *
     * @return string
     */
    public function getCodigoSuministrante()
    {
        return $this->codigoSuministrante;
    }

    /**
     * Set baseUrl
     *
     * @param string $baseUrl
     * @return LabSuministrante
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Get baseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return LabSuministrante
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return LabSuministrante
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set ipEquipo
     *
     * @param string $ipEquipo
     * @return LabSuministrante
     */
    public function setIpEquipo($ipEquipo)
    {
        $this->ipEquipo = $ipEquipo;

        return $this;
    }

    /**
     * Get ipEquipo
     *
     * @return string
     */
    public function getIpEquipo()
    {
        return $this->ipEquipo;
    }

    /**
     * Set aplicacion
     *
     * @param string $aplicacion
     * @return LabSuministrante
     */
    public function setAplicacion($aplicacion)
    {
        $this->aplicacion = $aplicacion;

        return $this;
    }

    /**
     * Get aplicacion
     *
     * @return string
     */
    public function getAplicacion()
    {
        return $this->aplicacion;
    }

    /**
     * Set complementoUrl
     *
     * @param string $complementoUrl
     * @return LabSuministrante
     */
    public function setComplementoUrl($complementoUrl)
    {
        $this->complementoUrl = $complementoUrl;

        return $this;
    }

    /**
     * Get complementoUrl
     *
     * @return string
     */
    public function getComplementoUrl()
    {
        return $this->complementoUrl;
    }

    /**
     * Set idTipoConexion
     *
     * @param \Minsal\LaboratorioBundle\Entity\LabTipoConexion $idTipoConexion
     * @return LabSuministrante
     */
    public function setIdTipoConexion(\Minsal\LaboratorioBundle\Entity\LabTipoConexion $idTipoConexion = null)
    {
        $this->idTipoConexion = $idTipoConexion;

        return $this;
    }

    /**
     * Get idTipoConexion
     *
     * @return \Minsal\LaboratorioBundle\Entity\LabTipoConexion
     */
    public function getIdTipoConexion()
    {
        return $this->idTipoConexion;
    }

    /**
     * Set tipoWebService
     *
     * @param integer $tipoWebService
     * @return LabSuministrante
     */
    public function setTipoWebService($tipoWebService)
    {
        $this->tipoWebService = $tipoWebService;

        return $this;
    }

    /**
     * Get tipoWebService
     *
     * @return integer
     */
    public function getTipoWebService()
    {
        return $this->tipoWebService;
    }

    public function __toString()
    {
        return $this->id ? $this->suministrante : '';
    }
}
