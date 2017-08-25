<?php
namespace Minsal\LaboratorioBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ExamnResultService
{

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getExamnResult($idHistorialClinico, $idDatoReferencia, $idEstablecimiento) {
        $em = $this->container->get('doctrine')->getManager();

        $resultados = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerResultadoSolicitudExamen($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);

        $result['RC'] =array();
        $result['RM'] =array();

        foreach ($resultados as $row) {
            if($row['codigo_estado_detalle'] === 'RM') {
                $newExam = array(
                        $row['id_examen'],
                        $row['codigo_examen'],
                        $row['nombre_examen']
                    );

                $result['RM'] = $this->addExamnToLayout($result['RM'], $newExam, $row, $row['codigo_plantilla']);
            } else {
    			$id = $row['nombre_area'];

    			if( ! isset( $result['RC'][$id] ) ){
    				$result['RC'][$id] = array();
    				$result['RC'][$id]['id'] 	 = $row['id_area'];
    				$result['RC'][$id]['codigo'] = $row['codigo_area'];
    				$result['RC'][$id]['nombre'] = $row['nombre_area'];
    			}

    			if( ! isset($result['RC'][$id]['plantillas']) ){
    				$result['RC'][$id]['plantillas'] = array();
                }

                $newPlantilla = array(
                        $row['id_plantilla'],
                        $row['codigo_plantilla'],
                        $row['nombre_plantilla']
                    );

    			$result['RC'][$id]['plantillas'] = $this->addLayoutToArea( $result['RC'][$id]['plantillas'], $newPlantilla, $row );
            }
		}

        return $result;
    }

    public function getDatosGenerales($idHistorialClinico, $idDatoReferencia, $idEstablecimiento) {
        $em = $this->container->get('doctrine')->getManager();
        $datosGenerales = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerDatosGenerales($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);

        return count($datosGenerales) > 0 ? $datosGenerales[0] : null;
    }

    private function addLayoutToArea($plantillas, $newPlantilla, $row) {
		if( ! isset($plantillas[ $newPlantilla[1] ]) ){
			$plantillas[ $newPlantilla[1] ] = array(
                                        'id'     => $newPlantilla[0],
										'codigo' => $newPlantilla[1],
										'nombre' => $newPlantilla[2]
									);
		}

        if( ! isset($plantillas[ $newPlantilla[1] ]['examenes']) ){
			$plantillas[ $newPlantilla[1] ]['examenes'] = array();
		}

        $newExam = array(
                $row['id_examen'],
                $row['codigo_examen'],
                $row['nombre_examen']
            );

        $plantillas[ $newPlantilla[1] ]['examenes'] = $this->addExamnToLayout($plantillas[ $newPlantilla[1] ]['examenes'], $newExam, $row, $newPlantilla[1]);

		return $plantillas;
	}

    public function getExamenSolicitudPorArea($idHistorialClinico, $idDatoReferencia, $idEstablecimiento) {
        $em         = $this->container->get('doctrine')->getManager();
        $resultados = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);
        $result     = array();

        foreach ($resultados as $row) {
            $id = $row['nombrearea'];

            if( ! isset( $result[$id] ) ){
                $result[$id]           = array();
                $result[$id]['id'] 	   = $row['idarea'];
                $result[$id]['codigo'] = $row['codigoarea'];
                $result[$id]['nombre'] = $row['nombrearea'];
            }

            if( ! isset( $result[$id]['examenes'] ) ){
    			$result[$id]['examenes'] = array();
    		}

            $newExam = array(
                    $row['idexamen'],
                    $row['codigoexamen'],
                    $row['nombreexamen'],
                    $row['idtipomuestra'],
                    $row['nombremuestra'],
                    $row['idorigenmuestra'],
                    $row['nombreorigenmuestra'],
                    $row['indicacion'],
                    $row['urgente'],
                    $row['idprograma'],
                    $row['idestadodetalle'],
                    $row['codigoestadodetalle'],
                    $row['idplantilla'],
                    $row['idtiposolicitud']
                );

            $result[$id]['examenes'] = $this->addExamnToArea($result[$id]['examenes'], $newExam, $row);
        }

