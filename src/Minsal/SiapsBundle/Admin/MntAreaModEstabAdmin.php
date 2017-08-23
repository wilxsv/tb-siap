<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Minsal\SiapsBundle\Entity\MntEmpleadoEspecialidadEstab as EmpleadoEspecialidad;

class MntAreaModEstabAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'idModalidadEstab' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('idModalidadEstab', 'entity', array('label' => $this->getTranslator()->trans('id_modalidad'),
                    'class' => 'MinsalSiapsBundle:MntModalidadEstablecimiento'
                ))
                ->add('idAreaAtencion', null, array(
                    'label' => 'Área de atención',
                    'required' => true
                ))
                ->add('idServicioExternoEstab', null, array(
                    'label' => 'Servicio Externo'
                ))
                ->add('atenciones', null, array(
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true
                ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('idModalidadEstab', null, array('label' => $this->getTranslator()->trans('idModalidadEstab')))
                ->add('idAreaAtencion', null, array('label' => 'Area de Atención'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('idModalidadEstab.idModalidad', 'text', array('label' => 'Modalidad'))
                ->add('idAreaAtencion', null, array('label' => 'Área de atención'))
                ->add('atenciones', null, array('label' => 'Oferta de servicios'))
                ->add('idServicioExternoEstab', null, array('label' => 'Servicio Externo'))
                ->add('_action', 'actions', array(
                    'label' => $this->getTranslator()->trans('Action'),
                    'actions' => array(
                        'edit' => array()
                    )
                ))
        ;
    }

    public function prePersist($object){
        $idEstablecimientoConfigurado = $this->getModelManager()
          ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => 'true'));

        $object->setIdEstablecimiento($idEstablecimientoConfigurado);

    }

    public function validate(ErrorElement $errorElement, $object) {
        if(is_null($object->getId())){
            $restricciones=array('idAreaAtencion' => $object->getIdAreaAtencion(),
                                 'idModalidadEstab'=>$object->getIdModalidadEstab()
            );

            if(!is_null($object->getIdServicioExternoEstab())){
                $restricciones['idServicioExternoEstab']=$object->getIdServicioExternoEstab();
            }

            $areaExiste = $this->getModelManager()
              ->findOneBy('MinsalSiapsBundle:MntAreaModEstab', $restricciones);

            if($areaExiste){
                $errorElement
                    ->with('error')
                        ->addViolation('Los valores seleccionados para modalidad, area de atención y servicio externo ya existen.
                         Si deseea agregar mas atenciones debe de editar dicha combinación')
                    ->end();
            }
        }
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:CRUD:AreaModEstab_edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }

    public function postPersist($mntAreaModEstab) {
        if ($mntAreaModEstab->getIdModalidadEstab()->getIdModalidad()->getId() == 1) {
            if ($mntAreaModEstab->getIdAreaAtencion()->getId() == 1 && is_null($mntAreaModEstab->getIdServicioExternoEstab())) {
                $usuarios = $this->getModelManager()
                        ->getEntityManager('ApplicationSonataUserBundle:User')
                        ->createQuery("
                    SELECT u
                    FROM ApplicationSonataUserBundle:User u
                    WHERE u.username IN ('citasadmin','identificacionadmin')")
                        ->getResult();

                foreach ($usuarios as $usuario) {
                    $empleado=$usuario->getIdEmpleado();
                    $empleadoEspecialidad= new EmpleadoEspecialidad();
                    $empleadoEspecialidad->setIdAreaModEstab($mntAreaModEstab);
                    $empleadoEspecialidad->setIdEmpleado($empleado);
                    $this->getModelManager()->create($empleadoEspecialidad);
                }
            }
        }
    }
}

?>
