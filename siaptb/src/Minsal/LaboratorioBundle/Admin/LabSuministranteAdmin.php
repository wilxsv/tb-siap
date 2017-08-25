<?php

namespace Minsal\LaboratorioBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class LabSuministranteAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('suministrante', null, array('label'=>'Nombre'))
            ->add('aplicacion', null, array('label'=>'Aplicación'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('suministrante', null, array('label'=>'Nombre'))
            ->add('activo')
            ->add('codigoSuministrante', null, array('label'=>'Código Suministrante'))
            ->add('baseUrl', null, array('label'=>'URL Base'))
            ->add('complementoUrl', null, array('label'=>'Complemento de la URL Base'))
            ->add('ipEquipo', null, array('label'=>'IP del Equipo'))
            ->add('aplicacion', null, array('label'=>'Aplicación'))
            ->add('idTipoConexion.nombre', null, array('label'=>'Tipo de Conexión'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('suministrante', null, array('label'=>'Nombre'))
            ->add('activo',null,array('label'=>'Habilitado','attr'=>array('data-switch-enabled' => 'true', 'data-switch-float' => 'none')))
            ->add('codigoSuministrante',null, array('label'=>'Código Suministrante'))
            ->add('baseUrl','url', array('label'=>'URL Base', 'required'=>false))
            ->add('complementoUrl','text', array('label'=>'Complemento de la URL Base', 'required'=>false))
            ->add('username',null, array('label'=>'Usuario'))
            ->add('password','password', array('label'=>'Contraseña', 'required'=>false))
            ->add('ipEquipo',null, array('label'=>'IP del Equipo a Conectar'))
            ->add('aplicacion', null, array('label'=>'Nombre de Aplicación'))
            ->add('idTipoConexion', null, array('label' =>'Tipo de Conexión'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('suministrante', null, array('label'=>'Nombre'))
            ->add('activo',null,array('label'=>'Habilitado'))
            ->add('codigoSuministrante',null, array('label'=>'Código Suministrante'))
            ->add('baseUrl','url', array('label'=>'URL Base'))
            ->add('complementoUrl','text', array('label'=>'Complemento de la URL Base'))
            ->add('username',null, array('label'=>'Usuario'))
            ->add('password','password', array('label'=>'Contraseña'))
            ->add('ipEquipo',null, array('label'=>'IP del Equipo a Conectar'))
            ->add('aplicacion', null, array('label'=>'Nombre de Aplicación'))
            ->add('idTipoConexion.nombre', null, array('label' =>'Tipo de Conexión'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $action = $object->getId() ? 'edit' : 'create';
        $em     = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $where = "";

        $newNombre              = preg_replace( '/\s\s+/',' ', ( trim( $object->getSuministrante() ) ) );
        $newCodigoSuministrante = preg_replace( '/\s\s+/',' ', ( trim( $object->getCodigoSuministrante() ) ) );
        $newIpSuministrante     = $object->getIpEquipo() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getIpEquipo() ) ) ) : null;
        $newAplicacion          = $object->getAplicacion() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getAplicacion() ) ) ) : null;

        $where  = " AND p.ipEquipo".( $newIpSuministrante ? " = :ipEquipo " : " IS NULL " );
        $where .= " AND LOWER(UNACCENT(p.aplicacion))".( $newAplicacion ? " = :aplicacion " : " IS NULL " );

        $dql = "SELECT p
                FROM MinsalLaboratorioBundle:LabSuministrante p
                WHERE LOWER(UNACCENT(p.suministrante ))= LOWER(UNACCENT(:suministrante))
                    AND LOWER(UNACCENT(p.codigoSuministrante)) = LOWER(UNACCENT(:codigoSuministrante))
                    $where
                     AND p.idTipoConexion = :idTipoConexion";

        if($action === 'edit') {
            $dql .= ' AND p.id != :id';
        }

        $query = $em->createQuery($dql)
                     ->setParameter('suministrante',$newNombre)
                     ->setParameter('codigoSuministrante', $newCodigoSuministrante)
                     ->setParameter('idTipoConexion', $object->getIdTipoConexion()->getId());

        if($action === 'edit') {
            $query->setParameter('id', $object->getId());
        }

        if($newIpSuministrante) {
            $query->setParameter('ipEquipo', $newIpSuministrante);
        }

        if($newAplicacion) {
            $query->setParameter('aplicacion', $newAplicacion);
        }

        $result = $query->getResult();

        if ($result) {
            $errorElement
                ->with('error')
                    ->addViolation(
                        'Ya existe un Suministrante con los siguientes parámetros!:<br />'.
                        '<ul style="list-style-type: none;">'.
                            '<li><strong>Nombre:</strong> '.$newNombre.'</li>'.
                            '<li><strong>Código Suministrante:</strong> '.$newCodigoSuministrante.'</li>'.
                            '<li><strong>IP del Equipo a Conectar:</strong> '.$newIpSuministrante.'</li>'.
                            '<li><strong>Nombre de Aplicación:</strong> '.$newAplicacion.'</li>'.
                            '<li><strong>Tipo de Conexión:</strong> '.$object->getIdTipoConexion()->getNombre().'</li>'.
                        '</ul>'
                    )
                ->end()
                ->with('suministrante')
                    ->addViolation('Error el suministrante ya existe ver datos de error al inicio')
                ->end()
                ->with('codigoSuministrante')
                    ->addViolation('Error el suministrante ya existe ver datos de error al inicio')
                ->end()
                ->with('ipEquipo')
                    ->addViolation('Error el suministrante ya existe ver datos de error al inicio')
                ->end()
                ->with('aplicacion')
                    ->addViolation('Error el suministrante ya existe ver datos de error al inicio')
                ->end()
            ;
        }
    }

    public function prePersist($object) {
        $nombre              = preg_replace( '/\s\s+/',' ', ( trim( $object->getSuministrante() ) ) );
        $codigoSuministrante = preg_replace( '/\s\s+/',' ', ( trim( $object->getCodigoSuministrante() ) ) );
        $ipSuministrante     = $object->getIpEquipo() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getIpEquipo() ) ) ) : null;
        $aplicacion          = $object->getAplicacion() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getAplicacion() ) ) ) : null;

        $object->setSuministrante($nombre);
        $object->setCodigoSuministrante($codigoSuministrante);
        $object->setIpEquipo($ipSuministrante);
        $object->setAplicacion($aplicacion);
    }

    public function preUpdate($object) {
        $nombre              = preg_replace( '/\s\s+/',' ', ( trim( $object->getSuministrante() ) ) );
        $codigoSuministrante = preg_replace( '/\s\s+/',' ', ( trim( $object->getCodigoSuministrante() ) ) );
        $ipSuministrante     = $object->getIpEquipo() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getIpEquipo() ) ) ) : null;
        $aplicacion          = $object->getAplicacion() ? preg_replace( '/\s\s+/',' ', ( trim( $object->getAplicacion() ) ) ) : null;

        $object->setSuministrante($nombre);
        $object->setCodigoSuministrante($codigoSuministrante);
        $object->setIpEquipo($ipSuministrante);
        $object->setAplicacion($aplicacion);
    }
}
