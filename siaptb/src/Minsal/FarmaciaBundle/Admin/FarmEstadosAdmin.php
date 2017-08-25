<?php

namespace Minsal\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;


class FarmEstadosAdmin extends Admin
{

  public function getTemplate($name) {
    switch ($name) {
      case 'list':
        return 'MinsalFarmaciaBundle:FarmEstados:list.html.twig';
      break;
      case 'listar_pacientes_aptos':
        return 'MinsalFarmaciaBundle:FarmEstados:listar_pacientes.html.twig';
      break;
      default:
      return parent::getTemplate($name);
      break;
    }
  }

  protected function configureRoutes(RouteCollection $collection) {
    $collection->add('listar_pacientes_aptos','listar/pacientes/aptos');
    $collection->remove('create');
    $collection->remove('delete');
    $collection->remove('edit');
  }
}
