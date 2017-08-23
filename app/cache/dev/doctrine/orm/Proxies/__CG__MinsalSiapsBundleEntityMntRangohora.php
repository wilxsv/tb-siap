<?php

namespace Proxies\__CG__\Minsal\SiapsBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class MntRangohora extends \Minsal\SiapsBundle\Entity\MntRangohora implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'id', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'horaIni', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'horaFin', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'fechahorareg', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'activo', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idEstablecimiento', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idModulo', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idusuarioreg');
        }

        return array('__isInitialized__', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'id', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'horaIni', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'horaFin', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'fechahorareg', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'activo', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idEstablecimiento', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idModulo', '' . "\0" . 'Minsal\\SiapsBundle\\Entity\\MntRangohora' . "\0" . 'idusuarioreg');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (MntRangohora $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setHoraIni($horaIni)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHoraIni', array($horaIni));

        return parent::setHoraIni($horaIni);
    }

    /**
     * {@inheritDoc}
     */
    public function getHoraIni()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHoraIni', array());

        return parent::getHoraIni();
    }

    /**
     * {@inheritDoc}
     */
    public function setHoraFin($horaFin)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHoraFin', array($horaFin));

        return parent::setHoraFin($horaFin);
    }

    /**
     * {@inheritDoc}
     */
    public function getHoraFin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHoraFin', array());

        return parent::getHoraFin();
    }

    /**
     * {@inheritDoc}
     */
    public function setFechahorareg($fechahorareg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFechahorareg', array($fechahorareg));

        return parent::setFechahorareg($fechahorareg);
    }

    /**
     * {@inheritDoc}
     */
    public function getFechahorareg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechahorareg', array());

        return parent::getFechahorareg();
    }

    /**
     * {@inheritDoc}
     */
    public function setActivo($activo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setActivo', array($activo));

        return parent::setActivo($activo);
    }

    /**
     * {@inheritDoc}
     */
    public function getActivo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActivo', array());

        return parent::getActivo();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdEstablecimiento', array($idEstablecimiento));

        return parent::setIdEstablecimiento($idEstablecimiento);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdEstablecimiento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdEstablecimiento', array());

        return parent::getIdEstablecimiento();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdModulo(\Minsal\SiapsBundle\Entity\CtlModulo $idModulo = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdModulo', array($idModulo));

        return parent::setIdModulo($idModulo);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdModulo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdModulo', array());

        return parent::getIdModulo();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdusuarioreg', array($idusuarioreg));

        return parent::setIdusuarioreg($idusuarioreg);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdusuarioreg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdusuarioreg', array());

        return parent::getIdusuarioreg();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormatterHoraIni()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormatterHoraIni', array());

        return parent::getFormatterHoraIni();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormatterHoraFin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormatterHoraFin', array());

        return parent::getFormatterHoraFin();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormatterRangHora()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormatterRangHora', array());

        return parent::getFormatterRangHora();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

}
