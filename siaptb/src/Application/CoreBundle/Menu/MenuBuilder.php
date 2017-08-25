<?php

// src/Application/CoreBundle/Menu/MenuBuilder.php

namespace Application\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

    private $menu;
    private $cat = array('AD' => array('label' => 'Administración',          'icon' => 'glyphicon glyphicon-cog'),
                         'IP' => array('label' => 'Identificación Paciente', 'icon' => 'glyphicon glyphicon-edit'),
                         'CT' => array('label' => 'Citas',                   'icon' => 'glyphicon glyphicon-time'),
                         'AG' => array('label' => 'Agenda',                  'icon' => 'fa fa-calendar'),
                         'HC' => array('label' => 'Historial Clinico',       'icon' => 'fa fa-h-square'),
                         'LB' => array('label' => 'Laboratorio',             'icon' => 'fa fa-flask'),
                         'FR' => array('label' => 'Farmacia',                'icon' => 'fa fa-medkit'),
                         'RP' => array('label' => 'Reporte',                 'icon' => 'glyphicon glyphicon-file'),
                         'US' => array('label' => 'Usuario',                 'icon' => 'glyphicon glyphicon-user'),
                         'SQ' => array('label' => 'Solicitud Quirurgica',    'icon' => 'fa fa-list-alt')
                        );

    public function mainMenu(FactoryInterface $factory, array $options) {
        $this->menu = $factory->createItem('root');
        $this->menu->setChildrenAttribute('class', 'nav navbar-nav');

        $admin = $options['admin'];
        $user = $options['user'];

        /* Creacion del Menu dinamico */
        foreach ($admin as $key => $value) {
            if ($key == "sonata_user") {
                $key = "US-1-Gestión de Usuario";
            }
            list($category, $level, $label) = explode("-", $key);

            $this->createDropDownMenu($value['items'], $this->cat[$category]['label'], $label, $level, $this->cat[$category]['icon']);
        }
        /* Creacion del menu estatico */
        $this->createStaticMenu($user);

        /* AGREGANDO MENU DE AYUDA */
        $this->menu->addChild('Ayuda')->setAttribute('dropdown', true)->setAttribute('icon', 'fa fa-question-circle');
        $this->menu['Ayuda']->addChild('Acerca de', array('uri' => '#myModal'))
                ->setLinkAttribute('id', 'about_info_modal')
                ->setLinkAttribute('custom-modal', 'true')
                ->setLinkAttribute('role', 'button')
                ->setLinkAttribute('btnCustom', 'true')
                ->setLinkAttribute('data-toggle', 'modal')
                ->setLinkAttribute('tabindex', '-1');

        $this->menu['Ayuda']->addChild('Manual de Usuario', array('uri' => '#'))
                ->setLinkAttribute('id', 'manualUsuario');

        return $this->menu;
    }

    private function countItemsGranted(array $items) {
        $array = array();

        foreach ($items as $key => $object) {
            if ($object->hasroute('list') && $object->isGranted('LIST')) {
                if ($object->getLabel() == "groups") {
                    $array[] = array('label' => "Grupos", 'url' => $object->generateUrl('list'));
                } else {
                    $array[] = array('label' => $object->getLabel(), 'url' => $object->generateUrl('list'));
                }
            }
        }

        return $array;
    }

    private function createDropDownMenu($object, $catLabel, $label, $level, $icon) {
        $contMenu = $this->countItemsGranted($object);

        if (count($contMenu) != 0) {
            if (!$this->menu[$catLabel]) {
                $this->menu->addChild($catLabel)->setAttribute('dropdown', true)->setAttribute('icon', $icon);
            }

            switch ($level) {
                case '1':
                    foreach ($contMenu as $keya => $itema) {
                        $this->menu[$catLabel]->addChild($itema['label'], array('uri' => $itema['url']));
                    }
                    break;
                case '2':
                    if (!$this->menu[$catLabel][$label]) {
                        $this->menu[$catLabel]->addChild($label)->setAttribute('dropdown', true);
                    }

                    foreach ($contMenu as $keyb => $itemb) {
                        $this->menu[$catLabel][$label]->addChild($itemb['label'], array('uri' => $itemb['url']));
                    }
                    break;

                default:

                    break;
            }
        }
    }

    private function createStaticMenu($user) {
        /*****************************************/
        /***  IDENTIFICACIÓN PACIENTE      *******/
        /*****************************************/
        if ($user->hasRole('ROLE_USER_LISTAREXPEDIENTES') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Reporte']){
                    $this->menu->addChild('Reporte')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-file');
            }
            if (!$this->menu['Reporte']['Identificación Paciente']) {
                $this->menu['Reporte']->addChild('Identificación Paciente')->setAttribute('dropdown', true);
            }
            $this->menu['Reporte']['Identificación Paciente']->addChild('Expedientes Creados por Usuario', array('route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes'));
            $this->menu['Reporte']['Identificación Paciente']->addChild('Cantidad de Expedientes por Año', array('route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_anio'));
            if ($user->getIdEstablecimiento()){
                if($user->getIdEstablecimiento()->getTipoExpediente()=='G')
                    $this->menu['Reporte']['Identificación Paciente']->addChild('Cantidad de Expedientes por Correlativo Anual', array('route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_correlativo'));
            }


        }

        if ($user->hasRole('ROLE_USER_DEPURACION') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $this->menu['Identificación Paciente']->addChild('Depuración de expedientes')->setAttribute('dropdown', true);
            $this->menu['Identificación Paciente']['Depuración de expedientes']->addChild('Eliminación Física de Expediente', array('route' => 'admin_minsal_siaps_mntexpediente_depuracion'));
            if (!$this->menu['Reporte']['Identificación Paciente']) {
                $this->menu['Reporte']->addChild('Identificación Paciente')->setAttribute('dropdown', true);
            }
            $this->menu['Reporte']['Identificación Paciente']->addChild('Listados de Expedientes Eliminados', array('route' => 'admin_minsal_siaps_mntexpediente_reporte_depuracion'));
        }

        if ($user->hasRole('ROLE_USER_BUSCAREMERGENCIA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $this->menu['Identificación Paciente']->addChild('Registrar Emergencia', array('route' => 'admin_minsal_siaps_mntpaciente_buscaremergencia'));
            $this->menu['Reporte']['Identificación Paciente']->addChild('Emergencias por Fecha', array('route' => 'admin_minsal_seguimiento_secemergencia_resumen_emergencia'));
        }

        /*****************************************/
        /*****   CITAS                 ***********/
        /*****************************************/

        if ($user->hasRole('ROLE_SONATA_ADMIN_AGENDADIA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Agenda']){
                $this->menu->addChild('Agenda')->setAttribute('dropdown', true)->setAttribute('icon', 'fa fa-calendar');
            }

            $this->menu['Agenda']->addChild('Agenda del Día', array('route' => 'admin_minsal_citas_citcitasdia_agenda_dia'));
        }

        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_TRANSFER') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            if (!$this->menu['Citas']['Citas Médicas']) {
                $this->menu['Citas']->addChild('Citas Médicas')->setAttribute('dropdown', true);
            }

            $this->menu['Citas']['Citas Médicas']->addChild('Transferir Citados', array('route' => 'admin_minsal_citas_citcitasdia_transfer'));
        }

        if ($user->hasRole('ROLE_SONATA_ADMIN_CITAMEDICAS') || $user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_REPORTES')) {
            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            if (!$this->menu['Citas']['Citas Médicas']) {
                $this->menu['Citas']->addChild('Citas Médicas')->setAttribute('dropdown', true);
            }

            if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_REPROGRAMAR') || $user->hasRole('ROLE_SUPER_ADMIN')) {
                $this->menu['Citas']['Citas Médicas']->addChild('Reprogramar', array('route' => 'admin_minsal_citas_citcitasdia_reprogramar'));
            }
            //SOLO PARA DAR CITAS
            if($user->hasRole('ROLE_SONATA_ADMIN_CITAMEDICAS') || $user->hasRole('ROLE_SUPER_ADMIN')){
                $this->menu['Citas']['Citas Médicas']->addChild('Asignar', array('route' => 'admin_minsal_citas_citcitasdia_asignar'));
            }
            $this->menu['Citas']['Citas Médicas']->addChild('Busqueda', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_busqueda'));

            if (!$this->menu['Reporte']){
                    $this->menu->addChild('Reporte')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-file');
            }

            if (!$this->menu['Reporte']['Citas']) {
                $this->menu['Reporte']->addChild('Citas')->setAttribute('dropdown', true);
            }
            $this->menu['Reporte']['Citas']->addChild('Consulta de Citas Médicas por día', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_consulta'));
            $this->menu['Reporte']['Citas']->addChild('Fechas libres para Citas Médicas', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_fechaslibres'));
            $this->menu['Reporte']['Citas']->addChild('Estadistica de citas programadas por médico', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_estadistica'));
            $this->menu['Reporte']['Citas']->addChild('Consulta citas programadas', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_programadas'));
            $this->menu['Reporte']['Citas']->addChild('Producción de citas por empleado', array('route' => 'admin_minsal_citas_citcitasdia_reporte_produccion'));
            $this->menu['Reporte']['Citas']->addChild('Listado de citas eliminadas', array('route' => 'admin_minsal_citas_citcitasdia_citamedica_eliminadas'));
        }

        if ($user->hasRole('ROLE_MINSAL_CITAS_ADMIN_CIT_CITAS_PROCEDIMIENTOS_LIST') || $user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_MINSAL_CITAS_ADMIN_CIT_CITAS_PROCEDIMIENTOS_REPORTES')) {

            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            if ($user->hasRole('ROLE_MINSAL_CITAS_ADMIN_CIT_CITAS_PROCEDIMIENTOS_AGENDA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
                if (!$this->menu['Agenda']){
                    $this->menu->addChild('Agenda')->setAttribute('dropdown', true)->setAttribute('icon', 'fa fa-calendar');
                }

                $this->menu['Agenda']->addChild('Agenda de Procedimientos', array('route' => 'admin_minsal_citas_citcitasprocedimientos_agenda'));
            }
            if (!$this->menu['Reporte']){
                    $this->menu->addChild('Reporte')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-file');
            }
            if (!$this->menu['Citas']['Citas Procedimiento']) {
                $this->menu['Citas']->addChild('Citas Procedimiento')->setAttribute('dropdown', true);
            }

            $this->menu['Citas']['Citas Procedimiento']->addChild('Busqueda', array('route' => 'admin_minsal_citas_citcitasprocedimientos_busqueda'));

            if (!$this->menu['Reporte']['Citas']) {
                $this->menu['Reporte']->addChild('Citas')->setAttribute('dropdown', true);
            }
            $this->menu['Reporte']['Citas']->addChild('Consulta de Citas de Procedimientos por día', array('route' => 'admin_minsal_citas_citcitasprocedimientos_consulta'));
            $this->menu['Reporte']['Citas']->addChild('Fechas libres para Citas de Procedimientos', array('route' => 'admin_minsal_citas_citcitasprocedimientos_fechaslibres'));

        }

        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_REFERENCIA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            if (!$this->menu['Citas']['Citas Médicas']) {
                $this->menu['Citas']->addChild('Citas Médicas')->setAttribute('dropdown', true);
            }

            $this->menu['Citas']['Citas Médicas']->addChild('Cita por Referencia', array('route' => 'admin_minsal_citas_citcitasdia_cita_referencia','routeParameters' => array( 'origenCita' => '1' )));
        }

        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASPROCEDIMIENTOS_REFERENCIA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            if (!$this->menu['Citas']['Citas Procedimiento']) {
                $this->menu['Citas']->addChild('Citas Procedimiento')->setAttribute('dropdown', true);
            }

            $this->menu['Citas']['Citas Procedimiento']->addChild('Cita por Referencia', array('route' => 'admin_minsal_citas_citcitasdia_cita_referencia','routeParameters' => array( 'origenCita' => '2' )));
        }


        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_CSELECCION') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Citas']){
                $this->menu->addChild('Citas')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-time');
            }
            $this->menu['Citas']->addChild('Clinica de Seleccion', array('route' => 'admin_minsal_citas_citcitasdia_cseleccion'));
        }

        /*****************************************/
        /*****   FARMACIA              ***********/
        /*****************************************/
        if ($user->hasRole('ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENT') || $user->hasRole('ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENTALL') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $this->menu['Farmacia']->addChild('Receta Repetitiva Complementaria', array('route' => 'admin_minsal_farmacia_farmrecetas_complement'));
        }

        if ($user->hasRole('ROLE_SONATA_ADMIN_SECHISTORIALCLINICO_PACIENTESAPTOSESPECIALIZADA') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $this->menu['Reporte']['Farmacia']->addChild('Pacientes Aptos para ser enviados a Farmacia Especializada', array('route' => 'admin_minsal_farmacia_farmestados_listar_pacientes_aptos'));
        }

        /*****************************************/
        /*****   SEGUIMIENTO CLÍNICO   ***********/
        /*****************************************/
        if ($user->hasRole('ROLE_SONATA_ADMIN_SECHISTORIALCLINICO_RETROACTIVE') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $this->menu['Historial Clinico']->addChild('Consulta Retroactiva', array('route' => 'admin_minsal_seguimiento_sechistorialclinico_retroactive'));
        }

        if($user->hasRole('ROLE_SONATA_ADMIN_CONSULTAS_ATENDIDAS') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            if (!$this->menu['Reporte']){
                    $this->menu->addChild('Reporte')->setAttribute('dropdown', true)->setAttribute('icon', 'glyphicon glyphicon-file');
            }

            if (!$this->menu['Reporte']['Seguimiento Clínico']) {
                $this->menu['Reporte']->addChild('Seguimiento Clínico')->setAttribute('dropdown', true);
            }

            $this->menu['Reporte']['Seguimiento Clínico']->addChild('Pacientes Atendidos', array('route' => 'admin_minsal_seguimiento_sechistorialclinico_pacientes_atendidos'));
            $this->menu['Reporte']['Seguimiento Clínico']->addChild('Historias clínicas por médico', array('route' => 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_medicos'));
        }
    }

}
