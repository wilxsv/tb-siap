<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
Use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class CitCitasDiaAdmin extends Admin {

    public function getTemplate($name) {
        switch ($name) {
            case 'agenda':
                return 'MinsalCitasBundle:Custom:agenda.html.twig';
                break;
            case 'agenda_dia':
                return 'MinsalCitasBundle:Custom:agenda_dia_medico.html.twig';
                break;
            case 'transfer':
                return 'MinsalCitasBundle:Custom:transfer.html.twig';
                break;
            case 'cseleccion':
                return 'MinsalCitasBundle:ClinicaSeleccion:Tablero.html.twig';
                break;
            case 'reprogramar':
                return 'MinsalCitasBundle:CitasMedicas:reprogramar.html.twig';
                break;
            case 'asignar':
                return 'MinsalCitasBundle:CitasMedicas:asignar.html.twig';
                break;
            case 'cita_referencia':
                return 'MinsalSiapsBundle:MntPacienteAdmin:list.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('batch');
        $collection->remove('export');
        $collection->remove('delete');
        $collection->add('agenda_dia', 'agenda/dia');
        $collection->add('transfer');
        $collection->add('cseleccion');
        $collection->add('citamedica_eliminar','citamedica/eliminar');
        $collection->add('reprogramar','reprogramar');
        $collection->add('citamedica_busqueda','citamedica/busqueda');
        $collection->add('asignar','asignar');
        $collection->add('cita_referencia','cita/referencia');
        $collection->add('citamedica_consulta','citamedica/consulta');
        $collection->add('citamedica_programadas','citamedica/programadas');
        $collection->add('citamedica_fechaslibres','citamedica/fechaslibres');
        $collection->add('citamedica_estadistica','citamedica/estadistica');
        $collection->add('citamedica_eliminadas','citamedica/eliminadas');
        $collection->add('reporte_produccion','reporte/produccion');

    }
}
