<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;

/**
 * MntExpedienteRepository
 *
 */
class MntExpedienteRepository extends EntityRepository {
    /*
     * Devuelve el ultimo valor de un expediente en un determinado establecimiento
     */

    public function obtenerExpedienteSugerido() {
        $formato = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e.tipoExpediente
                         FROM MinsalSiapsBundle:CtlEstablecimiento e
                         WHERE e.configurado=true'
                        )->getSingleResult();
        $conn = $this->getEntityManager()->getConnection();
        if ($formato['tipoExpediente'] == 'G') {
            $anio = date("y");
            $sql = "SELECT MAX(cast(split_part(numero,'-',1) as numeric))+1 as numero from mnt_expediente WHERE numero like '%-$anio'
            AND numero_temporal=false and cun=false";
            $query = $conn->query($sql);
            $query = $query->fetch();
            if (!is_null($query['numero']))
                return $query['numero'] . '-' . $anio;
            else
                return '1-' . $anio;
        } else {
            $sql = "SELECT MAX(cast(numero as numeric))+1 as numero from mnt_expediente WHERE numero_temporal=false and cun=false";
            $query = $conn->query($sql);
            $query = $query->fetch();
            if (!is_null($query['numero']))
                return $query['numero'];
            else
                return 1;
        }
    }

}

?>
