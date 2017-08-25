<?php
namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClienteController extends Controller {

    protected $requestScheme;
    protected $codeEnvironment;
    protected $environment;
    protected $domain;
    private   $method = null;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->method          = $this->container->getParameter('ws_method');
        $this->requestScheme   = $this->container->get('request')->server->get('REQUEST_SCHEME');
        $this->codeEnvironment = $this->container->getParameter("kernel.environment");
        if($this->codeEnvironment === 'dev') {
            $this->environment = '/app_dev.php';
        } else {
            $this->environment = '/app.php';
        }
        $this->domain          = $this->container->get('request')->server->get('HTTP_HOST');
    }

    public function obtenerEspecialidadesAction($establecimiento, $host, $method) {
       // return new Response($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
        } catch(\Exception $ex) {
            $result['success'] = false;
            $result['errorMsg'] = $ex->getMessage();
            return new Response(json_encode($result));
        }

        if($method === 'ip') {
            $action = 'obtenerIpEstablecimiento';
        } else {
            $action = 'obtenerEstablecimiento';
        }

        try {
            $establecimiento = $soapClient->soapCall($action, array('establecimiento' => $establecimiento));
        } catch(\Exception $ex) {
            throw $ex;
        }

        if($establecimiento === null) {
            if($method === 'ip') {
                $establecimiento = '127.0.0.1';
            } else {
                $establecimiento = $this->domain;
            }
        }

        $url = $this->requestScheme."://".$establecimiento;
        if($method === 'ip') {
            $url .= $this->environment."/soap/seguimientowebservice?wsdl";
        } else {
            $url .= $this->environment."/soap/seguimientowebservice?wsdl";
        }

        $result = null;
        //var_dump($url);exit();
        $soapClient->setUrl($url);

        try {
            $soapClient->createSoapClient();
            $soapClient->setLocation($url);
            $result = $soapClient->soapCall('obtenerEspecialidades');
        } catch(\Exception $ex) {
            throw $ex;
        }
        return new Response($result);
    }

    public function obtenerEspecialidadAction($establecimiento, $host, $especialidad) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
        } catch(\Exception $ex) {
            throw $ex;
        }

        if($this->method === 'ip') {
            $action = 'obtenerIpEstablecimiento';
        } else {
            $action = 'obtenerEstablecimiento';
        }

        try {
            $establecimiento = $soapClient->soapCall($action, array('establecimiento' => $establecimiento));
        } catch(\Exception $ex) {
            throw $ex;
        }

        if($establecimiento === null) {
            if($this->method === 'ip') {
                $establecimiento = '127.0.0.1';
            } else {
                $establecimiento = $this->domain;
            }
        }

        $url = $this->requestScheme."://".$establecimiento;
        if($this->method === 'ip') {
            $url .= "/seguimientowebservice.wsdl";
        } else {
            $url .= $this->environment."/soap/seguimientowebservice?wsdl";
        }

        $result = null;
        $soapClient->setUrl($url);

        try {
            $soapClient->createSoapClient();
            $result = $soapClient->soapCall('obtenerEspecialidad', array('id' => $especialidad));
        } catch(\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function obtenerEstablecimientosAction($host) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
            $establecimientos = $soapClient->soapCall('obtenerEstablecimientos');
        } catch(\Exception $ex) {
            throw $ex;
        }

        return $establecimientos;
    }

    public function obtenerPacientesAction($host,$nombre,$fechanac,$dui,$sexo) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
            $pacientes = $soapClient->soapCall('obtenerPacientes', array('nombre_completo'=>$nombre, 'fecha_nacimiento'=>$fechanac,'sexo'=>$sexo, 'dui'=>$dui));
        } catch(\Exception $ex) {
            throw $ex;
        }

        return $pacientes;
    }

    public function guardarReferenciaAction($establecimiento, $host, $elxml) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
        } catch(\Exception $ex) {
            throw $ex;
        }

        if($this->method === 'ip') {
            $action = 'obtenerIpEstablecimiento';
        } else {
            $action = 'obtenerEstablecimiento';
        }

        try {
            $establecimiento = $soapClient->soapCall($action, array('establecimiento' => $establecimiento));
        } catch(\Exception $ex) {
            throw $ex;
        }

        $url = $this->requestScheme."://";
        if($this->method === 'ip') {
            $soapClient->setLocation($url.$establecimiento.$this->environment.'/soap/seguimientowebservice');
            $url .= $this->domain."/seguimientowebservice.wsdl";
        } else {
            $url .= $establecimiento.$this->environment."/soap/seguimientowebservice?wsdl";
        }

        $result = null;
        $codificada = convert_uuencode($elxml);
        $soapClient->setUrl($url);

        try {
            $soapClient->createSoapClient();
            $result = $soapClient->soapCall('guardarReferencia', array('xml' => $codificada));
        } catch(\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function guardarDatosReferenciaAction($establecimiento, $host, $elxml, $elxml2) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap?wsdl");

        try {
            $soapClient->createSoapClient();
        } catch(\Exception $ex) {
            throw $ex;
        }

        if($this->method === 'ip') {
            $action = 'obtenerIpEstablecimiento';
        } else {
            $action = 'obtenerEstablecimiento';
        }

        try {
            $establecimiento = $soapClient->soapCall($action, array('establecimiento' => $establecimiento));
        } catch(\Exception $ex) {
            throw $ex;
        }

        $url = $this->requestScheme."://";
        if($this->method === 'ip') {
            $soapClient->setLocation($url.$establecimiento.$this->environment.'/soap/seguimientowebservice');
            $url .= $this->domain."/seguimientowebservice.wsdl";
        } else {
            $url .= $establecimiento.$this->environment."/soap/seguimientowebservice?wsdl";
        }
        $result      = null;
        $codificada  = convert_uuencode($elxml);
        $codificada2 = convert_uuencode($elxml2);
        $soapClient->setUrl($url);

        try {
            $soapClient->createSoapClient();
            $result = $soapClient->soapCall('guardarDatosReferencia', array('xml' => $codificada, 'xml2' => $codificada2));
        } catch(\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function registrarSolicitudAction($host, $elxml, $elxml2) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap/webservices/proveedor_servicios?wsdl");
        //var_dump('Estableciendo Conexion con <b> '.$this->requestScheme."://".$host.$this->environment."/soap/webservices/proveedor_servicios?wsdl".' <b>...<br/>');
        try {
            $soapClient->createSoapClient();
            //var_dump('Llamando al metodo soapCall: registrarSolicitud ...<br/>');
            $result = $soapClient->soapCall('registrarSolicitud', array("solicitud"=>$elxml,"paciente"=>$elxml2));
        } catch(\Exception $ex) {
            //var_dump('Se ha producido un error: <b>errorCode</b>'.$soapClient->getCodeInfo().' <b>errorMessage</b>'.$ex);
            return array(
                         'errorCode'    => $soapClient->getCodeInfo(),
                         'errorMessage' => $ex,
                         'status'       => false,
                         'result'       => null
                        );
        }

        return array(
                     'status'       => true,
                     'result'       => $result
                    );
    }


    public function eliminarSolicitudAction($host, $xml) {
        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme."://".$host.$this->environment."/soap/webservices/proveedor_servicios?wsdl");
        //var_dump('Estableciendo Conexion con <b> '.$this->requestScheme."://".$host.$this->environment."/soap/webservices/proveedor_servicios?wsdl".' <b>...<br/>');
        try {
            $soapClient->createSoapClient();
            //var_dump('Llamando al metodo soapCall: eliminarSolicitud ...<br/>');
            $result = $soapClient->soapCall('eliminarSolicitud', array( "solicitud" => $xml ));
        } catch(\Exception $ex) {
            //var_dump('Se ha producido un error: <b>errorCode</b>'.$soapClient->getCodeInfo().' <b>errorMessage</b>'.$ex);
            return array(
                         'errorCode'    => $soapClient->getCodeInfo(),
                         'errorMessage' => $ex,
                         'status'       => false,
                         'result'       => null
                        );
        }

        return array(
                     'status'       => true,
                     'result'       => $result
                    );
    }



}
