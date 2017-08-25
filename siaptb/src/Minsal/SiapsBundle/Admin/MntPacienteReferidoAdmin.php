<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Sonata\AdminBundle\Route\RouteCollection;

class MntPacienteReferidoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper|
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idReferenciaOrigen.codigo',null,array('label'=>'No. de Referencia'))
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento', null, array('label' => 'Fecha de Nacimiento'), null, array('attr' => array( 'class' => 'bootstrap-datepicker now')))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idReferenciaOrigen.codigo',null,array('label'=>'No. Referencia'))
            ->add('idReferenciaOrigen.idEstablecimientoOrigen',null,array('label'=>'Establecimiento que Refiere'))
            ->add('idReferenciaOrigen.nombreEspecialidadDestino',null,array('label'=>'Especialidad a la que es Referido'))
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento','date',array('label'=>'Fecha de Nacimiento'))
            ->add('idDepartamentoDomicilio','text',array('label'=>'Departamento Domicilio'))
            ->add('getDireccionDepartamentoConcat','text',array('label'=>'Dirección de Domicilio'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array('template'=>'MinsalSiapsBundle:MntPacienteReferidoAdmin:boton_mostrar.html.twig'),
                    'buscar_paciente_siap' => array('template'=>'MinsalSiapsBundle:MntPacienteReferidoAdmin:boton_buscar.html.twig')
                )
            ))
        ;
    }


    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->with('Datos Referencia')
            ->add('idReferenciaOrigen.codigo',null,array('label'=>'No. Referencia'))
            ->add('idReferenciaOrigen.idEstablecimientoOrigen',null,array('label'=>'Establecimiento que Refiere'))
            ->add('idReferenciaOrigen.nombreEspecialidadDestino',null,array('label'=>'Especialidad a la que es Referido'))
        ->end()
        ->with('Datos del Paciente')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento','date',array('label'=>'Fecha de Nacimiento'))
            ->add('nombreResponsable',null,array('label'=>'Nombre del Responsable'))
            ->add('nombreMadre')
            ->add('nombrePadre')
            ->add('numeroAfiliacion')
            ->add('asegurado')
            ->add('getDireccionDepartamentoConcat','text',array('label'=>'Dirección de Domicilio'))
            ->add('idDepartamentoDomicilio','text',array('label'=>'Departamento Domicilio'))
            ->add('areaGeograficaDomicilio')
        ->end()

        ;
    }

    /**
    * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
    */
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        return new ProxyQuery(
        $query
        ->where($query->getRootAlias() . '.idModulo = 1')
    );
    }


    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('create');
        $collection->remove('export');
        $collection->add('mostrar');
        $collection->add('buscar_paciente_siap');

    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
            return 'MinsalSiapsBundle:MntPacienteReferidoAdmin:list.html.twig';
            break;
            case 'mostrar':
            return 'MinsalSiapsBundle:MntPacienteReferidoAdmin:base_show.html.twig';
            break;
            case 'buscar_paciente_siap':
            return 'MinsalSiapsBundle:MntPacienteReferidoAdmin:base_show.html.twig';
            break;
            default:
            return parent::getTemplate($name);
            break;
        }
    }

}
