<?php

namespace Minsal\FarmaciaBundle\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\SeguimientoBundle\Entity\SecAntecedentes;
use Doctrine\DBAL as DBAL;

/**
 * FarmCatalogoproductosRepository
 *
 */
class FarmCatalogoproductosRepository extends EntityRepository {
    /*
     * DESCRIPCIÓN: .
     * PARÁMETROS DE ENTRADA:
     *                  -idHistorialClinico: id del historial clínico a buscar.
     * RETORNA:
     *                  -Resultado de medicamentos levantados para area
     * ANALISTA PROGRAMADOR: Inga. Jasmin Menjivar
     */

    public function obtenerMedicamentosLevandados($idHistorialClinico) {
        $em = $this->getEntityManager();

        $historialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);
        $modalidad = $historialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();

        $sql = "SELECT COUNT(*) as cuantos
                FROM farm_catalogoproductos fcp
                    INNER JOIN farm_catalogoproductosxestablecimiento fcpxe ON (fcp.id=fcpxe.idmedicina AND condicion = 'H' AND fcpxe.idestablecimiento=(SELECT id FROM ctl_establecimiento WHERE configurado=true) AND idmodalidad = $modalidad)
                    INNER JOIN mnt_areamedicina mam ON (fcp.id=mam.idmedicina AND mam.idarea=(SELECT idarea FROM mnt_areafarmaciaxestablecimiento WHERE dispensar_seguimiento = true and habilitado = 'S' and idestablecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado=true) and idmodalidad = $modalidad))
                    LEFT JOIN farm_medicinaexistenciaxarea fmea ON fcp.id=fmea.idmedicina";

        $stm = $em->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();


        return $result;
    }

}
