<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * MntAtenAreaModEstabRepository
 *
 */
class MntAtenAreaModEstabRepository extends EntityRepository {

    public function obtenerModalidadesUtilizada() {
        $dql="SELECT distinct(mod.id) id,mod.nombre
          FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
          JOIN atenAreaModEstab.idAreaModEstab areaModEstab
          JOIN areaModEstab.idModalidadEstab modEstab
          JOIN modEstab.idModalidad mod";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
        ;

        return $consulta->getResult();
    }



    public function obtenerAreaAtencionUtilizada($modalidad) {
        $dql="SELECT distinct(areaAten.id) id,areaAten.nombre
          FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
          JOIN atenAreaModEstab.idAreaModEstab areaModEstab
          JOIN areaModEstab.idModalidadEstab modEstab
          JOIN areaModEstab.idAreaAtencion areaAten
          WHERE modEstab.idModalidad =:modalidad";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameter('modalidad', $modalidad)
        ;

        return $consulta->getResult();
    }

    public function obtenerAtencionesPadresModalidad($modalidad, $areaAten) {
        $dql="SELECT aten.id,aten.nombre,tipoAten.id tipo
          FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
          JOIN atenAreaModEstab.idAreaModEstab areaModEstab
          JOIN areaModEstab.idModalidadEstab modEstab
          JOIN areaModEstab.idAreaAtencion areaAten
          JOIN atenAreaModEstab.idAtencion aten
          JOIN aten.idTipoAtencion tipoAten
          WHERE modEstab.idModalidad =:modalidad
                AND areaModEstab.idAreaAtencion =:areaAtencion
                AND aten.idAtencionPadre IS NULL
          ORDER BY tipoAten.id";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameters(array('modalidad' => $modalidad, 'areaAtencion' => $areaAten))
        ;

        return $consulta->getResult();
    }

    public function obtenerAtencionesHijasModalidad($modalidad, $areaAten, $idPadre) {

        $dql="SELECT aten.id,aten.nombre
        FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
        JOIN atenAreaModEstab.idAreaModEstab areaModEstab
        JOIN areaModEstab.idModalidadEstab modEstab
        JOIN areaModEstab.idAreaAtencion areaAten
        JOIN atenAreaModEstab.idAtencion aten
        WHERE modEstab.idModalidad =:modalidad
              AND areaModEstab.idAreaAtencion =:areaAtencion
              AND aten.idAtencionPadre = :idPadre";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameters(array('modalidad' => $modalidad, 'areaAtencion' => $areaAten, 'idPadre' => $idPadre));
        return $consulta->getResult();
    }

    /*
     * DESCRIPCIÓN:Obtener las atenciones asociadas a una area.
     *
     * ANALISTA PROGRAMADOR: KAREN ELVIRA PEÑATE
     */
    public function obtenerIdAtenAreaModEstab($idAreaModEstab) {
        $dql = "SELECT atenAreaModEstab
                  FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
                  JOIN atenAreaModEstab.idAreaModEstab idArea
                  JOIN atenAreaModEstab.idAtencion idAtencion
                  WHERE idArea.id=:idAreaModEstab
                  ORDER BY idAtencion.nombre ASC";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameters(array('idAreaModEstab' => $idAreaModEstab))
        ;

        return $consulta->getResult();
    }
}
