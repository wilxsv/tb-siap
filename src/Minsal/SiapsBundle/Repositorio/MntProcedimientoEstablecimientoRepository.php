<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * MntProcedimientoEstablecimientoRepository
 *
 */
class MntProcedimientoEstablecimientoRepository extends EntityRepository {

    /*
     * DESCRIPCIÓN: Obtiene los procedimientos configurados para el establecimiento si no lleva parámetros,
     * los procedimientos y empleados con distribución para una de atención en especifico si se indica el área,
     * los médicos con distribución en un procedimiento si se indica el procedimiento y area
     * PARAMETROS: id del procedimiento(opcional), area de atención(opcional) y empleado (opcional)
     */
    public function obtenerProcedimientosEstablecimiento($objetoRequerido ,$idAreaModEstab,$idEmpleado,$idProcedimientoDistribucion) {

        $em = $this->getEntityManager();
        $whereProcedimiento = '';
        $whereArea = '';
        $whereEmpleado = '';
        $joinEmpleado = '';
        $joinArea = '';

        if($objetoRequerido == 'empleado'){
            $entidad = 'DISTINCT C';
            $joinEmpleado = " JOIN MinsalSiapsBundle:MntEmpleado C WITH (B.idEmpleado = C.id)";
        }else {
            $entidad = 'A';
        }

        if ($idAreaModEstab != NULL){
            $joinArea = " JOIN MinsalCitasBundle:CitDistribucionProcedimiento B WITH (B.idProcedimientoEstablecimiento = A.id) ";
            $whereArea = " WHERE B.idAreaModEstab=" . $idAreaModEstab;
        }
        if ($idProcedimientoDistribucion != NULL){
            $whereProcedimiento = " AND B.idEmpleado is not null AND B.idProcedimientoEstablecimiento=" . $idProcedimientoDistribucion;
        }
        if ($idEmpleado != NULL){
            $whereEmpleado = " AND B.idEmpleado=" . $idEmpleado;
        }

        $dql = "SELECT $entidad
                FROM MinsalSiapsBundle:MntProcedimientoEstablecimiento A"
                .$joinArea
                .$joinEmpleado
                .$whereArea
                .$whereProcedimiento
                .$whereEmpleado ;

        //$dql.=" ORDER BY A.idCiq";
//echo $dql;exit;
        $resultados= $em->createQuery($dql)
                    ->getResult();

        return $resultados;
    }
}
