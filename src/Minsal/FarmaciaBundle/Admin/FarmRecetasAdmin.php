<?php

namespace Minsal\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FarmRecetasAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idhistorialclinico.idExpediente.numero', null, array('label' => 'N° Expediente'))
            ->add('idhistorialclinico.idExpediente.idPaciente',
                    'doctrine_orm_callback',array(
                        'label'         => 'Nombre del Paciente',
                        'callback'      => array($this, 'getNombrePacienteFilter')
                    ),
                    'sonata_type_filter_default', array(
                        'field_options' => array(
                            'label_attr'    => array('class' => 'hidden')
                        )
                    )
                )
            ->add('idhistorialclinico.idAtenAreaModEstab.idAtencion', null, array('label'=>'Especialidad'))
            ->add('fecha','doctrine_orm_date_range', array('label' => 'Fecha de Consulta'),
                                   'sonata_type_date_range', array(
                                       'format' => 'dd/MM/yyyy',
                                       'widget' => 'single_text',
                                       'attr' => array(
                                           'class' => 'bootstrap-datepicker now',
                                           'label_start' => 'Fecha Inicio',
                                           'label_end' => 'Fecha Fin'
                                        )
                                    )
                )
            ->add('idEstados', null, array('label'=>'Estado'))
            ->add('idmodalidad', null, array('label'=>'Modalidad'))
            ->add('idarea', null, array('label'=>'Área que dispensa'))
            ->add('idfarmacia',null,array('label'=>'Farmacia'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('idhistorialclinico.idExpediente', null, array('label' => 'N° Expediente'))
            ->add('idhistorialclinico.idExpediente.idPaciente', null, array('label' => 'Nombre del Paciente'))
            ->add('idhistorialclinico.idAtenAreaModEstab.idAtencion.nombre',null,array('label'=>'Especialidad'))
            ->add('idhistorialclinico.id_empleado',null,array('label'=>'Medico'))
            //->add('fecha',null, array('label'=>'Fecha Entrega Medicamento'))
            ->add('idhistorialclinico.fechaconsulta',null,array('label'=>'Fecha de consulta'))
            //->add('idEstadoExtend',null,array('label'=>'Estado Receta'))
            ->add('idEstados', null, array('label'=>'Estado'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array('template'=>'MinsalFarmaciaBundle:CRUD:FarmRecetas/list__action_show.html.twig')
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $routeName = $request->get('_route');
        $currentDate = new \DateTime();
        if( $routeName == 'admin_minsal_farmacia_farmrecetas_complement'){
            $formMapper
                ->add('fecha', 'date', array( 'label' => 'Fecha', 'data' => $currentDate->format('Y-m-d'),'required' => true, 'read_only' => true, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'input' => 'string', 'attr' => array( 'class' => 'fd_date', 'data-mask'=>'99/99/9999', 'placeholder'=>"dd/mm/aaaa" ) ) )
                ->add('idAtenAreaModEstab', 'entity', array( 'label' => 'Especialidad', 'class' => 'MinsalSiapsBundle:MntAtenAreaModEstab', 'required' => true, 'mapped' => false, 'property' => 'nombreConsulta' ) )
                /*->add('idEmpleado', 'entity', array( 'label' => 'Médico', 'required' => true, 'class' => 'MinsalSiapsBundle:MntEmpleado', 'mapped' => false,
                                                 'query_builder' => function(){
                                                    $qb = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager()->createQueryBuilder();
                                                    $qb ->select('e')
                                                        ->from('MinsalSiapsBundle:MntEmpleado', 'e')
                                                        ->innerJoin('e.idTipoEmpleado', 't')
                                                        ->where('t.codigo = :codigo')
                                                        ->setParameters( array(':codigo' => 'MED' ) );
                                                    return $qb;
                                                 }
                                            ))*/
                ->add('idCitaDia', 'hidden', array( 'label' => 'Id Cita', 'required' => false, 'mapped' => false ) )
                ->add('idHistoriaClinica', 'hidden', array( 'label' => 'Id Historia', 'required' => false, 'mapped' => false ) )
                ->add('idSeguimientoHistoriaClinica', 'hidden', array( 'label' => 'Id Seguimiento Historia Clinica', 'required' => false, 'mapped' => false ))
                //->add('idhistorialclinico', 'sonata_type_model_list', array( 'label' => 'Seguimiento de la Consulta', 'btn_list' => 'Seleccionar', 'btn_add' => false, 'btn_delete' => false ), array('property' => 'id'))
            ;
        }else{

        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fecha')
            ->add('idestado',null,
                    array('label'=>'Estado Receta')
                 )
            ->add('idpersonal')
            ->add('numeroreceta',null,
                    array('label'=>'Número de Receta')
                 )
            ->add('idpersonalintro',null,
                    array('label'=>'Persona que digito')
                 )
            ->add('correlativo',null,
                    array('label'=>'Correlativo')
                 )
            ->add('correlativoanual',null,
                    array('label'=>'Correlativo Anual')
                 )
            ->add('idpersonaldespacho',null,
                    array('label'=>'Persona que despacho')
                 )
            ->add('idestablecimiento',null,
                    array('label'=>'Establecimiento')
                 )
            ->add('idmodalidad',null,
                    array('label'=>'Modalidad')
                 )
            ->add('idarea',null,
                    array('label'=>'Área que dispensa')
                 )
            ->add('idfarmacia',null,
                    array('label'=>'Farmacia')
                 )
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalFarmaciaBundle:CRUD:FarmRecetas/list.html.twig';
                break;
            case 'show':
                return 'MinsalFarmaciaBundle:CRUD:FarmRecetas/show.html.twig';
                break;
            case 'assign_receta':
                return 'MinsalFarmaciaBundle:FarmRecetas:assign_receta.html.twig';
                break;
            case 'imprimir_receta':
                return 'MinsalFarmaciaBundle:FarmRecetas:receta.html.twig';
                break;
            case 'imprimir_receta2':
                return 'MinsalFarmaciaBundle:FarmRecetas:receta2.html.twig';
                break;
            case 'complement':
                return 'MinsalFarmaciaBundle:FarmRecetas:complement.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('assign_receta');
        $collection->add('imprimir_receta');
        $collection->add('complement', 'repetitiva/complement');
    }

     public function createQuery($context='list'){
        $query   = parent::createQuery($context);//obtengo consulta original
        $em      = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();//obtengo el manager
        $qb      = $em->createQueryBuilder();//
        $request = $this->getConfigurationPool()->getContainer()->get('request');

        //Esta consulta para el list solo la realiza se se consulta un paciente especifico
        if($request->get('external') !== null && $request->get('external') !== '' && $request->get('external') === 'true') {
            $idHistorialClinico = $request->get('idHistorialClinico');
            $SecHistorialClinico  = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneBy(array('id'=>$idHistorialClinico));
            $idExpediente = $SecHistorialClinico->getIdExpediente()->getId();

            $fecha = date("Y-m-d");
            $lowerLimit = date('Y-m-d',strtotime('+6 months', strtotime($fecha)));
            $upperLimit = date('Y-m-d',strtotime('-3 months', strtotime($fecha)));

            $query
                ->leftJoin($query->getRootAlias().'.idhistorialclinico', 'ti01')
                ->leftJoin('ti01.idExpediente', 'ti02')
                ->andWhere('ti02.id = :idExpediente')
                ->andWhere('ti02.id IS NOT NULL')
                ->andWhere($query->getRootAlias().'.fecha <= :lowerLimit')
                ->andWhere($query->getRootAlias().'.fecha >= :upperLimit')
                ->setParameters(array(':lowerLimit'=>$lowerLimit,':upperLimit'=>$upperLimit,':idExpediente'=>$idExpediente))
            ;
        }else{
             $query->leftJoin($query->getRootAlias().'.idhistorialclinico', 'ti01')
             ->andWhere('ti01.idExpediente IS NOT NULL')
                ;
        }
        return $query;
    }

    public function getNombrePacienteFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();

        $queryBuilder
            ->leftJoin($alias.'.idhistorialclinico', 'hc')
            ->leftJoin('hc.idExpediente', 'ex')
            ->leftJoin('ex.idPaciente', 'pa')
            ->andWhere(
                $qb->expr()->like(
                    $qb->expr()->lower("CONCAT_WS(' ', pa.primerNombre, pa.segundoNombre, pa.tercerNombre, pa.primerApellido, pa.segundoApellido, pa.apellidoCasada)"),
                    ':nombrePaciente'
                )
            )
           ->setParameter(':nombrePaciente', '%' . strtolower($value['value']['value']) . '%')
        ;
    }

}
