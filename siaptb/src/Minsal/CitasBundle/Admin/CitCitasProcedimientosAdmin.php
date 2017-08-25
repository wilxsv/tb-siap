<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

class CitCitasProcedimientosAdmin extends Admin
{
    /*
     * DESCRIPCIÓN: Función que se realiza para.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalCitasBundle:CitCitasProcedimientos:asignar.html.twig';
                break;
            case 'agenda':
                return 'MinsalCitasBundle:CitCitasProcedimientos:agenda.html.twig';
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
        $collection->add('consulta','consulta');
        $collection->add('busqueda','busqueda');
        $collection->add('agenda','agenda');
        $collection->add('fechaslibres','fechaslibres');
    }
}
