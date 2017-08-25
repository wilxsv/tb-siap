<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CitDistribucionAdmin extends Admin {

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('Datos Médico', array('class' => 'col-md-4'))
            ->with('Detalle Distribución', array('class' => 'col-md-8'));
        $diasDeLaSemana = array(8 => 'Todos los días', 1 => 'Lunes', 2 => 'Martes',3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes');
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
                ->with('Datos Médico')
                ->add('idAreaModEstab', 'entity', array(
                    'label' => 'Area a la que pertenece la especialidad',
                    'required' => false,
                    'class' => 'MinsalSiapsBundle:MntAreaModEstab',
                    'query_builder' => function(EntityRepository $repositorio) {
                            return $repositorio
                                ->createQueryBuilder('areamodestab')
                                ->where('areamodestab.idAreaAtencion=1')
                                ->orderBy('areamodestab.id');
                    }
                ))
                ->add('idAtenAreaModEstab', null, array('label' => 'Especialidad', 'required' => true))
                ->add('idEmpleado', null, array('label' => 'Médico', 'required' => true))
                ->add('idTipoDistribucion', null, array('label' => 'Tipo Distribución', 'required' => false))
                ->end();
        $formMapper
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
                ->add('idConsultorio', null, array('label' => 'Consultorio', 'required' => true, 'empty_value' => 'Seleccionar...'))
                ->add('primera', null, array('label' => 'Primera Vez', 'required' => true))
                ->add('subsecuente', null, array('label' => 'Subsecuentes', 'required' => true))
                ->add('maxCitasAgregadas', null, array('label' => 'Máximo Agregadas', 'required' => true))
                ->end();
    }

    public function validate(ErrorElement $errorElement, $object) {

        $dias = implode(",", $object->getDia());
        $meses = implode(",", $object->getMes());
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
            JOIN A.idRangohora B
            JOIN A.idEmpleado C
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
                //Verificando choque de horarios para distribuciones de procedimientos existentes con el mismo médico
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
            }
        }else{
            $errorElement->with('error')
            ->addViolation('Debe de seleccionar un médico')
            ->end();
        }

        if ($object->getIdRangohora()) {
            $horaIni = date_format($object->getIdRangohora()->getHoraIni(), 'h:i:s A');
            $horaFin = date_format($object->getIdRangohora()->getHoraFin(), 'h:i:s A');

            //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones del médico
            $sql = "SELECT A.id,A.id_aten_area_mod_estab,A.dia
            FROM cit_distribucion A
            INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
            WHERE A.id_empleado= ".$object->getIdEmpleado()->getId() .
            " AND A.yrs=". $object->getYrs() ." AND A.dia in ($dias) AND A.mes in ($meses) AND
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
                ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución que se traslapa con este rango de hora el día '.$dia.' en el mes de '.$mes.' en la especialidad '.$especialidad)
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
                    ->addViolation('Esta distribución no puede crearse, porque el médico ya tiene una distribución que se traslapa con este rango de hora el día '.$dia.' en el mes de '.$mes.' para el procedimiento '.$procedimiento)
                    ->end();
                }
            }
        }else{
            $errorElement->with('error')
            ->addViolation('Debe de seleccionar el rango de hora')
            ->end();
        }

    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('batch');
        $collection->remove('export');
        $collection->add('edit');
        $collection->add('activar',$this->getRouterIdParameter().'/activar');
    }



    /*
     * DESCRIPCIÓN: Función que se realiza para.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalCitasBundle:CitDistribucion:list.html.twig';
                break;
            case 'delete':
                    return 'MinsalCitasBundle:CitDistribucion:delete.html.twig';
                    break;
            case 'activar':
                return 'MinsalCitasBundle:CitDistribucion:activar.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
