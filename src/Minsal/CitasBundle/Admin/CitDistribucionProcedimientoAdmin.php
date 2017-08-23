<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Validator\ErrorElement;

class CitDistribucionProcedimientoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('cupos')
            ->add('maxCitasAgregadas')
            ->add('tiempoLecturaDias')
            ->add('dia')
            ->add('mes')
            ->add('yrs')
            ->add('fechahorareg')
            ->add('fechahoramod')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('cupos')
            ->add('maxCitasAgregadas')
            ->add('tiempoLecturaDias')
            ->add('dia')
            ->add('mes')
            ->add('yrs')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
     protected function configureFormFields(FormMapper $formMapper){
         $diasDeLaSemana = array(8 => 'Todos los días', 1 => 'Lunes', 2 => 'Martes',
         3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes');

         $meses = array(13 => 'Todos los meses', 1 => 'Enero', 2 => 'Febrero',
         3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo',
         6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
         9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

         $fechaActual = new \DateTime();

         $anios = array($fechaActual->format('Y') => $fechaActual->format('Y'),
         ($fechaActual->format('Y') + 1) => ($fechaActual->format('Y') + 1),
         ($fechaActual->format('Y') + 2) => ($fechaActual->format('Y') + 2)
     );
     $formMapper
         ->with('Datos del Procedimiento', array('class' => 'col-md-4'))
         ->with('Detalle Distribución', array('class' => 'col-md-8'));
     $formMapper
         ->with('Datos del Procedimiento')
             ->add('idAreaModEstab', 'entity', array(
                 'label' => 'Area a la que pertenece la especialidad',
                 'required' => true,
                 'class' => 'MinsalSiapsBundle:MntAreaModEstab',
                 'query_builder' => function(EntityRepository $repositorio) {
                     return $repositorio
                     ->createQueryBuilder('areamodestab')
                     ->where('areamodestab.idAreaAtencion=1')
                     ->orderBy('areamodestab.id');
                 }
                 ))
                 ->add('idProcedimientoEstablecimiento', null, array('label' => 'Procedimiento', 'required' => true))
                 ->add('idEmpleado', null, array('label' => 'Médico'))
                 ->add('idTipoDistribucion', null, array('label' => 'Tipo Distribución', 'required' => false))
         ->end()
         ->with('Detalle Distribución')
             ->add('dia', 'choice', array('label' => 'Días de la semana',
             'choices' => $diasDeLaSemana,
             'multiple' => true, 'required' => true, 'expanded' => true,
             'attr' => array('class' => 'list-inline')))
             ->add('mes', 'choice', array('label' => 'Meses del año',
             'choices' => $meses,
             'multiple' => true, 'required' => true, 'expanded' => true,
             'attr' => array('class' => 'list-inline')))
             ->add('yrs', 'choice', array('label' => 'Año',
             'choices' => $anios,
             'multiple' => false, 'required' => true, 'expanded' => false,
             'empty_value' => 'Seleccionar...'))
             ->add('idRangohora', 'entity', array(
                 'label' => 'Rango de hora',
                 'required' => true,
                 'empty_value' => 'Seleccionar...',
                 'class' => 'MinsalSiapsBundle:MntRangohora',
                 'query_builder' => function(EntityRepository $repositorio) {
                     return $repositorio
                     ->createQueryBuilder('rangohora')
                     ->where('rangohora.activo=true')
                     ->andWhere('rangohora.idModulo=4')
                     ->orderBy('rangohora.horaIni');
                 }
                 ))
                 ->add('cupos', null, array('label' => 'Cupos', 'required' => true, 'data' => '0'))
                 ->add('maxCitasAgregadas', null, array('label' => 'Máximo Agregadas', 'required' => true))
                 ->add('tiempoLecturaDias', null, array('label' => 'Tiempo de lectura(días)', 'required' => true, 'data' => '0'))
          ->end()
         ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('cupos')
            ->add('maxCitasAgregadas')
            ->add('tiempoLecturaDias')
            ->add('dia')
            ->add('mes')
            ->add('yrs')
            ->add('fechahorareg')
            ->add('fechahoramod')
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalCitasBundle:CitDistribucionProcedimiento:list.html.twig';
                break;
            case 'delete':
                    return 'MinsalCitasBundle:CitDistribucionProcedimiento:delete.html.twig';
                    break;
            case 'activar':
                    return 'MinsalCitasBundle:CitDistribucionProcedimiento:activar.html.twig';
                    break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function validate(ErrorElement $errorElement, $object) {

        $dias = implode(",", $object->getDia());
        $meses = implode(",", $object->getMes());
        $horaIni = date_format($object->getIdRangohora()->getHoraIni(), 'h:i:s A');
        $horaFin = date_format($object->getIdRangohora()->getHoraFin(), 'h:i:s A');
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $con = $em->getConnection();


        if(count($object->getDia()) === 0){
            $errorElement
                ->with('error')
                    ->addViolation('Debe seleccionar al menos un día de la semana')
                ->end()
            ;
        }
        if (count($object->getMes()) === 0) {
            $errorElement
                ->with('error')
                    ->addViolation('Debe seleccionar al menos un mes del año')
                ->end()
                ;
        }

        if ($object->getIdEmpleado()) {
            // Verificando choque de horarios para distribuciones médicas existentes
            $dql = "SELECT A
            FROM MinsalCitasBundle:CitDistribucion A
            JOIN A.idRangohora B JOIN A.idEmpleado C
            WHERE C.id=" . $object->getIdEmpleado()->getId() .
            " AND B.id=" . $object->getIdRangohora()->getId() .
            " AND A.dia in ($dias) AND A.mes in ($meses) AND A.yrs=" . $object->getYrs();

            $repetido = $this->getModelManager()
            ->getEntityManager('MinsalCitasBundle:CitDistribucion')
            ->createQuery($dql)
            ->getArrayResult();

            if (count($repetido) > 0) {
                $especialidad = $em->find('MinsalCitasBundle:CitDistribucion',$repetido[0]['id'])->getIdAtenAreaModEstab();
                $mes = $em->find('MinsalCitasBundle:CitDistribucion',$repetido[0]['id'])->getNombreMes();
                $dia = $em->find('MinsalCitasBundle:CitDistribucion',$repetido[0]['id'])->getDiaSemana();
                $errorElement->with('error')
                ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución para este rango de hora en el mes de '.$mes.' el día '.$dia.' en la especialidad '.$especialidad)
                ->end();
            }
            else{
                //Verificando choque de horarios para distribuciones de procedimientos existentes
                $dql = "SELECT A
                FROM MinsalCitasBundle:CitDistribucionProcedimiento A
                JOIN A.idRangohora B
                JOIN A.idEmpleado C
                WHERE C.id=" . $object->getIdEmpleado()->getId() .
                " AND B.id=" . $object->getIdRangohora()->getId() .
                " AND A.dia in ($dias) AND A.mes in ($meses) AND A.yrs=" . $object->getYrs();

                $repetido = $this->getModelManager()
                ->getEntityManager('MinsalCitasBundle:CitDistribucionProcedimiento')
                ->createQuery($dql)
                ->getArrayResult();

                if (count($repetido) > 0) {
                    $procedimiento = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getIdProcedimientoEstablecimiento();
                    $mes = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getMonthName();
                    $dia = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getDayName();
                    $errorElement->with('error')
                    ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución para este rango de hora en el mes de '.$mes.' el día '.$dia.' en el procedimiento '.$procedimiento)
                    ->end();
                }
                else{
                    if ($object->getIdRangohora()) {

                        //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones del médico
                        $sql = "SELECT A.id
                        FROM cit_distribucion A
                        INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                        WHERE A.id_empleado= ".$object->getIdEmpleado()->getId() .
                        " AND A.yrs=". $object->getYrs() .
                        " AND A.dia in ($dias) AND A.mes in ($meses) AND
                        (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                         to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                         to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM')
                         )
                        ";

                        $query = $con->query($sql);
                        $result = $query->fetchAll();

                        if (count($result) > 0) {
                            $especialidad = $em->find('MinsalCitasBundle:CitDistribucion',$result[0]['id'])->getIdAtenAreaModEstab();
                            $mes = $em->find('MinsalCitasBundle:CitDistribucion',$result[0]['id'])->getNombreMes();
                            $dia = $em->find('MinsalCitasBundle:CitDistribucion',$result[0]['id'])->getDiaSemana();

                            $errorElement->with('error')
                            ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución que se traslapa con este rango de hora en el mes de '.$mes.' el día '.$dia.' en la especialidad '.$especialidad)
                            ->end();
                        }
                        else{
                            //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones de procedimientos del médico
                            $sql = "SELECT A.id
                            FROM cit_distribucion_procedimiento A
                            INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                            WHERE A.id_empleado= ".$object->getIdEmpleado()->getId() ." AND A.yrs=". $object->getYrs() .
                            " AND A.dia in ($dias) AND A.mes in ($meses) AND
                            (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                             to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                             to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM')
                             )
                            ";

                            $query = $con->query($sql);
                            $result = $query->fetchAll();

                            if (count($result) > 0) {
                                $procedimiento = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getIdProcedimientoEstablecimiento();
                                $mes = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getMonthName();
                                $dia = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getDayName();

                                $errorElement->with('error')
                                ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución que se traslapa con este rango de hora en el mes de '.$mes.' el día '.$dia.' en el procedimiento '.$procedimiento)
                                ->end();
                            }
                        }
                    }
                }
            }
        }else {
            //Verificando choque de horarios para distribuciones de procedimientos existentes
            $dql = "SELECT A
            FROM MinsalCitasBundle:CitDistribucionProcedimiento A
            JOIN A.idRangohora B
            WHERE B.id=" . $object->getIdRangohora()->getId() .
            " AND A.dia in ($dias) AND A.mes in ($meses) AND A.idEmpleado IS NULL
              AND A.yrs=" . $object->getYrs().
            " AND A.idProcedimientoEstablecimiento=".$object->getIdProcedimientoEstablecimiento()->getId();

            $repetido = $this->getModelManager()
            ->getEntityManager('MinsalCitasBundle:CitDistribucionProcedimiento')
            ->createQuery($dql)
            ->getArrayResult();

            if (count($repetido) > 0) {
                $procedimiento = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getIdProcedimientoEstablecimiento();
                $mes = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getMonthName();
                $dia = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$repetido[0]['id'])->getDayName();

                $errorElement->with('error')
                ->addViolation('Esta distribución no puede crearse, porque ya existe una distribución de procedimiento para este rango de hora en el mes de '.$mes.' el día '.$dia.' en el procedimiento '.$procedimiento)
                ->end();
            }else {
                if ($object->getIdRangohora()) {
                    //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones de procedimientos
                    $sql = "SELECT A.id
                    FROM cit_distribucion_procedimiento A
                    INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                    WHERE A.yrs=". $object->getYrs() .
                    " AND A.dia in ($dias) AND id_procedimiento_establecimiento=".$object->getIdProcedimientoEstablecimiento()->getId()." AND
                    A.mes in ($meses) AND A.id_empleado IS NULL AND
                    (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                     to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                     to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM')
                     )
                    ";

                    $query = $con->query($sql);
                    $result = $query->fetchAll();

                    if (count($result) > 0) {
                        $procedimiento = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getIdProcedimientoEstablecimiento();
                        $mes = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getMonthName();
                        $dia = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result[0]['id'])->getDayName();

                        $errorElement->with('error')
                        ->addViolation('Esta distribución no puede crearse, porque ya existe una distribución de procedimiento que se traslapa con este rango de hora el día '.$dia.' en el mes de '.$mes.' para el procedimiento '.$procedimiento)
                        ->end();
                    }
                }
            }
        }
    }
    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('batch');
        $collection->remove('export');
        $collection->add('edit');
        $collection->add('activar',$this->getRouterIdParameter().'/activar');
    }
}