        return $result;
    }

    private function addExamnToArea($exams, $newExam, $row) {
        if( ! isset($exams[ $newExam[2] ]) ){
			$exams[ $newExam[2] ] = array(
                                        'id'                  => $newExam[0],
										'codigo'              => $newExam[1],
										'nombre'              => $newExam[2],
                                        'idTipoMuestra'       => $newExam[3],
										'nombreMuestra'       => $newExam[4],
										'idOrigenMuestra'     => $newExam[5],
                                        'nombreOrigenMuestra' => $newExam[6],
										'indicacion'          => $newExam[7],
										'urgente'             => $newExam[8],
                                        'idPrograma'          => $newExam[9],
										'idEstadoDetalle'     => $newExam[10],
										'codigoEstadoDetalle' => $newExam[11],
										'idPlantilla'         => $newExam[12],
										'idTipoSolicitud'     => $newExam[13]
									);
		}

        return $exams;
    }

    private function addExamnToLayout($exams, $newExam, $row, $tipoPlantilla) {
        if( ! isset($exams[ $newExam[2] ]) ){
			$exams[ $newExam[2] ] = array(
                                        'id'     => $newExam[0],
										'codigo' => $newExam[1],
										'nombre' => $newExam[2],
                                        'id_estado_detalle'     => $row['id_estado_detalle'],
                                        'codigo_estado_detalle' => $row['codigo_estado_detalle'],
                                        'nombre_estado_detalle' => $row['nombre_estado_detalle'],
                                        'fecha_toma_muestra'    => $row['fecha_toma_muestra']
									);
		}

        if( ! isset($exams[ $newExam[2] ]['resultadoFinal']) ){
            $exams[ $newExam[2] ]['resultadoFinal'] = array();
        }

        switch ($row['codigo_estado_detalle']) {
            case 'RM':
                $exams[ $newExam[2] ]['id_estado_rechazo']          = $row['id_estado_rechazo'];
                $exams[ $newExam[2] ]['nombre_estado_rechazo']      = $row['nombre_estado_rechazo'];
                $exams[ $newExam[2] ]['id_observacion_rechazo']     = $row['id_observacion_rechazo'];
                $exams[ $newExam[2] ]['nombre_observacion_rechazo'] = $row['nombre_observacion_rechazo'];
                break;
            case 'RC':
    			$exams[ $newExam[2] ]['resultadoFinal'] = array(
                                            'id_empleado'           => $row['id_empleado'],
                                            'nombre_empleado'       => $row['nombre_empleado'],
                                            'fecha_resultado'       => $row['fecha_resultado'],
                                            'urgente'               => $row['urgente']
                                        );
                break;

            default:
                # code...
                break;
        }

        switch ($tipoPlantilla) {
            case 'A':
                if($row['codigo_estado_detalle'] === 'RC') {
                    $exams[ $newExam[2] ]['resultadoFinal']['id_resultado']             = $row['id_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['resultado']                = $row['resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['id_posible_resultado']     = $row['id_posible_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['nombre_posible_resultado'] = $row['nombre_posible_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['lectura']                  = $row['lectura'];
                    $exams[ $newExam[2] ]['resultadoFinal']['interpretacion']           = $row['interpretacion'];
                    $exams[ $newExam[2] ]['resultadoFinal']['observacion']              = $row['resultado_observacion'];
                    $exams[ $newExam[2] ]['resultadoFinal']['unidad']                   = $row['unidades'];
                    $exams[ $newExam[2] ]['resultadoFinal']['rango_inicio']             = $row['rango_inicio'];
                    $exams[ $newExam[2] ]['resultadoFinal']['rango_fin']                = $row['rango_fin'];
                }
                break;
            case 'B':
                if( ! isset($exams[ $newExam[2] ]['elementos']) ){
        			$exams[ $newExam[2] ]['elementos'] = array();
        		}

                if($row['codigo_estado_detalle'] === 'RC') {
                    $newElement = array(
                        $row['id_elemento'],
                        $row['nombre_elemento'],
                        $row['resultado_elemento'],
                        $row['id_posible_resultado_elemento'],
                        $row['nombre_posible_resultado_elemento'],
                        $row['unidad_elemento'],
                        $row['control_normal_elemento']
                    );

                    $exams[ $newExam[2] ]['elementos'] = $this->addElementToExam($exams[ $newExam[2] ]['elementos'], $newElement, $row);
                }
                break;
            case 'C':
                if( ! isset($exams[ $newExam[2] ]['bacterias']) ){
        			$exams[ $newExam[2] ]['bacterias'] = array();
        		}

                if($row['codigo_estado_detalle'] === 'RC') {
                    $exams[ $newExam[2] ]['resultadoFinal']['id_resultado']             = $row['id_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['resultado']                = $row['resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['id_posible_resultado']     = $row['id_posible_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['nombre_posible_resultado'] = $row['nombre_posible_resultado'];
                    $exams[ $newExam[2] ]['resultadoFinal']['id_observacion']           = $row['id_observacion_bacteria'];
                    $exams[ $newExam[2] ]['resultadoFinal']['nombre_observacion']       = $row['nombre_observacion_bacteria'];
                    $exams[ $newExam[2] ]['resultadoFinal']['codigo_observacion']       = $row['codigo_observacion_bacteria'];

                    if($row['id_observacion_bacteria'] === null) {
                        $newBacter = array(
                            $row['id_bacteria'],
                            $row['nombre_bacteria'],
                            $row['id_resultado'],
                            $row['resultado'],
                            $row['id_posible_resultado'],
                            $row['nombre_posible_resultado'],
                            $row['cantidad_bacterias']
                        );

                        $exams[ $newExam[2] ]['bacterias'] = $this->addBacterToExamn($exams[ $newExam[2] ]['bacterias'], $newBacter, $row);
                    }
                }
                break;
            /*case 'D':
                if( ! isset($exams[ $newExam[2] ]['elementos']) ){
        			$exams[ $newExam[2] ]['elementos'] = array();
        		}

                if($row['codigo_estado_detalle'] === 'RC') {
                    $newElement = array(
                        $row['id_elemento_tincion'],
                        $row['nombre_elemento_tincion'],
                        $row['nombre_cantidad_tincion'],
                        $row['id_cantidad_tincion']
                    );

                    $exams[ $newExam[2] ]['elementos'] = $this->addTincionElementToExam($exams[ $newExam[2] ]['elementos'], $newElement);
                }
                break;*/
            default:
                if( ! isset($exams[ $newExam[2] ]['procedimientos']) ){
        			$exams[ $newExam[2] ]['procedimientos'] = array();
        		}

                if($row['codigo_estado_detalle'] === 'RC') {
                    $exams[ $newExam[2] ]['resultadoFinal']['observacion'] = $row['resultado_observacion'];

                    $newProcedure = array(
                        $row['id_procedimiento'],
                        $row['nombre_procedimiento'],
                        $row['unidad_procedimiento'],
                        $row['rango_inicio_procedimiento'],
                        $row['rango_fin_procedimiento'],
                        $row['resultado_procedimiento'],
                        $row['id_posible_resultado_procedimiento'],
                        $row['nombre_posible_resultado_procedimiento'],
                        $row['control_diario_procedimiento']
                    );

                    $exams[ $newExam[2] ]['procedimientos'] = $this->addProcedureToExam($exams[ $newExam[2] ]['procedimientos'], $newProcedure);
                }
                break;
        }

        /*Falta Logica para Resultados de la Metodologia*/
        return $exams;
    }

    private function addElementToExam($elements, $newElement, $row) {
        if( ! isset($elements[ $newElement[1] ]) ){
			$elements[ $newElement[1] ] = array(
                                        'id'                       => $newElement[0],
										'nombre'                   => $newElement[1],
                                        'resultado'                => $newElement[2],
                                        'id_posible_resultado'     => $newElement[3],
                                        'nombre_posible_resultado' => $newElement[4],
                                        'unidad'                   => $newElement[5],
                                        'control_normal'           => $newElement[6]
									);
		}

        if( ! isset($elements[ $newElement[1] ]['subelementos']) ){
            $elements[ $newElement[1] ]['subelementos'] = array();
        }

        $newSubelement = array(
            $row['id_subelemento'],
            $row['nombre_subelemento'],
            $row['resultado_subelemento'],
            $row['id_posible_resultado_subelemento'],
            $row['nombre_posible_resultado_subelemento'],
            $row['unidad_subelemento'],
            $row['rango_inicio_subelemento'],
            $row['rango_fin_subelemento'],
            $row['control_normal_subelemento']
        );

        $elements[ $newElement[1] ]['subelementos'] = $this->addSubElementToElement($elements[ $newElement[1] ]['subelementos'], $newSubelement);

        return $elements;
    }

    private function addSubElementToElement($subelements, $newSubelement) {
        if( ! isset($subelements[ $newSubelement[1] ]) ){
			$subelements[ $newSubelement[1] ] = array(
                                        'id'                       => $newSubelement[0],
										'nombre'                   => $newSubelement[1],
                                        'resultado'                => $newSubelement[2],
                                        'id_posible_resultado'     => $newSubelement[3],
                                        'nombre_posible_resultado' => $newSubelement[4],
                                        'unidad'                   => $newSubelement[5],
                                        'rango_inicio'             => $newSubelement[6],
                                        'rango_fin'                => $newSubelement[7],
                                        'control_normal'           => $newSubelement[8]
									);
		}

        return $subelements;
    }

    private function addTincionElementToExam($elements, $newElement) {
        if( ! isset($elements[ $newElement[1] ]) ){
			$elements[ $newElement[1] ] = array(
                                        'id'          => $newElement[0],
										'nombre'      => $newElement[1],
                                        'cantidad'    => $newElement[2],
                                        'id_cantidad' => $newElement[3]
									);
		}

        return $elements;
    }

    private function addProcedureToExam($procedures, $newProcedure) {
        if( ! isset($procedures[ $newProcedure[1] ]) ){
			$procedures[ $newProcedure[1] ] = array(
                                        'id'                       => $newProcedure[0],
										'nombre'                   => $newProcedure[1],
                                        'unidad'                   => $newProcedure[2],
                                        'rango_inicio'             => $newProcedure[3],
                                        'rango_fin'                => $newProcedure[4],
                                        'resultado'                => $newProcedure[5],
                                        'id_posible_resultado'     => $newProcedure[6],
                                        'nombre_posible_resultado' => $newProcedure[7],
                                        'control_diario'           => $newProcedure[8]
									);
		}

        return $procedures;
    }

    private function addBacterToExamn($bacters, $newBacter, $row) {
        if( ! isset($bacters[ $newBacter[1] ]) ){
			$bacters[ $newBacter[1] ] = array(
                                        'id'                       => $newBacter[0],
										'nombre'                   => $newBacter[1],
                                        'id_resultado'             => $newBacter[2],
                                        'resultado'                => $newBacter[3],
                                        'id_posible_resultado'     => $newBacter[4],
                                        'nombre_posible_resultado' => $newBacter[5],
                                        'cantidad'                 => $newBacter[6]
									);
		}

        if( ! isset($bacters[ $newBacter[1] ]['tarjetas']) ){
            $bacters[ $newBacter[1] ]['tarjetas'] = array();
        }

        $newCard = array(
            $row['id_tarjeta'],
            $row['nombre_tarjeta']
        );

        $bacters[ $newBacter[1] ]['tarjetas'] = $this->addCardToBacter($bacters[ $newBacter[1] ]['tarjetas'], $newCard, $row);

        return $bacters;
    }

    private function addCardToBacter($cards, $newCards, $row) {
        if( ! isset($cards[ $newCards[1] ]) ){
			$cards[ $newCards[1] ] = array(
                                        'id'             => $newCards[0],
										'nombre'         => $newCards[1]
									);
		}

        if( ! isset($cards[ $newCards[1] ]['antibioticos']) ){
            $cards[ $newCards[1] ]['antibioticos'] = array();
        }

        $newAntibiotic = array(
            $row['id_antibiotico'],
            $row['nombre_antibiotico'],
            $row['resultado_antibiotico'],
            $row['lectura_antibiotico'],
            $row['id_posible_resultado_antibiotico'],
            $row['nombre_posible_resultado_antibiotico']
        );

        $cards[ $newCards[1] ]['antibioticos'] = $this->addAntibioticToCard($cards[ $newCards[1] ]['antibioticos'], $newAntibiotic);

        return $cards;
    }

    private function addAntibioticToCard($antibiotics, $newAntibiotic) {
        if( ! isset($antibiotics[ $newAntibiotic[1] ]) ){
			$antibiotics[ $newAntibiotic[1] ] = array(
                                        'id'                       => $newAntibiotic[0],
										'nombre'                   => $newAntibiotic[1],
										'resultado'                => $newAntibiotic[2],
										'lectura'                  => $newAntibiotic[3],
										'id_posible_resultado'     => $newAntibiotic[4],
										'nombre_posible_resultado' => $newAntibiotic[5]
									);
		}

        return $antibiotics;
    }
}
