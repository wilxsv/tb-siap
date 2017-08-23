<?php

namespace Minsal\SeguimientoBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * SecHistorialClinicoRepository
 *
 */
class TarSolicitudFvihRepository extends EntityRepository {
    
    public function obtenerFactoresRiesgo($id) {
        $sql = "select codigo from tar_sol_factores sol inner join tar_factores_riesgo fac on sol.id_factores_riesgo=fac.id where id_solicitud_fvih=$id";
   
           $datos = $this->getEntityManager()->getConnection()->executeQuery($sql)->fetchAll();
   
           return $datos;
    }

}
