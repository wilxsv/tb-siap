<?php

//src/Minsal/LaboratorioBundle/Controller/SecSolicitudestudiosController.php

namespace Minsal\LaboratorioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Model\User;
use Doctrine\DBAL\Types\Type;
use Minsal\Metodos\Funciones;

class SecSolicitudestudiosController extends Controller {

	/**
     * @Route("/laboratorio/examen/get", name="getsecsollabexamen", options={"expose"=true})
     * @Method("GET")
     */
    public function getExamenLaboratorioAction() {
    	$em                 = $this->getDoctrine()->getManager();
        $request            = $this->getRequest();
        $idSexo             = $request->get('idSexo');
        $idHistorialClinico = $request->get('idHistorialClinico');
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
		$idEstablecimiento  = $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : $CtlEstablecimiento->getId();
		$local				= $CtlEstablecimiento->getId() === intval($idEstablecimiento) ? true : false;
        $result             = array();

        /*****************************************************************************************
         * SQL que obtiene los examenes por area, disponibles para ser asignados en la consulta
         * medica (seguimiento clinico)
         ****************************************************************************************/
        $sql = "SELECT t01.id AS id_area,
                       t01.idarea AS codigo_area,
        			   t01.nombrearea AS nombre_area,
        			   t03.id AS id_examen,
        			   t03.codigo_examen,
        			   t03.nombre_examen,
                       CASE t03.urgente WHEN 0
                            THEN 'false'
                            ELSE 'true'
                       END AS urgente,
        			   t02.id_examen_servicio_diagnostico AS id_estandard,
        			   CASE WHEN t03.id IN (
                            SELECT ti02.id_conf_examen_estab
        					FROM sec_solicitudestudios ti01
        					INNER JOIN sec_detallesolicitudestudios ti02 ON (ti01.id = ti02.idsolicitudestudio)
        					WHERE
                                CASE WHEN :local = TRUE
                                    THEN ti01.id_historial_clinico = :idHistorialClinico
                                    ELSE ti01.id_dato_referencia = :idHistorialClinico
                                END
                                AND ti01.estado != 6
        				)
                            THEN false
                            ELSE true
        			   END AS disponible,
                       t04.id_atencion AS id_programa,
                       (
                           SELECT array_to_json( array_agg( COALESCE(id_perfil, 0) ) )
                           FROM lab_perfil_prueba
                           WHERE t03.id = id_conf_examen_estab
                                AND habilitado = TRUE
                                AND id_establecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado = true)
                       ) AS id_perfil
    			FROM ctl_area_servicio_diagnostico 		   t01
    			INNER JOIN mnt_area_examen_establecimiento t02 ON (t01.id = t02.id_area_servicio_diagnostico)
    			INNER JOIN lab_conf_examen_estab 		   t03 ON (t02.id = t03.idexamen)
                LEFT  JOIN mnt_formulariosxestablecimiento t04 ON (t04.id = t03.idformulario)
    			WHERE t02.id_establecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado = true)
    				AND t02.activo = true
    				AND t01.administrativa = 'N'
    				AND t03.condicion = 'H'
    				AND (t03.idsexo IS NULL OR t03.idsexo = :idSexo)
    				AND t03.ubicacion = 0
                ORDER BY t01.nombrearea, t03.nombre_examen";

		$stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idSexo', $idSexo);
        $stm->bindValue(':local', var_export($local, true));
        $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
        $stm->execute();
        $arr = $stm->fetchAll();

        foreach ($arr as $row) {
			$id = $row['nombre_area'];

			if( ! isset( $result[$id] ) ){
				$result[$id] = array();
				$result[$id]['id'] 	   = $row['id_area'];
				$result[$id]['codigo'] = $row['codigo_area'];
				$result[$id]['nombre'] = $row['nombre_area'];
			}

			if( ! isset($result[$id]['examenes']) )
				$result[$id]['examenes'] = array();

			$result[$id]['examenes'] = $this->addExamToArea( $result[$id]['examenes'], array($row['id_examen'], $row['codigo_examen'], $row['nombre_examen'], $row['urgente'], $row['disponible'], $row['id_programa'], $row['id_perfil']) );
		}

        $sesollab['data'] = $result;
        return new Response(json_encode($sesollab));
    }

	function addExamToArea($exams, $newExam){
		if( ! isset($exams[ $newExam[2] ]) ){
			$exams[ $newExam[2] ] = array('id'	   	    => $newExam[0],
										  'codigo'      => $newExam[1],
										  'nombre'      => $newExam[2],
										  'urgente'     => $newExam[3],
										  'disponible'  => $newExam[4],
										  'id_programa' => $newExam[5],
                                          'id_perfil'   => $newExam[6]
										 );
		}

		return $exams;
	}

	/**
     * @Route("/laboratorio/tipomuestra/examen/get", name="gettipomuestraexam", options={"expose"=true})
     * @Method("GET")
     */
    public function getTipoMuestraExamenAction() {
    	$em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idExamen = $request->get('idExamen');

        /*****************************************************************************************
         * SQL que obtiene los tipos de muestra segun examen y area
         ****************************************************************************************/

        $sql = "SELECT t01.id AS id_muestra,
        			   t01.tipomuestra AS nombre_muestra
        		FROM lab_tipomuestra 				t01
        		INNER JOIN lab_tipomuestraporexamen t02 ON (t01.id = t02.idtipomuestra)
        		WHERE t02.idexamen = :idExamen
                    AND t02.habilitado = true
        		ORDER BY t01.tipomuestra";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExamen', $idExamen);
        $stm->execute();
        $result = $stm->fetchAll();

        $sesollab['data'] = $result;
        return new Response(json_encode($sesollab));
    }

    /**
     * @Route("/laboratorio/origenmuestra/examen/get", name="getorigenmuestraexam", options={"expose"=true})
     * @Method("GET")
     */
    public function getOrigenMuestraExamenAction() {
    	$em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idMuestra = $request->get('idMuestra');

        /*****************************************************************************************
         * SQL que obtiene los tipos de muestra segun examen y area
         ****************************************************************************************/

        $sql = "SELECT t01.id AS id_origen,
        			   t01.origenmuestra AS nombre_origen
        		FROM mnt_origenmuestra t01
        		WHERE t01.idtipomuestra = :idMuestra
        		ORDER BY t01.origenmuestra";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idMuestra', $idMuestra);
        $stm->execute();
        $result = $stm->fetchAll();

        $sesollab['data'] = $result;
        return new Response(json_encode($sesollab));
    }

    /**
     * @Route("/laboratorio/perfiles/get", name="get_laboratorio_perfiles", options={"expose"=true})
     * @Method("GET")
     */
    public function getPerfilesLaboratorioAction() {
    	$em                 = $this->getDoctrine()->getManager();
        $request            = $this->getRequest();
        $idSexo             = $request->get('idSexo');
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $result             = array();

        /*****************************************************************************************
         * SQL que obtiene los examenes por area, disponibles para ser asignados en la consulta
         * medica (seguimiento clinico)
         ****************************************************************************************/
        $sql = "SELECT t01.id,
                       t01.nombre
    			FROM lab_perfil            t01
    			INNER JOIN lab_perfil_sexo t02 ON (t01.id = t02.id_perfil)
    			WHERE (t02.id_sexo = :idSexo OR t02.id_sexo IS NULL)
                    AND t02.id_establecimiento = :idEstablecimiento
    				AND t02.habilitado = true
                ORDER BY t01.nombre";

		$stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idSexo', $idSexo);
        $stm->bindValue(':idEstablecimiento', $CtlEstablecimiento->getId());
        $stm->execute();
        $result = $stm->fetchAll();

        return new Response(json_encode($result));
    }

    /**
     * @Route("/get_paciente", name="get_paciente", options={"expose"=true})
     * @Method("GET")
     */
    public function getPaciente() {
        $calcular    = new Funciones();
        $em          = $this->getDoctrine()->getManager();
        $conn        = $em->getConnection();
        $request     = $this->getRequest();
        $result      = array();

        /* capturar variables enviadas por GET */
        $idestablecimiento          = $request->get('idestablecimiento');
        $expediente                 = $request->get('expediente');
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

		/* evalua si el expediente es del mismo establecimiento */
		$local = intval($idestablecimiento) === $CtlEstablecimiento->getId() ? true : false;
        if( $local ) {
            $expediente = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array('idEstablecimiento'=>$idestablecimiento, 'numero'=>$expediente));
			$mensaje 	= 'Paciente no encontrado, favor ingresarlo en el área de Archivo...';
        } else { //busca el expediente en otro establecimiento
            $expediente = $em->getRepository('MinsalLaboratorioBundle:MntExpedienteReferido')->findOneBy(array('idEstablecimientoOrigen'=>$idestablecimiento, 'numero'=>$expediente));
			$mensaje 	= 'Paciente no encontrado...';
        }

        if($expediente) { // si encontro expediente, buscar paciente para obtener las variables a desplegar
            $paciente    = $local ? $expediente->getIdPaciente() : $expediente->getIdReferido();
            $nombres     = $paciente->getNombrePaciente();
            $sexo        = $paciente->getIdSexo()->getNombre();
            $edad        = $calcular->calcularEdad($conn, $paciente->getFechaNacimiento()->format('d-m-Y'), method_exists($paciente, 'getHoraNacimiento') ? ( $paciente->getHoraNacimiento() ? $paciente->getHoraNacimiento()->format('H:i') : null ) : null );
            $conocidopor = method_exists($paciente, 'getConocidoPor')  ? $paciente->getConocidoPor() : ''; //validar que la variable conocido por no sea nula

            $result = array(
				'id_numero_expediente'	=> $expediente->getId(),
                'nombres'       		=> $nombres,
                'sexo'          		=> $sexo,
                'edad'          		=> $edad,
                'conocidopor'   		=> $conocidopor,
				'mensaje'				=> ''
            );
		}

        return new Response(json_encode($result));
    }

	/**
     * @Route("/sexo/get", name="get_sexo", options={"expose"=true})
     * @Method("GET")
     */
    public function getSexoAction() {
    	$em = $this->getDoctrine()->getManager();

        $sql = "SELECT id, nombre FROM ctl_sexo";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return new Response(json_encode($result));
    }

	/**
	 * @Route("/get_cie_10", name="get_cie_10", options={"expose"=true})
	 * @Method("GET")
	 */
	public function getCie10Action() {
		$em = $this->getDoctrine()->getManager();

		$sql = "SELECT id, diagnostico || ', ' || codigo as nombre FROM mnt_cie10 WHERE id<100 ORDER BY diagnostico";

		$stm = $this->container->get('database_connection')->prepare($sql);
		$stm->execute();
		$result = $stm->fetchAll();

		return new Response(json_encode($result));
	}

	/**
	 * @Route("/get_procedencia", name="get_procedencia", options={"expose"=true})
	 * @Method("GET")
	 */
	public function get_procedenciaAction() {
		$em = $this->getDoctrine()->getManager();
		/* capturar variables enviadas por GET */
		$CtlEstablecimiento	= $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
		$idestablecimiento	= $CtlEstablecimiento->getId();


		$sql = "
		SELECT mnt_area_mod_estab.id as id,
               CASE WHEN id_servicio_externo_estab IS NOT NULL
                       THEN mnt_servicio_externo.abreviatura ||'--'  || ctl_area_atencion.nombre
                       ELSE       ctl_modalidad.nombre ||'--' || ctl_area_atencion.nombre
                       END as nombre
               FROM mnt_area_mod_estab
               INNER JOIN  ctl_area_atencion  on  ctl_area_atencion.id = mnt_area_mod_estab.id_area_atencion
               INNER JOIN  mnt_modalidad_establecimiento ON mnt_modalidad_establecimiento.id=mnt_area_mod_estab.id_modalidad_estab
               INNER JOIN ctl_modalidad ON ctl_modalidad.id = mnt_modalidad_establecimiento.id_modalidad
               LEFT JOIN mnt_servicio_externo_establecimiento ON (mnt_servicio_externo_establecimiento.id = mnt_area_mod_estab.id_servicio_externo_estab)
               LEFT JOIN mnt_servicio_externo ON (mnt_servicio_externo.id = mnt_servicio_externo_establecimiento.id_servicio_externo)
               WHERE mnt_area_mod_estab.id_establecimiento=$idestablecimiento
               ORDER by mnt_area_mod_estab.id,ctl_modalidad.nombre,ctl_area_atencion.nombre
		";

		$stm = $this->container->get('database_connection')->prepare($sql);
		$stm->execute();
		$result = $stm->fetchAll();

		return new Response(json_encode($result));
	}

		/**
		 * @Route("/get_subservicio", name="get_subservicio", options={"expose"=true})
		 * @Method("GET")
		 */
		public function get_subservicioAction() {
			$em 		= $this->getDoctrine()->getManager();

			$em = $this->getDoctrine()->getManager();
			/* obtener establecimiento por defecto */
			$CtlEstablecimiento	= $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
			$idestablecimiento	= $CtlEstablecimiento->getId();

			/* capturar variables enviadas por GET */
			$request	    = $this->getRequest();
	        $id_procedencia =  $request->get('id_procedencia');


			$sql = "
			with tbl_servicio as (select mnt_3.id,
					  CASE
					  WHEN mnt_3.nombre_ambiente IS NOT NULL
					  THEN
							  CASE WHEN id_servicio_externo_estab IS NOT NULL
									  THEN mnt_ser.abreviatura ||'-->' ||mnt_3.nombre_ambiente
									  ELSE mnt_3.nombre_ambiente
							  END

					  ELSE
					  CASE WHEN id_servicio_externo_estab IS NOT NULL
							  THEN mnt_ser.abreviatura ||'--> ' || cat.nombre
						   WHEN not exists (select nombre_ambiente from mnt_aten_area_mod_estab where nombre_ambiente=cat.nombre)
							  THEN cmo.nombre||'-'||cat.nombre
					  END
					  END AS nombre
					  from ctl_atencion cat
					  join mnt_aten_area_mod_estab mnt_3 on (cat.id=mnt_3.id_atencion)
					  join mnt_area_mod_estab mnt_2 on (mnt_3.id_area_mod_estab=mnt_2.id)
					  JOIN ctl_area_atencion a ON (mnt_2.id_area_atencion=a.id AND a.id_tipo_atencion=1)
					  LEFT JOIN mnt_servicio_externo_establecimiento msee on mnt_2.id_servicio_externo_estab = msee.id
					  LEFT JOIN mnt_servicio_externo mnt_ser on msee.id_servicio_externo = mnt_ser.id
					  join mnt_modalidad_establecimiento mme on (mme.id=mnt_2.id_modalidad_estab)
					  join ctl_modalidad cmo on (cmo.id=mme.id_modalidad)
					  where  mnt_2.id=$id_procedencia
					  and mnt_3.id_establecimiento=$idestablecimiento
					  order by 2)
					  select id, nombre from tbl_servicio where nombre is not null;
			";

			$stm = $this->container->get('database_connection')->prepare($sql);
			$stm->execute();
			$result = $stm->fetchAll();

			return new Response(json_encode($result));
		}


		/**
		 * @Route("/get_medico", name="get_medico", options={"expose"=true})
		 * @Method("GET")
		 */
		public function get_medicoAction() {
			$em 		= $this->getDoctrine()->getManager();

			/* capturar variables enviadas por GET */
			$request	    = $this->getRequest();
	        $id_subservicio =  $request->get('id_subservicio');


			$sql = "
				select mem.id as id, nombreempleado as nombre, idempleado
					 from mnt_empleado_especialidad_estab empest
					 join mnt_empleado mem on (empest.id_empleado=mem.id)
					 where id_aten_area_mod_estab=$id_subservicio
			";

			$stm = $this->container->get('database_connection')->prepare($sql);
			$stm->execute();
			$result = $stm->fetchAll();

			return new Response(json_encode($result));
		}

}
