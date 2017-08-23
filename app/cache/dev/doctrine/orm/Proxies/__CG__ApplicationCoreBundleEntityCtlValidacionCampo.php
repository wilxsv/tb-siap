<?php

namespace Proxies\__CG__\Application\CoreBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CtlValidacionCampo extends \Application\CoreBundle\Entity\CtlValidacionCampo implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'id', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'nombre', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'codigoValidacion', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'aplicaPara', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'requiereComparacion', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'aplicaItemPool', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'valorNumerico');
        }

        return array('__isInitialized__', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'id', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'nombre', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'codigoValidacion', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'aplicaPara', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'requiereComparacion', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'aplicaItemPool', '' . "\0" . 'Application\\CoreBundle\\Entity\\CtlValidacionCampo' . "\0" . 'valorNumerico');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CtlValidacionCampo $proxy) {
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
    public function setNombre($nombre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombre', array($nombre));

        return parent::setNombre($nombre);
    }

    /**
     * {@inheritDoc}
     */
    public function getNombre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombre', array());

        return parent::getNombre();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodigoValidacion($codigoValidacion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodigoValidacion', array($codigoValidacion));

        return parent::setCodigoValidacion($codigoValidacion);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodigoValidacion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodigoValidacion', array());

        return parent::getCodigoValidacion();
    }

    /**
     * {@inheritDoc}
     */
    public function setAplicaPara($aplicaPara)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAplicaPara', array($aplicaPara));

        return parent::setAplicaPara($aplicaPara);
    }

    /**
     * {@inheritDoc}
     */
    public function getAplicaPara()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAplicaPara', array());

        return parent::getAplicaPara();
    }

    /**
     * {@inheritDoc}
     */
    public function setRequiereComparacion($requiereComparacion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRequiereComparacion', array($requiereComparacion));

        return parent::setRequiereComparacion($requiereComparacion);
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiereComparacion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRequiereComparacion', array());

        return parent::getRequiereComparacion();
    }

    /**
     * {@inheritDoc}
     */
    public function setAplicaItemPool($aplicaItemPool)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAplicaItemPool', array($aplicaItemPool));

        return parent::setAplicaItemPool($aplicaItemPool);
    }

    /**
     * {@inheritDoc}
     */
    public function getAplicaItemPool()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAplicaItemPool', array());

        return parent::getAplicaItemPool();
    }

    /**
     * {@inheritDoc}
     */
    public function setValorNumerico($valorNumerico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValorNumerico', array($valorNumerico));

        return parent::setValorNumerico($valorNumerico);
    }

    /**
     * {@inheritDoc}
     */
    public function getValorNumerico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValorNumerico', array());

        return parent::getValorNumerico();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getApplyTo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getApplyTo', array());

        return parent::getApplyTo();
    }

}
