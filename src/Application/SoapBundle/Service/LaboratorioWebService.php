<?php
namespace Application\SoapBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Minsal\SeguimientoBundle\Service\RepositoryService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\SeguimientoBundle\Entity\SecRemisionPaciente as Remision;
use Minsal\SeguimientoBundle\Entity\SecSignosVitalesRemision as Signos;
use Minsal\LaboratorioBundle\Entity\MntPacienteReferido as Paciente;
use Minsal\LaboratorioBundle\Entity\LabResultados;
use Minsal\LaboratorioBundle\Entity\LabDetalleresultado;
use Minsal\LaboratorioBundle\Entity\LabResultadosportarjeta;

class LaboratorioWebService {

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /*
     * Método que permite obtener las especialidades de un establecimiento.
     */
    public function ingresarResultados($resultados) {
        $em = $this->container->get('doctrine')->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $resultados = json_decode($resultados, true);

            $User = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByUsername('refexterno');
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneByConfigurado(true);

            if(!$User) {
                throw new \Exception('El usuario refexterno no existe favor contactarse con el Establecimiento Solicitante');
            }

            $now = new \DateTime();

            //Recorrer los resultados completos
            foreach ($resultados['RC'] as $resultado) {
                $idExamen                 = $resultado['id'];
                $idDetalleSolicitud       = $resultado['id_detallesolicitud_siap'];
                $idSolicitud              = $resultado['id_solicitud_siap'];
                $idEstablecimientoProceso = $resultado['id_establecimiento_proceso'];
                $idEstadoDetalle          = $resultado['id_estado_detalle'];

                $SecSolicitudestudios = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->findOneById($idSolicitud);
                $SecDetallesolicitudestudio = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->findOneById($idDetalleSolicitud);
                $idRecepcion = $em->getRepository('MinsalLaboratorioBundle:LabRecepcionmuestra')->findOneByIdsolicitudestudio($idSolicitud);
                $CtlEstablecimientoExterno = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimientoProceso);

                //Datos de Resultados del detalle de solicitud
            //    foreach ($resultado['resultadoFinal'] as $rkey => $resultadofinal) {
                    $resultadofinal     = $resultado['resultadoFinal'];
                    $idEmpleado         = $resultadofinal['id_empleado'];
                    $nombreEmpleado     = $resultadofinal['nombre_empleado'];
                    $fechaResultado     = \DateTime::createFromFormat('Y-m-d h:i:s',  $resultadofinal['fecha_resultado']);
                    $resultadoFin       = $resultadofinal['resultado'];
                    $idPosibleResultado = $resultadofinal['id_posible_resultado'];
                    $lectura            = $resultadofinal['lectura'];
                    $interpretacion     = $resultadofinal['interpretacion'];
                    $observacion        = $resultadofinal['observacion'];
                    $idObservacion      = $resultadofinal['id_observacion'];
                    $rangoInicio        = $resultadofinal['rango_inicio'];
                    $rangoFin           = $resultadofinal['rango_fin'];
                    $unidad             = $resultadofinal['unidad'];

                    $LabObservaciones    = $idObservacion ? $em->getRepository('MinsalLaboratorioBundle:LabObservaciones')->findOneById($idObservacion) : NULL;
                    $LabPosibleResultado = $idPosibleResultado ? $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($idPosibleResultado) : NULL;


                    $LabResultados = new LabResultados();
                    $LabResultados->setIdsolicitudestudio($SecSolicitudestudios);
                    $LabResultados->setIddetallesolicitud($SecDetallesolicitudestudio);
                    $LabResultados->setIdrecepcionmuestra($idRecepcion);
                    $LabResultados->setResultado($resultadoFin);
                    $LabResultados->setLectura($lectura);
                    $LabResultados->setInterpretacion($interpretacion);
                    $LabResultados->setObservacion($observacion);
                    $LabResultados->setIdestablecimiento($CtlEstablecimiento);
                    $LabResultados->setIdusuarioreg($User);
                    $LabResultados->setFechahorareg($now);
                    $LabResultados->setIdexamen($SecDetallesolicitudestudio->getIdConfExamenEstab());
                    $LabResultados->setIdObservacion($LabObservaciones);
                    $LabResultados->setFechaResultado($fechaResultado);
                    $LabResultados->setIdPosibleResultado($LabPosibleResultado);
                    $LabResultados->setIdestablecimientoRealizo($CtlEstablecimientoExterno);
                    $LabResultados->setNombreEmpleado($nombreEmpleado);

                    $em->persist($LabResultados);
                    $em->flush(); //inserta en base


                    $idResultados = $LabResultados->getId();
                   //$em->getConnection()->rollback();
                    $cantElementos = count($resultadofinal['elementos']);

                    if ($cantElementos >0){

                    foreach ($resultadofinal['elementos'] as $elemento){
                        $idElemento                 = $elemento['id'];
                        $nombreElemento             = $elemento['nombre'];
                        $resultadoElemento          = $elemento['resultado'];
                        $idPosibleResultadoElemento = $elemento['id_posible_resultado'];
                        $unidadElemento             = $elemento['unidad'];
                        $rangoInicioElemento        = $elemento['rango_inicio'];
                        $rangoFinElemento           = $elemento['rango_fin'];
                        $controlNormalElemento      = $elemento['control_normal'];
                        $cantSubelementoElemento    = count($elemento['subelementos']);
                        $LabPosibleResultadoElemento = $idPosibleResultadoElemento ? $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($idPosibleResultadoElemento) : NULL;

                        if ($cantSubelementoElemento >0){
                            //Insert a tabla  lab_detalleresultados, ya que si tiene elementos solo reporta los subelementos en esta tabla.
                            foreach ($elemento['subelementos'] as $subelemento){
                                $idSubElemento                  = $subelemento['id'];
                                $nombreSubElemento              = $subelemento['nombre'];
                                $resultadoSubElemento           = $subelemento['resultado'];
                                $idPosibleResultadoSubElemento  = $subelemento['id_posible_resultado'];
                                $unidadSubElemento              = $subelemento['unidad'];
                                $rangoInicioSubElemento         = $subelemento['rango_inicio'];
                                $rangoFinSubElemento            = $subelemento['rango_fin'];
                                $controlNormalSubElemento       = $subelemento['control_normal'];

                                $LabPosibleResultadoSubelemento = $idPosibleResultadoSubElemento ? $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($idPosibleResultadoSubElemento) : NULL;

                                $LabDetalleresultado = new LabDetalleresultado();
                                $LabDetalleresultado->setIdresultado($LabResultados);
                                $LabDetalleresultado->setIdestablecimiento($CtlEstablecimiento);
                                $LabDetalleresultado->setBReferido(true);
                                $LabDetalleresultado->setElementoReferido($nombreElemento);
                                if (!$LabPosibleResultadoElemento)
                                    $LabDetalleresultado->setResultadoElementoReferido($resultadoElemento);
                                else {
                                    $LabDetalleresultado->setResultadoElementoReferido($LabPosibleResultadoElemento)->getPosibleResultado();
                                }
                                $LabDetalleresultado->setSubelementoReferido($nombreSubElemento);
                                if (!$LabPosibleResultadoSubelemento)
                                    $LabDetalleresultado->setResultadoSubelementoReferido($resultadoSubElemento);
                                else {
                                    $LabDetalleresultado->setResultadoSubelementoReferido($LabPosibleResultadoSubelemento->getPosibleResultado());
                                }
                                $LabDetalleresultado->setUnidadElementoReferido($unidadElemento);
                                $LabDetalleresultado->setRangoinicioElementoReferido($rangoInicioElemento);
                                $LabDetalleresultado->setRangofinElementoReferido($rangoFinElemento);
                                $LabDetalleresultado->setUnidadSubelementoReferido($unidadSubElemento);
                                $LabDetalleresultado->setRangoinicioSubelementoReferido($rangoInicioSubElemento);
                                $LabDetalleresultado->setRangofinSubelementoReferido($rangoFinSubElemento);
                                $LabDetalleresultado->setIdPosresultElementoReferido($LabPosibleResultadoElemento);
                                $LabDetalleresultado->setIdPosresultSubelementoReferido($LabPosibleResultadoSubelemento);


                                $em->persist($LabDetalleresultado);
                                $em->flush();//Guardar en base de datos



                                //fin insert si tenia subelementos
                            }//fin foreach subelemento

                        }
                        else{
                            //hacer insert en procedimentos  ya que no tiene subelementos
                            $LabDetalleresultado = new LabDetalleresultado();
                            $LabDetalleresultado->setIdresultado($LabResultados);
                            $LabDetalleresultado->setIdestablecimiento($CtlEstablecimiento);
                            $LabDetalleresultado->setBReferido(true);
                            $LabDetalleresultado->setElementoReferido($nombreElemento);
                            if (!$LabPosibleResultadoElemento)
                                $LabDetalleresultado->setResultadoElementoReferido($resultadoElemento);
                            else {
                                $LabDetalleresultado->setResultadoElementoReferido($LabPosibleResultadoElemento)->getPosibleResultado();
                            }
                            $LabDetalleresultado->setUnidadElementoReferido($unidadElemento);
                            $LabDetalleresultado->setRangoinicioElementoReferido($rangoInicioElemento);
                            $LabDetalleresultado->setRangofinElementoReferido($rangoFinElemento);
                            $LabDetalleresultado->setIdPosresultElementoReferido($LabPosibleResultadoElemento);

                            $em->persist($LabDetalleresultado);
                            $em->flush();//Guardar en base de datos
                            //fin insert si no tenia subelementos
                        }
                    }//fin foreach elemento
                }//fin if hay elementos, sino debe entrar a bacterias
                else{
                    //foreach de bacterias
                    //return implode(', ',  array($resultadofinal['bacterias']));
                    //return (string)  count($resultadofinal['bacterias']);
                //    return $resultadofinal['bacterias']['id'];
                    foreach ($resultadofinal['bacterias'] as $bacteria){
                        $idBacteria         = $bacteria['id'];
                        $cantidadBacteria   = $bacteria['cantidad'];
                        $LabBacterias = $em->getRepository('MinsalLaboratorioBundle:LabBacterias')->findOneById($idBacteria);


                        foreach ($bacteria['tarjetas'] as $tarjeta){
                            $idTarjeta      = $tarjeta['id'];

                            $LabTarjetasvitek = $em->getRepository('MinsalLaboratorioBundle:LabTarjetasvitek')->findOneById($idTarjeta);

                            $LabDetalleresultado = new LabDetalleresultado();
                            $LabDetalleresultado->setIdresultado($LabResultados);
                            $LabDetalleresultado->setIdestablecimiento($CtlEstablecimiento);
                            $LabDetalleresultado->setBReferido(true);
                            $LabDetalleresultado->setIdbacteria($LabBacterias);
                            $LabDetalleresultado->setIdtarjeta($LabTarjetasvitek);
                            $LabDetalleresultado->setCantidad($cantidadBacteria);

                            $em->persist($LabDetalleresultado);
                            $em->flush();

                            $iddetalleresultado = $LabDetalleresultado->getId();

                            foreach ($tarjeta['antibioticos'] as $antibiotico) {
                                $idAntibiotico                  = $antibiotico['id'];
                                $resultadoAntibiotico           = $antibiotico['resultado'];
                                $valorAntibiotico               = $antibiotico['lectura'];
                                $idPosibleResultadoAntibiotico  = $antibiotico['id_posible_resultado'];

                                $LabAntibioticos= $em->getRepository('MinsalLaboratorioBundle:LabAntibioticos')->findOneById($idAntibiotico);
                                $LabPosibleResultadoAntibiotico= $idPosibleResultadoAntibiotico ?  $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($idPosibleResultadoAntibiotico) : NULL;

                                $LabResultadosportarjeta  = new LabResultadosportarjeta();
                                $LabResultadosportarjeta->setIddetalleresultado($LabDetalleresultado);
                                $LabResultadosportarjeta->setIdantibiotico($LabAntibioticos);
                                $LabResultadosportarjeta->setResultado($resultadoAntibiotico);

                                if (!$LabPosibleResultadoAntibiotico)
                                    $LabResultadosportarjeta->setValor($valorAntibiotico);
                                else {
                                    $LabResultadosportarjeta->setValor($LabPosibleResultadoAntibiotico->getPosibleResultado());
                                }
                                $LabResultadosportarjeta->setIdestablecimiento($CtlEstablecimiento);
                                $LabResultadosportarjeta->setIdPosibleResultado($LabPosibleResultadoAntibiotico);
                                $em->persist($LabResultadosportarjeta);
                                $em->flush();

                            }//fin foreach de antibioticos


                        }//fin foreach de tarjetas

                    }//fin foreach bacterias

                }

        //    }//fin resultado





            }//Fin foreach $resultados[RC]
            //Recorrer los resultados Rechazos de Muestras
            foreach ($resultados['RR'] as $resultado) {
                $idExamen                 = $resultado['id'];
                $idDetalleSolicitud       = $resultado['id_detallesolicitud_siap'];
                $idSolicitud              = $resultado['id_solicitud_siap'];
                $idEstablecimientoProceso = $resultado['id_establecimiento_proceso'];
                $idEstadoDetalle          = $resultado['id_estado_detalle'];
                $nombreEmpleado           = $resultado['nombre_empleado'];
                $fechaRechazo             = $resultado['fecha_rechazo'];
                $idEstadoRechazo         = $resultado['id_estado_rechazo'];
                $idObservacionRechazo     = $resultado['id_observacion_rechazo'];

                $SecSolicitudestudios = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->findOneById($idSolicitud);
                $SecDetallesolicitudestudio = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->findOneById($idDetalleSolicitud);
                $idRecepcion = $em->getRepository('MinsalLaboratorioBundle:LabRecepcionmuestra')->findOneByIdsolicitudestudio($idSolicitud);
                $CtlEstablecimientoExterno = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimientoProceso);
                $CtlEstadoServicioDiagnostico=$em->getRepository('MinsalLaboratorioBundle:CtlEstadoServicioDiagnostico')->findOneById($idEstadoDetalle);

                $SecDetallesolicitudestudio->setEstadodetalle($CtlEstadoServicioDiagnostico);
                $SecDetallesolicitudestudio->setEstadodetalle($CtlEstadoServicioDiagnostico);

                    return $SecDetallesolicitudestudio->getId();

            }



        $result = array(
            'status'  => 'true',
            'message' => 'Datos ingresados correctamente'
        );

           $em->getConnection()->commit();
        } catch(\Exception $ex) {
           $em->getConnection()->rollback();

             return $ex->__toString() ;
            //return $ex->getMessage() ;
        }

        return json_encode($result);
    }
}
