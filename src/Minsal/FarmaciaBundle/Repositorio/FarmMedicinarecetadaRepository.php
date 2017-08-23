<?php

namespace Minsal\FarmaciaRepositorio\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\SeguimientoBundle\Entity\SecAntecedentes;
use Doctrine\DBAL as DBAL;

/**
 * FarmMedicinarecetadaRepository
 *
 */
class FarmMedicinarecetadaRepository extends EntityRepository {
    /*
     * DESCRIPCIÓN: Método que se utiliza para obtener el medicamento prescripto
     *                para una determina histopria clínica.
     * PARÁMETROS DE ENTRADA:
     *                  -idHistorialClinico: id del historial clínico a buscar.
     * RETORNA:
     *                  -Objetos tipo FarmMedicinarecetada que cumplan con la condición
     *                     de historial clínico.
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function obtenerMedicinaRecetada($idHistorialClinico) {
        $dql = "SELECT A
                  FROM MinsalFarmaciaBundle:FarmMedicinaRecetada A
                  JOIN A.idReceta B
                  JOIN B.idhistorialclinico C
                  WHERE C.id=$idHistorialClinico
                  ORDER BY A.id ASC
                  ";
        $consulta = $this->getEntityManager()
                ->createQuery($dql);

        return $consulta->getResult();
    }

}
