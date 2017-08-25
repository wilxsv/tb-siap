<?php

namespace Minsal\SeguimientoBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * SecHistorialClinicoRepository
 *
 */
class SecHistorialClinicoRepository extends EntityRepository {
    /*
     * DESCRIPCIÓN: Método que se utiliza para hacer la consulta de si hay Historiales clinicos, 
     *              para ese expediente, en esa especialidad con ese médico.
     * PARÁMETROS DE ENTRADA:
     *                  -idEmpleado: es el sexo del paciente.
     *                  -idExpediente: edad del paciente.
     *                  -idAtenAreaModEstab: la especialidad con la que trabaja el médico.
     * RETORNA:
     *                  -Objetos tipo SecHistorialClinico que sean coincidentes con las variables.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function obtenerHistorialClinico($idEmpleado, $idExpediente, $idAtenAreaModEstab) {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('shc')
                        ->from('MinsalSeguimientoBundle:SecHistorialClinico', 'shc')
                        ->innerJoin('shc.idAtenAreaModEstab', 'esp')
                        ->innerJoin('shc.idEmpleado', 'emp')
                        ->innerJoin('shc.idExpediente', 'exp')
                        ->where("esp.id = $idAtenAreaModEstab")
                        ->andWhere("emp.id = $idEmpleado")
                        ->andWhere("exp.id = $idExpediente")
                        ->andWhere('shc.fechaconsulta != CURRENT_DATE()')
                        //->setParameters(array('idEmpleado' => $idEmpleado, 'idExpediente' => $idExpediente, 'idAtenAreaModEstab' => $idAtenAreaModEstab))
                        ->getQuery()
                        ->getResult();
    }

}
