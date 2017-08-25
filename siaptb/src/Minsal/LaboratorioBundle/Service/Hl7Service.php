<?php
namespace Minsal\LaboratorioBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\LaboratorioBundle\Entity\LabControlInterface as ControlInterface;
use Minsal\LaboratorioBundle\Entity\LabControlInterfaceEnvio as ControlInterfaceEnvio;
use Minsal\LaboratorioBundle\Entity\LabResultados as LabResultados;


class Hl7Service {
    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function encodeHl7ObservationMsg($idSolicitud)
    {
        /*
         * definir a que equipos se enviaran solicitudes
         */
         $em = $this->container->get('doctrine')->getManager();
        //  $suministrantes_requeridos = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')
                                    //    ->findBy(array('idsolicitudestudio' => $idSolicitud, 'idSuministrante' => ! NULL, 'idSuministrante' => ! 1 ));

        $suministrantes_requeridos = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->findSuministrantesDelDetalleSolicitud($idSolicitud);
        //var_dump($suministrantes_requeridos);exit();
        foreach ($suministrantes_requeridos as $suministrante) {
            $idSuministrante = $suministrante->getId();

            $sql = "
            SELECT
                to_char(now(),'YYYYMMDDHHMI') 											AS fecha_hoy,
                (case when t8.id is not null then (t8.id) else  (t9.id) end) 							AS id_paciente,
                (case when t8.id is not null then (t6.numero) else (t7.numero) end) 						AS numero_expediente,
                t1.id_establecimiento_externo 											AS id_establecimiento_solicitante,
                (case when t8.id is not null then (t8.primer_apellido) else  (t9.primer_apellido) end) 				AS primer_apellido,
                coalesce((case when t8.id is not null then (t8.segundo_apellido) else  (t9.segundo_apellido) end),'') 		AS segundo_apellido,
                (case when t8.id is not null then (t8.primer_nombre) else (t9.primer_nombre) end) 				AS primer_nombre,
                (case when t8.id is not null then (t8.segundo_nombre) else (t9.segundo_nombre) end) 				AS segundo_nombre,
                (case when t8.id is not null then (coalesce(t8.tercer_nombre,'' )) else (coalesce(t9.tercer_nombre,'' )) end) 	AS tercer_nombre,
                (case when t8.id is not null then (t8.fecha_nacimiento) else  (t9.fecha_nacimiento) end) 			AS fecha_nacimiento,
                (case when t8.id is not null then (t8.id_sexo) else  (t9.id_sexo) end)						AS sexo,
                (case when t8.id is not null then (t6.id_establecimiento) else  (t7.id_establecimiento_origen) end) 		AS id_establecimiento_creo_expediente,
                t1.id_establecimiento_externo 											AS id_establecimiento_solicitante,
                t26.nombre 											          AS establecimiento_solicitante,
                t22.id_area_atencion 												AS id_servicio_hospitalario,
		(CASE WHEN t22.id_servicio_externo_estab IS NOT NULL THEN t29.abreviatura || '-' || t23.nombre
			ELSE t31.nombre || '-' || t23.nombre END) 								AS servicio_hospitalario,

                CASE WHEN t1.id_dato_referencia is null
			THEN t3.idsubservicio
			ELSE
			    t4.id_aten_area_mod_estab END AS id_subservicio_especialidad,
		t3.idsubservicio as id_especialidad,
                t21.nombre AS nombre_subservicio,
                '' 														AS id_tipo_paciente,
                t1.id 														AS id_solicitud,
                t2.id 														AS id_detalle_solicitud,
                t1.id 														AS numero_solicitud,
                t19.id 														AS correlativo_recepcion,
                t19.numeromuestra 												AS correlativo_interno_lab,
                t5.id 														AS id_medico_solicitante,
                t5.nombre 												AS medico_solicitante_nombre,
                t5.apellido 												AS medico_solicitante_apellido,
                to_char(t19.fechahorareg,'YYYYMMDDHHMI') 									AS fecha_recepcion,
                t1.id_establecimiento												AS id_establecimiento,
                t2.idtipomuestra 												AS id_tipo_muestra,
                t20.tipomuestra													AS tipo_muestra,
                t2.idorigenmuestra												AS id_origen_muestra,
                t24.origenmuestra												AS origen_muestra,
                to_char(t2.f_tomamuestra,'YYYYMMDDHHMI')										AS fecha_toma_muestra,
                t12.id_examen_servicio_diagnostico										AS id_prueba_estandar,
                t25.idestandar													AS codigo_prueba_estandar,
                t25.descripcion  													AS nombre_prueba_estandar,
    	        t11.id  													AS id_prueba,
    	        t11.nombre_examen  													AS nombre_prueba,
                REPLACE(to_char(t1.fecha_solicitud,'YYYYMMDDHHMI') || '-' || to_char(t19.numeromuestra,'0000'),' ','')		AS numero_solicitud,
                (case when t8.id is not null then (t8.id) else  (t9.id) end)							AS id_paciente,
                to_char(t1.fecha_solicitud,'YYYYMMDDHHMI') 								AS fecha_solicitud,
                T26.id_institucion												AS id_institucion_solicitante,
                T27.nombre													AS institucion_solicitante,
                t14.id AS id_suministrante
            FROM sec_solicitudestudios 			t1
                LEFT JOIN sec_detallesolicitudestudios 	t2 on (t1.id=t2.idsolicitudestudio)
                LEFT join sec_historial_clinico 	t3 on (t3.id = t1.id_historial_clinico)
                LEFT join mnt_dato_referencia 		t4 on (t4.id = t1.id_dato_referencia)
                LEFT JOIN mnt_empleado 			t5 on (t5.id = t3.id_empleado or t5.id=t4.id_empleado)
                LEFT join mnt_expediente 		t6 on (t6.id = t3.id_numero_expediente)
                LEFT join mnt_expediente_referido 	t7 on (t7.id = t4.id_expediente_referido)
                LEFT join mnt_paciente			t8 on (t8.id = t6.id_paciente)
                LEFT join mnt_paciente_referido		t9 on (t9.id = t7.id_referido)
                LEFT JOIN ctl_sexo			t10 on (t10.id=t8.id_sexo or t10.id=t9.id_sexo)
                LEFT JOIN lab_conf_examen_estab		t11 on (t11.id=t2.id_conf_examen_estab)
                LEFT JOIN mnt_area_examen_establecimiento	t12 on (t12.id=t11.idexamen)
                LEFT JOIN ctl_examen_servicio_diagnostico	t13 on (t13.id=t12.id_examen_servicio_diagnostico)
                LEFT JOIN lab_suministrante			t14 on (t14.id=t2.id_suministrante)
                LEFT JOIN lab_plantilla 			t15 on (t15.id=t11.idplantilla)
                LEFT JOIN sec_dato_embarazo		t16 on (t3.id=t16.id_historial_clinico)
                LEFT JOIN sec_signos_vitales		t17 on (t3.id=t17.id_historial_clinico)
                LEFT JOIN mnt_aten_area_mod_estab	t18 on (t18.id=t3.idsubservicio or t18.id = t4.id_aten_area_mod_estab)
                LEFT JOIN lab_recepcionmuestra		t19 ON t19.idsolicitudestudio = t1.id
                LEFT JOIN lab_tipomuestra		t20 ON t20.id = t2.idtipomuestra
                LEFT JOIN ctl_atencion			t21 ON (t21.id = t18.id_atencion)
                LEFT JOIN mnt_area_mod_estab		t22 ON t22.id = t18.id_area_mod_estab
                LEFT JOIN ctl_area_atencion		t23 ON t23.id = t22.id_area_atencion
                LEFT JOIN mnt_origenmuestra		t24 ON t24.id = t2.idorigenmuestra
                LEFT JOIN ctl_examen_servicio_diagnostico t25 ON t25.id = t12.id_examen_servicio_diagnostico
                LEFT JOIN ctl_establecimiento		t26 ON t26.id = t1.id_establecimiento_externo
                LEFT JOIN ctl_institucion		t27 ON t27.id = t26.id_institucion
                LEFT JOIN mnt_servicio_externo_establecimiento	t28 ON (t28.id = t22.id_servicio_externo_estab)
                LEFT JOIN mnt_servicio_externo 		t29 ON (t29.id = t28.id_servicio_externo)
		        LEFT JOIN mnt_modalidad_establecimiento t30 ON t30.id = t22.id_modalidad_estab
		        LEFT JOIN ctl_modalidad 		t31 ON t31.id = t30.id_modalidad
            WHERE
            t1.id = :idSolicitud AND t2.id_suministrante = :idSuministrante
            ";
            $stm = $this->container->get('database_connection')->prepare($sql); // se invoca a service
            $stm->bindValue(':idSolicitud', $idSolicitud); // enviar los parametros para la busqueda
            $stm->bindValue(':idSuministrante', $idSuministrante);
            $stm->execute();
            $result = $stm->fetchAll(); //se obtienen los registros y convierte en array

            //formar cadena hl7
            //controlar encabezado
            $encabezado = true;
            $i=1;
            $obr = $spm = "";
            foreach($result as $row) {
                var_dump('Entro'.$i);
                if($encabezado) {
                    $msh = "MSH|^~\\&|SIAP|MINSAL|".$suministrante->getAplicacion()."|".$suministrante->getSuministrante()."|".$row['fecha_hoy']."||OML^O21|1|D|2.5.1|||AL|AL|||||<CR>";
                    $pid = "PID|1||".$row['numero_expediente']."^^^".$row['id_establecimiento_creo_expediente'].
                        "||".$row['primer_apellido'].' '.$row['segundo_apellido']."^".$row['primer_nombre']."^".
                        $row['segundo_nombre'].' '.$row['tercer_nombre']."||".$row['fecha_nacimiento']."|".$row['sexo']."<CR>";
                    $pv1 = "PV1|1|".$row['id_servicio_hospitalario']."|<CR>";
                    $orc = "ORC|NW|".$row['id_solicitud']."||".$row['correlativo_interno_lab']."|||||".$row['fecha_solicitud'].
                        "|||".$row['id_medico_solicitante']."^".$row['medico_solicitante_apellido']."^".$row['medico_solicitante_nombre'].
                        "^|".$row['id_subservicio_especialidad']."^^^^^^^^".$row['nombre_subservicio']."||||".$row['id_institucion_solicitante'].
                        "^".$row['institucion_solicitante']."||||".$row['establecimiento_solicitante']."^^".$row['id_establecimiento_solicitante']."<CR>";
                    $encabezado = false;
                }

                $obr .= "OBR|".$i."|".$row['id_detalle_solicitud']."||".$row['id_prueba_estandar']."^".$row['nombre_prueba_estandar']."^^".
                    $row['codigo_prueba_estandar']."|||".$row['fecha_recepcion']."||||||||".$row['id_detalle_solicitud']."<CR>";

                $spm .= "SPM|".$i."|".$row['id_detalle_solicitud']."||".$row['id_tipo_muestra']."^".$row['tipo_muestra']."||||".$row['id_origen_muestra'].
                    "^".$row['origen_muestra']."^|||||||||".$row['fecha_toma_muestra']."^<CR>";
                $i++;
            }

            // verificar si la cadena se ha generado con dato
            if ($i > 1){
                $msg = $msh.$pid.$pv1.$orc.$obr.$spm; //devuelve la cadena formada
                /* guardar el HL7 generado*/
                $checksum_value = md5($msg);
                $em = $this->container->get('doctrine')->getManager();
                try {
                    $this->guardarBitacoraEnvioHl7String($msg, $idSolicitud, $idSuministrante);
                    $Solicitud = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->find($idSolicitud);
                    $Solicitud->setFechaMensajeCodificado(new \Datetime());

                    $em->persist($Solicitud); // actualizar fecha que se codifico la solicitud
                    $em->flush();

                } catch(\Exception $ex) {
                    return $ex->getTraceAsString();
                }
            } else { // la cadena no se genero
                $msg = ''; //devuelve la cadena vacia
            }
        } // fin del foreach
        return 'Cadena generadad: '.$msg;
    }

