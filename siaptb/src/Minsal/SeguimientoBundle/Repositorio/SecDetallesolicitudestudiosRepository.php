<?php

namespace Minsal\SeguimientoBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * SecDetallesolicitudestudiosRepository
 *
 */
class SecDetallesolicitudestudiosRepository extends EntityRepository {

    public function findSuministrantesDelDetalleSolicitud($idSolicitud, $excluirSuministrante = array(1))
    {
        $em = $this->getEntityManager();

        $idsExcluir = implode(',', $excluirSuministrante);

        $dql = "SELECT t02
                FROM MinsalSeguimientoBundle:SecDetallesolicitudestudios t01
                INNER JOIN MinsalLaboratorioBundle:LabSuministrante      t02 WITH (t02.id = t01.idSuministrante)
                WHERE t01.idsolicitudestudio = $idSolicitud AND t02.id NOT IN ($idsExcluir)";

        $result = $em->createQuery($dql)
                     ->getResult();

        return $result;
    }
}
