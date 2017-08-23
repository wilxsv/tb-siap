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

class SeguimientoWebService {

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /*
     * Método que permite obtener las especialidades de un establecimiento.
     */
    public function obtenerEspecialidades() {
        $result = array();
        try {
            $em  = $this->container->get('doctrine')->getManager();
            $dql = "SELECT DISTINCT B FROM MinsalSiapsBundle:MntAtenAreaModEstab B join MinsalSiapsBundle:MntAreaModEstab C WITH (B.idAreaModEstab = C.id) where B.nombreAmbiente IS NULL and C.idAreaAtencion=1 ORDER BY B.id ASC";

            $idEspecialidad = $em->createQuery($dql)->getResult();

            foreach ($idEspecialidad as $espe) {
                $especialidades["id"]     = $espe->getId();
                $especialidades["nombre"] = $espe->getNombreConsulta();

                array_push($result, $especialidades);
            }
        } catch(\Exception $ex) {
            return $ex->getTraceAsString();
            //return $ex->getTraceAsString();
        }
        return json_encode($result);
        //return $result;
    }

    /*
     * Método que permite obtener una especialidad de un establecimiento.
     */
    public function obtenerEspecialidad($id) {
        try {
            $em  = $this->container->get('doctrine')->getManager();
            $dql = "SELECT B FROM MinsalSiapsBundle:MntAtenAreaModEstab B where B.id=$id ";

            $idEspecialidad = $em->createQuery($dql)->getResult();

            foreach ($idEspecialidad as $espe) {
                $especialidad = $espe->getNombreConsulta();
            }
        } catch(\Exception $ex) {
            return $ex;
        }

        return $especialidad;
    }

    private function findObject($bundle, $entity, $id) {
        $em = $this->container->get('doctrine')->getManager();
        $foundObject = $em->getRepository($bundle . ':' . $entity)->findOneById($id);

        return $foundObject;
    }

    public function guardarReferencia($xml) {
        try {
            $em = $this->container->get('doctrine')->getManager();

            $decod = convert_uudecode($xml);
            $elxml = simplexml_load_string($decod, null, LIBXML_NOCDATA);
            $enxml = json_encode($elxml);
            $dexml = json_decode($enxml, true);

            $remisionid = 0;
            foreach ($dexml as $fila) {
                $eltipo        = $this->findObject('MinsalSeguimientoBundle', 'CtlTipoRemision', $fila['tipore']);
                $elmotivo      = $this->findObject('MinsalSeguimientoBundle', 'CtlMotivoRemision', $fila['motivre']);
                $estableorigen = $this->findObject('MinsalSiapsBundle', 'CtlEstablecimiento', $fila['estableorigen']);
                $establedest   = $this->findObject('MinsalSiapsBundle', 'CtlEstablecimiento', $fila['establedest']);

                $mfecha   = new \DateTime($fila['fecha']);
                $remision = new Remision();

                $remision->setIdRemisionPacienteOrigen($fila['idreferenciaorigen']);
                $remision->setCodigo($fila['codigo']);
                $remision->setFechaRemision($mfecha);
                $remision->setIdTipoRemision($eltipo);
                $remision->setIdMotivoRemision($elmotivo);
                $remision->setNumeroExpediente($fila['numexp']);
                $remision->setIdEstablecimientoOrigen($estableorigen);
                $remision->setIdEstablecimientoDestino($fila['establedest']);
                $remision->setIdEspecialidadDestino($fila['espedest']);
                $remision->setNombreEspecialidadDestino($fila['nespedest']);
                $remision->setNombreEspecialidadOrigen($fila['nespeorigen']);
                $remision->setImpresionDiagnostica(($fila['diagnos'] != '??') ? $fila['diagnos'] : null);
                $remision->setJustificacionRemision(($fila['justif'] != '??') ? $fila['justif'] : null);
                $remision->setDatosExamen(($fila['examen'] != '??') ? $fila['examen'] : null);
                $remision->setObservacionResultado(($fila['resultado'] != '??') ? $fila['resultado'] : null);
                $remision->setTratamiento(($fila['trata'] != '??') ? $fila['trata'] : null);

                $em->persist($remision);
                $em->flush();

                $remisionid = $remision->getId();
            }

            return $remisionid;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function guardarDatosReferencia($xml, $xml2) {

        try {
            $em = $this->container->get('doctrine')->getManager();

            $decod1 = convert_uudecode($xml);
            $elxml  = simplexml_load_string($decod1);
            $enxml  = json_encode($elxml);
            $dexml  = json_decode($enxml, true);
            $decod2 = convert_uudecode($xml2);
            $elxml2 = simplexml_load_string($decod2);
            $enxml2 = json_encode($elxml2);
            $dexml2 = json_decode($enxml2, true);

            $remisionid = 0;
            foreach ($dexml as $fila) {
                $remision = $this->findObject('MinsalSeguimientoBundle', 'SecRemisionPaciente', $fila['idremision']);
                $signos   = new Signos();

                $signos->setIdRemision($remision);
                $signos->setPeso($fila['peso']);
                $signos->setTemperatura($fila['temperatura']);
                $signos->setTalla($fila['talla']);
                $signos->setFrecuenciaCardiaca($fila['freqc']);
                $signos->setFrecuenciaRespiratoria($fila['freqr']);
                $signos->setPresionArterial($fila['presion']);

                $em->persist($signos);
                $em->flush();
            }

            foreach ($dexml2 as $fila2) {
                $sexo     = $this->findObject('MinsalSiapsBundle', 'CtlSexo', $fila2['sexo']);
                $modulo   = $this->findObject('MinsalLaboratorioBundle', 'CtlModulo', $fila2['idmodulo']);
                $lfecha   = new \DateTime($fila2['fechanac']);
                $paciente = new Paciente();

                $paciente->setIdSexo($sexo);
                $paciente->setIdModulo($modulo);
                $paciente->setPrimerNombre(($fila2['primern']!= '??')?$fila2['primern']:null);
                $paciente->setSegundoNombre(($fila2['segundon']!= '??')?$fila2['segundon']:null);
                $paciente->setTercerNombre(($fila2['tercern']!= '??')?$fila2['tercern']:null);
                $paciente->setPrimerApellido(($fila2['primera']!= '??')?$fila2['primera']:null);
                $paciente->setSegundoApellido(($fila2['segundoa']!= '??')?$fila2['segundoa']:null);
                $paciente->setApellidoCasada(($fila2['apellidoc']!= '??')?$fila2['apellidoc']:null);
                $paciente->setFechaNacimiento($lfecha);
                $paciente->setNombreResponsable(($fila2['respon']!= '??')?$fila2['respon']:null);
                $paciente->setNombreMadre(($fila2['madre']!= '??')?$fila2['madre']:null);
                $paciente->setNombrePadre(($fila2['padre']!= '??')?$fila2['padre']:null);
                $paciente->setDireccion(($fila2['direccion']!= '??')?$fila2['direccion']:null);
                $paciente->setIdDepartamentoDomicilio(($fila2['iddepto']!= '??')?$fila2['iddepto']:null);
                $paciente->setIdMunicipioDomicilio(($fila2['idmuni']!= '??')?$fila2['idmuni']:null);
                $paciente->setAreaGeograficaDomicilio(($fila2['area']!= '??')?$fila2['area']:null);
                $paciente->setIdReferenciaOrigen($fila2['idremision']);

                $em->persist($paciente);
                $em->flush();

                $remisionid = $remision->getId();
            }

            return $remisionid;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

}
