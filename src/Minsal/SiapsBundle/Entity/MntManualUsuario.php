<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MntManualUsuario
 *
 * @ORM\Table(name="mnt_manual_usuario", indexes={@ORM\Index(name="IDX_81D591E6919ACD3C", columns={"usuario_modifica"}), @ORM\Index(name="IDX_81D591E6360577C5", columns={"usuario_registra"}), @ORM\Index(name="IDX_81D591E6CAC67ADB", columns={"id_modulo"})})
 * @ORM\Entity
 */
class MntManualUsuario {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_manual_usuario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_ruta_manual", type="string", length=200, nullable=false)
     */
    private $idRutaManual;

    /**
     * @Assert\File(
     *     maxSize = "10240k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Seleccione el archivo PDF"
     * )
     */
    protected $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_registro", type="datetime", nullable=false)
     */
    private $fechaHoraRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_modifica", type="datetime", nullable=true)
     */
    private $fechaHoraModifica;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = true;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_modifica", referencedColumnName="id")
     * })
     */
    private $usuarioModifica;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_registra", referencedColumnName="id")
     * })
     */
    private $usuarioRegistra;

    /**
     * @var \CtlModulo
     *
     * @ORM\ManyToOne(targetEntity="CtlModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id")
     * })
     */
    private $idModulo;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idRutaManual
     *
     * @param string $idRutaManual
     * @return MntManualUsuario
     */
    public function setIdRutaManual($idRutaManual) {
        $this->idRutaManual = $idRutaManual;

        return $this;
    }

    /**
     * Get idRutaManual
     *
     * @return string 
     */
    public function getIdRutaManual() {
        return $this->idRutaManual;
    }

    /**
     * Set fechaHoraRegistro
     *
     * @param \DateTime $fechaHoraRegistro
     * @return MntManualUsuario
     */
    public function setFechaHoraRegistro($fechaHoraRegistro) {
        $this->fechaHoraRegistro = $fechaHoraRegistro;

        return $this;
    }

    /**
     * Get fechaHoraRegistro
     *
     * @return \DateTime 
     */
    public function getFechaHoraRegistro() {
        return $this->fechaHoraRegistro;
    }

    /**
     * Set fechaHoraModifica
     *
     * @param \DateTime $fechaHoraModifica
     * @return MntManualUsuario
     */
    public function setFechaHoraModifica($fechaHoraModifica) {
        $this->fechaHoraModifica = $fechaHoraModifica;

        return $this;
    }

    /**
     * Get fechaHoraModifica
     *
     * @return \DateTime 
     */
    public function getFechaHoraModifica() {
        return $this->fechaHoraModifica;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return MntManualUsuario
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set usuarioModifica
     *
     * @param \Application\Sonata\UserBundle\Entity\User $usuarioModifica
     * @return MntManualUsuario
     */
    public function setUsuarioModifica(\Application\Sonata\UserBundle\Entity\User $usuarioModifica = null) {
        $this->usuarioModifica = $usuarioModifica;

        return $this;
    }

    /**
     * Get usuarioModifica
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUsuarioModifica() {
        return $this->usuarioModifica;
    }

    /**
     * Set usuarioRegistra
     *
     * @param \Application\Sonata\UserBundle\Entity\User $usuarioRegistra
     * @return MntManualUsuario
     */
    public function setUsuarioRegistra(\Application\Sonata\UserBundle\Entity\User $usuarioRegistra = null) {
        $this->usuarioRegistra = $usuarioRegistra;

        return $this;
    }

    /**
     * Get usuarioRegistra
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUsuarioRegistra() {
        return $this->usuarioRegistra;
    }

    /**
     * Set idModulo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlModulo $idModulo
     * @return MntManualUsuario
     */
    public function setIdModulo(\Minsal\SiapsBundle\Entity\CtlModulo $idModulo = null) {
        $this->idModulo = $idModulo;

        return $this;
    }

    /**
     * Get idModulo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlModulo 
     */
    public function getIdModulo() {
        return $this->idModulo;
    }

    public function __toString() {
        return (string) $this->idModulo? : '';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

//funciones para poder subir el archivo
    public function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        // return $basepath.$this->getUploadDir();
        return __DIR__ . '/../../../../upload/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'manualUsuario';
    }

    public function upload() {
// the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

// we use the original file name here but you should
// sanitize it at least to avoid any security issues
        $nomArchivo = 'manualUsuarioModulo' . $this->getIdModulo()->getCodModulo() .$this->getId(). '.' . $this->getFile()->guessExtension();
// move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir(), $nomArchivo);

// set the path property to the filename where you'ved saved the file
        $this->setIdRutaManual($nomArchivo);

// clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