    public function guardarBitacoraReciboHl7String($Hl7string, $idSolicitud = 0, $idSuministrante = 0) {
        $em = $this->container->get('doctrine')->getManager();
        $checksum_value = md5($Hl7string);
        try {
            $ControlInterface = new ControlInterface();
            $ControlInterface->setFechaRecibio(new \DateTime());
            $ControlInterface->setMensaje($Hl7string);
            $ControlInterface->setChecksum($checksum_value);
            $ControlInterface->setVia(2);
            $ControlInterface->setTerminal(1);
            $ControlInterface->setEstandar(1);
            $ControlInterface->setAccion(1);
            $ControlInterface->setEstado(1);
            $ControlInterface->setIdSuministrante($idSuministrante);
            $ControlInterface->setIdSolicitudestudios($idSolicitud);

            $em->persist($ControlInterface);
            $em->flush();

        } catch(\Exception $ex) {
            return $ex->getTraceAsString();
        }
        return true;
    }


    public function guardarBitacoraEnvioHl7String($Hl7string, $idSolicitud = 0, $idSuministrante = 0) {
        $em = $this->container->get('doctrine')->getManager();
        $checksum_value = strlen($Hl7string);
        try {
            $ControlInterfaceEnvio = new ControlInterfaceEnvio();
            $ControlInterfaceEnvio->setFechaRecibio(new \DateTime());
            $ControlInterfaceEnvio->setMensaje($Hl7string);
            $ControlInterfaceEnvio->setChecksum($checksum_value);
            $ControlInterfaceEnvio->setVia(1);
            $ControlInterfaceEnvio->setTerminal(1);
            $ControlInterfaceEnvio->setEstandar(1);
            $ControlInterfaceEnvio->setAccion(1);
            $ControlInterfaceEnvio->setEstado(1);
            $ControlInterfaceEnvio->setIdSuministrante($idSuministrante);
            $ControlInterfaceEnvio->setIdSolicitudestudios($idSolicitud);

            $em->persist($ControlInterfaceEnvio);
            $em->flush();

        } catch(\Exception $ex) {
            return $ex->getTraceAsString();
        }
        return true;
    }

