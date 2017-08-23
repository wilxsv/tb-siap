<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * MntEmpleadoRepository
 *
 */
class MntEmpleadoRepository extends EntityRepository {
    public function obtenerMedicosPorEspecialidad($idAtenAreaModEstab) {

        $em = $this->getEntityManager();

        $dql = "SELECT DISTINCT B
        FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
        JOIN MinsalSiapsBundle:MntEmpleado B WITH (A.idEmpleado = B.id and A.idAtenAreaModEstab=$idAtenAreaModEstab AND B.habilitado=true)
        WHERE B.idTipoEmpleado=4
        ORDER BY B.nombreempleado ASC";

        $resultados= $em->createQuery($dql)
                ->getResult();
        return $resultados;
    }

    public function obtenerMedicosPorArea($idAreaModEstab) {

        $em = $this->getEntityManager();

        $dql = "SELECT DISTINCT B
        FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
        JOIN MinsalSiapsBundle:MntEmpleado B WITH (A.idEmpleado = B.id AND B.habilitado=true)
        JOIN MinsalSiapsBundle:MntAtenAreaModEstab C WITH (A.idAreaModEstab = C.idAreaModEstab and C.idAreaModEstab=$idAreaModEstab)
        WHERE B.idTipoEmpleado = 4
        ORDER BY B.nombreempleado ASC";

        $resultados= $em->createQuery($dql)->getResult();

        return $resultados;
    }

}
