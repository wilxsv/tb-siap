<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Doctrine\ORM\EntityRepository;

class MntEventoAdmin extends Admin
{

     protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'nombre' // name of the ordered field (default = the model id field, if any)
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre', null, array('label' => 'Nombre'))
            ->add('fechaHoraIni', null, array('label' =>'Fecha inicio'))
            ->add('fechaHoraFin', null, array('label' =>'Fecha Fin'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombre', null, array('label' => 'Nombre'))
            ->add('fechaHoraIni', null, array('label' => 'Fecha Inicio'))
            ->add('fechaHoraFin', null, array('label' => 'Fecha Fin'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $current_time=new \DateTime();

        $formMapper
            ->add('aplicacionEvento', 'choice', array('label' => 'Aplicar a', 'mapped' => false, 'required' => true,
                    'choices' => array('med'=>'Citas Médicas','proc'=>'Citas de Procedimiento','ambos'=>'Citas Médicas y de Procedimiento')
                ))
            ->add('idProcedimientoEstablecimiento', null, array(
                    'label' => 'Procedimiento',
                    'required' => false))
           ->add('idTipoEvento', null, array(
                    'label' => 'Tipo de Evento',
                    'required' => true))
            ->add('idAreaModEstab', 'entity', array(
                    'label' => 'Area de Atención',
                    'required' => false,
                    'class' => 'MinsalSiapsBundle:MntAreaModEstab',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('areamodestab')
                                ->where('areamodestab.idAreaAtencion=1')
                                ->orderBy('areamodestab.id');
                    }
                ))
            ->add('todos_los_medicos', 'checkbox', array('label' => 'Todos los médicos', 'mapped' => false, 'required' => false))
            ->add('idEmpleadoMultiple', 'entity',
                array(
                    'label'    => 'Médico',
                    'required' => false,
                    'multiple' => true,
                    'mapped'   => false,
                    'class'    => 'MinsalSiapsBundle:MntEmpleado',
                    'expanded' => false,
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('mntempleado')
                                ->where('mntempleado.habilitado = true')
                                ->andWhere('mntempleado.idTipoEmpleado = 4')
                                ->orderBy('mntempleado.nombreempleado');
                    }
                )
            )
            ->add('duracion','text',
                       array(
                           'label'    => 'Duración de evento',
                           'required' => true,
                           'mapped' => false,
                           'attr'     => array(
                               'placeholder'          => 'dd/mm/yyyy HH:MI:SS - dd/mm/yyyy HH:MI:SS',
                               'data-date-min-date'   => $current_time->format('d/m/Y'),
                               'data-date-start-date' => $current_time->format('d/m/Y'),
                               'data-date-time-picker'=>'true',
                               'data-date-time-picker-increment'=>30
                           )
                       )
                   )
            ->add('nombre', null, array(
                    'label' => 'Nombre',
                    'required' => true,
                    ))
            ->add('descripcion', null, array(
                        'label' => 'Descripción'
                        ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('idTipoevento', null, array('label' => 'Tipo Evento'))
            ->add('nombre', null, array('label' => 'Nombre'))
            ->add('descripcion', null, array('label' => 'Descripción'))
            ->add('idEmpleado', null, array('label' => 'Médico'))
            ->add('fechaHoraIni', null, array('label' => 'Fecha Inicio'))
            ->add('fechaHoraFin', null, array('label' => 'Fecha Fin'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object) {

        $current_time=new \DateTime();

        if ($object->getId()) {
            if ($object->getFechaHoraIni() < $current_time) {
                $errorElement->with('error')
                        ->addViolation('No puede modificar la fecha y hora de inicio para un evento que ya ha comenzado.')
                        ->end();
            }
        }
    }

    //Quitar opción de borrar al final de la lista
    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:MntEvento:edit.html.twig';
                break;
            case 'list':
                return 'MinsalSiapsBundle:MntEvento:list.html.twig';
                break;
            case 'show':
                return 'MinsalSiapsBundle:MntEvento:show.html.twig';
                break;
            case 'delete':
                    return 'MinsalSiapsBundle:MntEvento:delete.html.twig';
                    break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