    /*
     * funcion para decodificar una cadena hl7 y devolver una json
     */
    public function decodeHl7ObservationMsg($Hl7string) {
        $em = $this->container->get('doctrine')->getManager();

        $cadena = $Hl7string;

        $cadena = str_replace('OBR', '<CR>OBR',$cadena);
        $cadena = str_replace('ORC', '<CR>ORC',$cadena);
        $cadena = str_replace('OBX', '<CR>OBX',$cadena);
        $msh = explode('<CR>', $cadena); //se obtinene el mensaje completo array segmento por fila
        $data_json = "";
        foreach ($msh as $segmento){
            if (substr($segmento,0, 3)=='MSH'){  //TITULO DEL MENSAJE
                //$data_json = $segmento;
                $campos_msh = explode('|', $segmento);
                $sending_app = $campos_msh[2];
                $receiving_app = $campos_msh[4];
                $message_type =$campos_msh[8];
            } // fin de MSH
            elseif (substr($segmento,0, 3)=='OBR'){
                $campos_obr = explode('|', $segmento);
                $numero_obr = $campos_obr[1];
                if ($numero_obr == '1'){ // EXAMEN SOLICITADO
                    $fecha_examen = $campos_obr[8];
                    $responsable = explode('^', $campos_obr[16]);
                    $idresponsable = $responsable[0];
                    $nombreresponsable = $responsable[1];
                    $prueba = explode('^',$campos_obr[4]);
                    $idprueba = $prueba[0];

                }
                elseif ($numero_obr == '2') { //EXAMEN REALIZADO POR LABORATORIO
                    $iddetallesolicitud = $campos_obr[2];
                }
                // else { // IDENTIFICACION DEL MICROORGANISMO AISLADO  OBR >= 3
                //     $microorganismo_antibiograma = explode('^',$campos_obr[26]);
                //     $campos_microorganismo_antibiograma = explode('&',$microorganismo_antibiograma[2]);
                //     $id_micoorganismo_antibiograma = $campos_microorganismo_antibiograma[0];
                // }
            }
            elseif (substr($segmento,0, 3)=='ORC') { // IDENTIFICACION DEL LA SOLICITUD
                $campos_orc = explode('|', $segmento);
                $idsolicitud = $campos_orc[2];
                //$data_json[] = $segmento;
            } elseif (substr($segmento,0, 3)=='OBX') {  // DETALLE DE LOS RESULTADOS
                $campos_obx = explode('|', $segmento);
                //$codigoMicroorganismo = null;
                if ($numero_obr == '1'){ // RESULTADO DEL EXAMEN Y RECUENTO DE COLONIAS
                    if ($campos_obx[1]=='1'){
                        $resultado = $campos_obx[5];
                    }
                    if ($campos_obx[1]=='2'){
                        $conteo_colonias = $campos_obx[5];
                    }
                } elseif ($numero_obr == '2'){ // CAPTURAR DATOS MICROORGANISMOS AISLADOS
                    $microorganismo = explode('^', $campos_obx[5]);
                    //$codigoMicroorganismo = $microorganismo[2];
                    if( !isset($lista_microorganismo[$microorganismo[0]]) ) { // CREACION DEL ARRAY MICROORGANISMOS
                        $lista_microorganismo[$microorganismo[0]] = array(
                            'id_microorganismo'    =>$microorganismo[0], // se devolvera por equipo //
                            'nombre_microorganismo'=>$microorganismo[1],
                            'codigo_microorganismo'=>$microorganismo[2],
                            'codigo_tarjeta'       =>$microorganismo[3]  // se devolvera por equipo //
                        );
                    }  // fin de Lista microorganismos
                } else {  // ANTIBIOGRAMA
                    $organismo = explode('^', $campos_obr[26]);
                    $nombre = explode('&', $organismo[2]);
                    $idMicroorganismo = $nombre[0];

                    if( !isset($lista_microorganismo[$idMicroorganismo]['lab_resultadoportarjeta']) ) {
                        $lista_microorganismo[$idMicroorganismo]['lab_resultadoportarjeta'] = array();
                    }
                    if( !isset( $lista_microorganismo[$idMicroorganismo]['lab_resultadoportarjeta'][$campos_obx[3]] ) ) {
                        $antibiotico = explode('^', $campos_obx[3]);
                        $lista_microorganismo[$idMicroorganismo]['lab_resultadoportarjeta'][$antibiotico[1]] = array(
                                'id_antibiotico'        => $antibiotico[0],  // lo enviara el equipo vitek //
                                'nombre_antibiotico'    => $antibiotico[1],
                                'codigo_antibiotico'    => $antibiotico[3],  // en caso que no venta el ID usar este codigo
                            'metodologia'           =>$campos_obx[4],
                            'unidad_medida'         =>$campos_obx[6],
                            'interpretacion'        => $campos_obx[8],
                            'resultado'             => $campos_obx[5]
                        );
                    }
                }
            }
        }  // FIN DEL FOR EACH

        $solicitud = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->find($idsolicitud);
        $detallesolicitud = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->find($iddetallesolicitud);
        $recepcionmuestra = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->find($iddetallesolicitud);

        $LabResultados = array(
            'iddetallesolicitud' => $iddetallesolicitud,//
            'resultado' => $resultado,
            'fecha_resultado' =>$fecha_examen,
            'codigo_empleado' =>$idresponsable,//
            'nombre_empleado' =>$nombreresponsable,
            'conteo_colonias' => $conteo_colonias,
            'lab_detalleresultado' => $lista_microorganismo
        );
        return  json_encode($LabResultados);
    }



    function run_in_background($Command, $Priority = 0)
    {
        if($Priority)
           $PID = shell_exec("nohup nice -n $Priority $Command 2> /dev/null & echo $!");
        else
           $PID = shell_exec("nohup $Command 2> /dev/null & echo $!");
        return($PID);
    }


    function is_process_running($PID)
    {
        exec("ps $PID", $ProcessState);
        return(count($ProcessState) >= 2);
    }


    public function testConexion($url = null) {
        $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $ch    = curl_init();

        if($url === null || $url === '') {
            return false;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $page = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode >= 200 && $httpcode < 400) {
            $status = true;
        } else {
            $status = false;
        }

        return $status;
    }
}
