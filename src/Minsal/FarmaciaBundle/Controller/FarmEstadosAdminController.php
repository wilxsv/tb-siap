<?php

namespace Minsal\FarmaciaBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class FarmEstadosAdminController extends CRUDController{

  /*
   * DESCRIPCIÓN: Método que es utilizado para mostrar la cantidad de pacientes aptos a envio de farmacia especializada
   * PARAMETROS ENTRADA:
   *          NO TIENE
   *  PARAMETROS RETORNO:
   *          NO TIENE
   * ANALISTA PROGRAMADOR: Ing. Karen Elvira Peñate Aviles
   */
  public function listarPacientesAptosAction() {


      $user = $this->container->get('security.context')->getToken()->getUser();
      if ($user->hasRole('ROLE_SONATA_ADMIN_SECHISTORIALCLINICO_PACIENTESAPTOSESPECIALIZADA') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
          return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                      'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
          ));
      }

      $sql="SELECT
      SUM(CASE WHEN id_doc_ide_paciente IN (1) THEN 1 ELSE 0 END) as con_dui,
      SUM(CASE WHEN id_doc_ide_paciente IN (11) THEN 1 ELSE 0 END) as carnet_residente,
      SUM(CASE WHEN id_doc_ide_paciente NOT IN (1,11) OR id_doc_ide_paciente IS NULL THEN 1 ELSE 0 END) as sin_nada
      FROM(
      SELECT DISTINCT(tb06.id),id_doc_ide_paciente
      FROM
      sec_historial_clinico tb01
      JOIN farm_recetas tb02 ON (tb02.idhistorialclinico = tb01.id)
      JOIN farm_medicinarecetada tb03 ON (tb03.idreceta = tb02.id)
      JOIN mnt_expediente tb05 ON (tb05.id = tb01.id_numero_expediente)
      JOIN mnt_paciente tb06 ON (tb06.id = tb05.id_paciente)
      JOIN farm_catalogoproductos tb07 ON (tb07.id = tb03.idmedicina)
      JOIN farm_catalogoproductosxestablecimiento tb08 ON (tb07.id = tb08.idmedicina)
      WHERE
      CAST(SPLIT_PART(fn_calcular_edad(tb06.id,'anio'),' ',1)as integer) >=18 AND CAST(SPLIT_PART(fn_calcular_edad(tb06.id,'anio'),' ',1)as integer)<=125 AND
      idsubservicio IN (
         SELECT e.id FROM mnt_aten_area_mod_estab e
         INNER JOIN ctl_atencion a ON (e.id_atencion = a.id)
         INNER JOIN mnt_area_mod_estab area ON (e.id_area_mod_estab = area.id AND area.id_area_atencion = 1 AND area.id_servicio_externo_estab IS NULL)
         INNER JOIN mnt_modalidad_establecimiento mod ON (area.id_modalidad_estab = mod.id AND mod.id_modalidad = 1)
         WHERE a.id IN (9,11,12,13,14)
      ) AND
      tb08.medicamento_especializada = 1) AS resultado";

      $stm = $this->container->get('database_connection')->prepare($sql);
      $stm->execute();
      $pacientes = $stm->fetchAll();



      return $this->render($this->admin->getTemplate('listar_pacientes_aptos'), array(
                  'action' => 'list',
                  'pacientes'=>$pacientes
      ));
  }
}
