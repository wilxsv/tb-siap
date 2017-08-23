<?php

namespace Minsal\SeguimientoBundle\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\SeguimientoBundle\Entity\SecAntecedentes;
use Doctrine\DBAL as DBAL;

/**
 * SecAntecedentesRepository
 *
 */
class SecAntecedentesRepository extends EntityRepository {

    public function getIdPorEspecialidad($paciente, $espe) {
        $sql = "SELECT sec.id 
                 FROM sec_antecedentes sec 
                 INNER JOIN sec_antecedentes_especialidad_form esp ON sec.id=esp.id_antecedentes 
                 WHERE id_paciente='$paciente' AND id_aten_area_mod_estab='$espe' 
                 ORDER BY sec.id DESC LIMIT 1";

        $datos = $this->getEntityManager()->getConnection()
                ->executeQuery($sql)
                ->fetchColumn(0);

        return $datos;
    }
    
    public function getIdPorPaciente($paciente) {
        $sql = "SELECT sec.id 
                 FROM sec_antecedentes sec  
                 WHERE id_paciente='$paciente'  
                 ORDER BY sec.id DESC LIMIT 1";

        $datos = $this->getEntityManager()->getConnection()
                ->executeQuery($sql)
                ->fetchColumn(0);

        return $datos;
    }

    public function getUltimaActualizacion($paciente, $especialidad) {
        $dql="SELECT B,DATE_DIFF(CURRENT_DATE,A.fecha) diferencia
                  FROM MinsalSeguimientoBundle:SecAntecedentesEspecialidadForm A
                  JOIN MinsalSeguimientoBundle:SecAntecedentes B WITH (A.idAntecedentes = B.id)
                  JOIN A.idPaciente C
                  JOIN A.idAtenAreaModEstab D
                  WHERE C.id=$paciente AND D.id=$especialidad 
                  ORDER BY A.fecha DESC LIMIT 1
                  ";
        $consulta = $this->getEntityManager()
                ->createQuery($dql);

        return $consulta->getResult();
       
    }

}
