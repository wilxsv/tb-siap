<?php

namespace Minsal\SeguimientoBundle\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\Metodos\Funciones;

/**
 * FrmGrupoFormularioRepository
 *
 */
class FrmGrupoFormularioRepository extends EntityRepository {
    /*
     * DESCRIPCIÓN: Método que se utiliza para hacer la consulta sql de la selección de 
     *              formularios. 
     * PARÁMETROS DE ENTRADA:
     *                  -idSexo: es el sexo del paciente.
     *                  -edad: edad del paciente.
     *                  -idAtencion: la especialidad con la que trabaja el médico.
     *                  -primeraVez: boolean que indica si es de primera vez o subsecuente.
     *                  -idCondicionPersona: la condición del paciente.
     * RETORNA:
     *                  -Objetos tipo FrmGrupoFormulario que sean coincidentes con las variables
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function obtenerFormulario($idSexo, $edad, $idAtencion, $primeraVez, $idCondicionPersona) {
        $conn = $this->getEntityManager()->getConnection();
        $sql_original = "SELECT A.*
              FROM frm_grupo_formulario A
              LEFT JOIN ctl_sexo B ON B.id=A.id_sexo
              LEFT JOIN ctl_atencion  C ON C.id=A.id_atencion
              LEFT JOIN ctl_rango_edad D ON D.id=A.id_rango_edad
              LEFT JOIN ctl_condicion_persona E ON E.id=A.id_condicion_persona
              INNER JOIN frm_formulario F ON (F.id=A.id_formulario AND F.activo=TRUE)
              WHERE A.activo=TRUE AND A.primera_vez = " . $primeraVez;
//              INNER JOIN frm_formulario F ON (F.id=A.id_formulario AND F.publicado=TRUE AND F.activo=TRUE)

        $restriccion = '';
        $order_by= ' ORDER BY F.id_tipo_formulario ASC, A.prioridad ASC';
        /* COMPARAR LA VARIABLE ATENCION */

        $sql = $sql_original . " AND A.id_atencion=$idAtencion";
        $query = $conn->query($sql);
        $query = $query->fetchAll();

        if (!($query)) {
            $restriccion.=" AND A.id_atencion IS NULL";
        } else {
            $restriccion.=" AND A.id_atencion=$idAtencion";
        }

        /* COMPARAR LA VARIABLE SEXO */
        $sql = $sql_original . $restriccion . " AND A.id_sexo=$idSexo";
        $query = $conn->query($sql);
        $query = $query->fetchAll();

        if (!($query)) {
            $restriccion.=" AND A.id_sexo IS NULL";
        } else {
            $restriccion.=" AND A.id_sexo=$idSexo";
        }

        /* COMPARAR LA VARIABLE CONDICION DE LA PERSONA */
        $sql = $sql_original . $restriccion . " AND A.id_condicion_persona=$idCondicionPersona";
        $query = $conn->query($sql);
        $query = $query->fetchAll();

        if (!($query)) {
            $restriccion.=" AND A.id_condicion_persona IS NULL";
        } else {
            if ($idCondicionPersona == 4)
                $restriccion.=" AND A.id_condicion_persona IS NULL";
            else
                $restriccion.=" AND A.id_condicion_persona=$idCondicionPersona";
        }

        /* COMPARAR LA VARIABLE RANGO EDAD */
       $funciones=new Funciones();
       $resultado=$funciones->calcularAniosMesesDiasEdad($edad);
       $anios=$resultado['anios'];
       $meses=$resultado['meses'];
       $dias=$resultado['dias'];

        $sql = "SELECT id 
               FROM ctl_rango_edad 
               WHERE fn_convertir_anio_a_dias($anios,$meses,$dias) 
               BETWEEN fn_convertir_anio_a_dias(edad_minima_anios,edad_minima_meses,edad_minima_dias) 
                      AND  fn_convertir_anio_a_dias(edad_maxima_anios,edad_maxima_meses,edad_maxima_dias)
                      AND cod_modulo = 'SEC'";
        $query_edad = $conn->query($sql);
        $query_edad = $query_edad->fetchAll();

        if (!($query_edad)) {
            $restriccion.=" AND A.id_rango_edad IS NULL";
        } else {
            $sql = $sql_original . $restriccion . " AND A.id_rango_edad=" . $query_edad[0]['id'];
            $query = $conn->query($sql);
            $query = $query->fetchAll();
            if (!($query)) {
                $restriccion.=" AND A.id_rango_edad IS NULL";
            } else {
                $restriccion.=" AND A.id_rango_edad = " . $query_edad[0]['id'];
            }
        }

        $sql = $sql_original . $restriccion.$order_by;
        $query = $conn->query($sql);
        $query = $query->fetchAll();


        if (!($query)) {
            $sql = $sql_original." AND A.id_atencion IS NULL AND A.id_sexo IS NULL AND A.id_condicion_persona IS NULL AND A.id_rango_edad IS NULL".$order_by;
            $query = $conn->query($sql);
            $query = $query->fetchAll();
        }
        //var_dump($sql);
        return $query;
    }

}
