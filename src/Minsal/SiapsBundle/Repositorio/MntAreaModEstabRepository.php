<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * MntAreaModEstabRepository
 *
 */
class MntAreaModEstabRepository extends EntityRepository {

    public function obtenerAreaModEstabDeEmpleado($idEmpleado) {
        $em = $this->getEntityManager();

        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento  = $CtlEstablecimiento->getId();

        $dql = "SELECT DISTINCT IDENTITY(t01.idAreaModEstab) as id
                FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab t01
                WHERE t01.idEmpleado = :idEmpleado";

        $result = $em->createQuery($dql)
                     ->setParameter(':idEmpleado', $idEmpleado)
                     ->getArrayResult();

        $ids = array();

        if( count($result) > 0 ) {
            foreach ($result as $key => $row) {
                $ids[] = $row['id'];
            }
        }

        $ids = count($ids) > 0 ? implode(',',$ids) : '';

        if(count($result) > 0) {
            $dql = "SELECT t01.id,
                           IDENTITY(t01.idAreaAtencion) AS idAreaAtencion,
                           t02.nombre AS nombreAreaAtencion,
                           t04.id AS idModalidad,
                           t04.nombre AS nombreModalidad,
                           IDENTITY (t01.idServicioExternoEstab) AS idServicioExterno,
                           t06.nombre AS nombreServicioExterno,
                           t06.abreviatura AS abreviaturaServicioExterno
                    FROM MinsalSiapsBundle:MntAreaModEstab                        t01
                    JOIN MinsalSiapsBundle:CtlAreaAtencion                        t02 WITH(t02.id = t01.idAreaAtencion)
                    JOIN MinsalSiapsBundle:MntModalidadEstablecimiento            t03 WITH(t03.id = t01.idModalidadEstab)
                    JOIN MinsalSiapsBundle:CtlModalidad                           t04 WITH(t04.id = t03.idModalidad)
                    LEFT JOIN MinsalSiapsBundle:MntServicioExternoEstablecimiento t05 WITH(t05.id = t01.idServicioExternoEstab)
                    LEFT JOIN MinsalSiapsBundle:MntServicioExterno                t06 WITH(t06.id = t05.idServicioExterno)
                    WHERE t01.idEstablecimiento = :idEstablecimiento
                        AND t01.id IN ($ids)";

            $result = $em->createQuery($dql)
                         ->setParameter(':idEstablecimiento', $idEstablecimiento)
                         ->getArrayResult();
        }

        return $result;
    }

    public function obtenerAreaModEstab() {
        $em = $this->getEntityManager();

        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento  = $CtlEstablecimiento->getId();

        $dql = "SELECT t01.id,
                       IDENTITY(t01.idAreaAtencion) AS idAreaAtencion,
                       t02.nombre AS nombreAreaAtencion,
                       t04.id AS idModalidad,
                       t04.nombre AS nombreModalidad,
                       IDENTITY (t01.idServicioExternoEstab) AS idServicioExterno,
                       t06.nombre AS nombreServicioExterno,
                       t06.abreviatura AS abreviaturaServicioExterno
                FROM MinsalSiapsBundle:MntAreaModEstab                        t01
                JOIN MinsalSiapsBundle:CtlAreaAtencion                        t02 WITH(t02.id = t01.idAreaAtencion)
                JOIN MinsalSiapsBundle:MntModalidadEstablecimiento            t03 WITH(t03.id = t01.idModalidadEstab)
                JOIN MinsalSiapsBundle:CtlModalidad                           t04 WITH(t04.id = t03.idModalidad)
                LEFT JOIN MinsalSiapsBundle:MntServicioExternoEstablecimiento t05 WITH(t05.id = t01.idServicioExternoEstab)
                LEFT JOIN MinsalSiapsBundle:MntServicioExterno                t06 WITH(t06.id = t05.idServicioExterno)
                WHERE t01.idEstablecimiento = :idEstablecimiento";

        $result = $em->createQuery($dql)
                     ->setParameter(':idEstablecimiento', $idEstablecimiento)
                     ->getArrayResult();

        return $result;
    }
}
