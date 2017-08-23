<?php

namespace Application\SoapBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Minsal\SeguimientoBundle\Service\RepositoryService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\LaboratorioBundle\Entity\LabControlInterface as ControlInterface;

class InterfaceLisWebService {

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }



    /*
     * Método para auntenticacion del usuario retorna token.
     *
     * variables a recibir
     *      AppUser
     *      Password
     *
     * Julio Castillo
     *
     */
    public function checkin($in0) {

        //convierte en un array de PHP una cadena JSON
        $data = json_decode($in0,TRUE);

        $authenticator = $this->container->get('api.authenticator');

        $username = $data['AppUser'];
        $password = $data['Password'];

        try {
            $sigInData = $authenticator->signIn($username, $password);
        } catch (\Exception $e) {
            throw $e;
        }

        return json_encode($sigInData);
    }


    /*
     * Método para salir de la session ws.
     *
     * variables a recibir
     *      token
     *
     * Julio Castillo
     *
     */
    public function checkout($in0) {

        //convierte en un array de PHP una cadena JSON
        $data = json_decode($in0,TRUE);

        $token = $data['token'];

        $authenticator = $this->container->get('api.authenticator');

        try {
            $signOutData = $authenticator->signOut($token);
        } catch (\Exception $e) {
            throw $e;
        }

        return new Response(json_encode($signOutData));
    }

    /*
    * Método para solicitar la generacion y envio de HL7.
    * crea mensaje para enviarlo y guardarlo en SIAP-LABORATORIO
    * elementos del array
    *      idSolicitud
    * Julio Castillo
    */
   public function generarMensajeSolicitud($in0) {

       $data = json_decode($in0,TRUE); //transforma el JSON en array de php

       $authenticator = $this->container->get('api.authenticator'); // instancia la api para autenticacion
       $hl7Service    = $this->container->get('hl7.service');

       try { // verifica la gui con el rol de usuario para determinar los privilegios
           $isGranted = $authenticator->isGranted($data['token'], 'ROLE_API_LABORATORIO_INGRESORESULTADOS');
       } catch (\Exception $e) {
           throw new \Excpetion('Permiso denegado');
       }

       if($isGranted) {
           //procesando la solicitud, generando mensaje HL7
           try {
               $hl7String = $hl7Service->encodeHl7ObservationMsg($data['idSolicitud']);
           } catch (Exception $e) {
               return $e->__toString();
           }

           $result = $hl7String;  //mensaje HL7 devuelto
       } else {
           $result = "no tiene permisos para realizar esta operacion";
       }

       return $result;
   }

    /*
     * Método para la comunicacion con el analizador automatico.
     * objtivo: recibir mensaje con resultados para guardarlos en la base de datos SIAP-LABORATORIO
     * elementos del array
     *      token       token
     *      Mensaje     mensaje
     *      checksum    checksum
     * Julio Castillo
     */
    public function acceptMessage($in0) {

       $data = json_decode($in0,TRUE); //transforma el JSON en array de php

       $authenticator = $this->container->get('api.authenticator'); // instancia la api para autenticacion
       $hl7Service    = $this->container->get('hl7.service');

       try { // verifica la gui con el rol de usuario para determinar los privilegios
           $isGranted = $authenticator->isGranted($data['token'], 'ROLE_API_LABORATORIO_INGRESORESULTADOS');
       } catch (\Exception $e) {
           throw new \Excpetion('Permiso denegado');
       }

       if($isGranted) {
           //procesando la solicitud, generando mensaje HL7
           $hl7Service->guardarBitacoraReciboHl7String($data['Mensaje']);
           $result = 'OK';  //mensaje HL7 devuelto
       } else {
           $result = "no tiene permisos para realizar esta operacion";
       }
       return $result;
    }
}
