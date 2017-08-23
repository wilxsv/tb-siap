<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Minsal\SiapsBundle\Entity\MntAuditoriaPaciente;
use Minsal\SeguimientoBundle\Entity\SecEmergencia;
use Minsal\SiapsBundle\Entity\MntExpediente;
use Minsal\SiapsBundle\Entity\MntJustificacionCumNoValido;
use Minsal\Metodos\Funciones;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL as DBAL;
use Minsal\SiapsBundle\Form\DataTransformer\DateTimeToStringTransformer;

class MntPacienteAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'configurado' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureFormFields(FormMapper $formMapper) {
        $elSalvador   = $this->getModelManager()->findOneBy('MinsalSiapsBundle:CtlPais', array('id' => 68));
        $em           = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $transformer  = new DateTimeToStringTransformer($em,'d/m/Y');
        $numero       = $em->getRepository('MinsalSiapsBundle:MntExpediente')->obtenerExpedienteSugerido();
        $esdomed      = $this->getModelManager()->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => 3));
        $readonlyCun  = false;
        $user         = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        //SI NO VIENE DE CITAS NI DE LA EMERGENCIA
        if ($this->getRequest()->get('procedencia') != 'e' and $this->getRequest()->get('procedencia') !== 'citas') {
            //SI TIENE ID ES UN EDITAR NORMAL
            if ($this->getRequest()->get('id')) {
                $expedienteResultado = $this->getModelManager()
                   ->getEntityManager('MinsalSiapsBundle:MntExpediente')
                   ->createQuery("SELECT e
                                  FROM MinsalSiapsBundle:MntExpediente e
                                  JOIN e.idPaciente p
                                WHERE p.id=" . $this->getRequest()->get('id') . ' AND e.habilitado = TRUE')
                   ->getResult();
                if ($expedienteResultado) {
                    $expedienteResultado=$expedienteResultado[0];
                    if($expedienteResultado->getNumeroTemporal()){
                        $atributosExpediente=array('attr'=>array(
                                        'data-toggle' => 'tooltip','title' => "Este valor es el ultimo expediente no el valor provisional que tenia"),
                                        'data'=>$numero,
                                    );
                        $atributosAreaCreacion=array('data'=>$expedienteResultado->getIdCreacionExpediente(),'attr'=>array());
                        $valorNoValido='n';

                    }else{
                        $readonlyCun=$expedienteResultado->getCun()?true:false;
                        if ($readonlyCun){
                            $atributosExpediente=array('data' => $expedienteResultado->getNumero(),'attr'=>array(
                                            'data-toggle' => 'tooltip','title' => "No se puede editar este número de expediente ya que es un Código Único de Nacimiento"));
                            $valorNoValido='s';
                        }else{
                            $atributosExpediente=array('data' => $expedienteResultado->getNumero(),'attr'=>array());
                            $valorNoValido='n';
                        }

                        $atributosAreaCreacion=array('data'=>$expedienteResultado->getIdCreacionExpediente(),'attr'=>array());
                    }
                    $formMapper->add('numero', 'text', array('required' => true,'read_only'=>$readonlyCun,
                                     'label' => $this->getTranslator()->trans('numero'),'mapped'=>false,'data'=>$atributosExpediente['data'],
                                     'attr' => $atributosExpediente['attr']
                                ))
                                ->add('noValido','hidden',array('required'=>false,'data'=>$valorNoValido,'mapped'=>false))
                                ->add('idUsuarioJustifica','hidden',array('required'=>false,'data'=>$user->getId(),'mapped'=>false))
                                ->add('usuarioJustifica','text',array('label'=>'Usuario que justifica','required'=>false,'data'=>$user,'mapped'=>false,'read_only'=>true))
                                ->add('justificacion','text',array('label'=>'Justificacion','required'=>false,'mapped'=>false))
                                ->add('idCreacionExpediente', 'entity', array('required' => true,
                                      'preferred_choices' => array($esdomed),'mapped'=>false,
                                      'label' => $this->getTranslator()->trans('idCreacionExpediente'),
                                      'class' => 'MinsalSiapsBundle:CtlCreacionExpediente','attr'=>$atributosAreaCreacion['attr'],
                                      'data' => $atributosAreaCreacion['data'])
                                );
                }else{//ES UN EDITAR QUE ES CONSULTA PERO NO TIENE EXPEDIENTE PORQUE SE CREO EN LA EMERGENCIA
                    $formMapper
                        ->add('numero', 'text', array('required' => true,
                            'label' => $this->getTranslator()->trans('numero'),'mapped'=>false,
                            'data'=>$numero
                        ))
                        ->add('noValido','hidden',array('required'=>false,'data'=>'n','mapped'=>false))
                        ->add('idUsuarioJustifica','hidden',array('required'=>false,'data'=>$user->getId(),'mapped'=>false))
                        ->add('usuarioJustifica','text',array('label'=>'Usuario que justifica','required'=>false,'data'=>$user,'mapped'=>false,'read_only'=>true))
                        ->add('justificacion','text',array('label'=>'Justificacion','required'=>false,'mapped'=>false))
                        ->add('idCreacionExpediente', 'entity', array('required' => true,
                            'preferred_choices' => array($esdomed),'mapped'=>false,
                            'label' => $this->getTranslator()->trans('idCreacionExpediente'),
                            'class' => 'MinsalSiapsBundle:CtlCreacionExpediente',
                        ));
                }
            }else{//ES UN CREAR NORMAL
                    $formMapper
                        ->add('numero', 'text', array('required' => true,
                            'label' => $this->getTranslator()->trans('numero'),'mapped'=>false,
                            'data'=>$numero
                        ))
                        ->add('noValido','hidden',array('required'=>false,'data'=>'n','mapped'=>false))
                        ->add('idUsuarioJustifica','hidden',array('required'=>false,'data'=>$user->getId(),'mapped'=>false))
                        ->add('usuarioJustifica','text',array('label'=>'Usuario que justifica','required'=>false,'data'=>$user,'mapped'=>false,'read_only'=>true))
                        ->add('justificacion','text',array('label'=>'Justificacion','required'=>false,'mapped'=>false))
                        ->add('idCreacionExpediente', 'entity', array('required' => true,
                            'preferred_choices' => array($esdomed),'mapped'=>false,
                            'label' => $this->getTranslator()->trans('idCreacionExpediente'),
                            'class' => 'MinsalSiapsBundle:CtlCreacionExpediente',
                        ));
            }
        }

        $formMapper
                ->add('primerApellido', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add('segundoApellido', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add('apellidoCasada', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add('primerNombre', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add('segundoNombre', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add('tercerNombre', null, array('attr' => array('class' => 'span5 limpiar')))
                ->add($formMapper->getFormBuilder()->create(
                      'fechaNacimiento','text',array('label' => 'Fecha Nacimiento','required' => true,
                                                     'disabled'=>$readonlyCun,
                                                      'attr' => array('class' => 'bootstrap-datepicker now form-control')
                                                )
                        )->addModelTransformer($transformer)
                )//ADD DE LA FECHA DE NACIMIENTO
                ->add('idSexo', null, array('label' => 'Sexo', 'required' => true))
                ->add('numeroDocIdePaciente', null, array('label' => $this->getTranslator()->trans('numeroDocIdePaciente')))
                ->add('idAreaCotizacion', 'entity', array(
                    'label' => $this->getTranslator()->trans('idAreaCotizacion'),
                    'required' => false,
                    'attr' => array('class' => 'span5 deshabilitados'),
                    'empty_value' => 'Area de Cotización..',
                    'class' => 'MinsalSiapsBundle:CtlAreaCotizante',
                    'property' => 'nombre',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('areacotizante')
                                ->where('areacotizante.id not in (12)')
                                ->orderBy('areacotizante.nombre');
                    }
                ))//ADD DEL IDAREACOTIZANTE
                ->add('asegurado')
                ->add('numeroAfiliacion', null, array('attr' => array('class' => 'span5 deshabilitados')))
                ->add('nombreMadre', null, array('required' => true, 'attr' => array('class' => 'span5 limpiar')))
                ->add('conocidoPor', null, array('attr' => array('class' => 'span5 limpiar','style' => 'width: 70%;')))
                ->add('idDepartamentoDomicilio', null, array(
                    'required' => false, 'label' => $this->getTranslator()->trans('idDepartamentoDomicilio')))
                ->add('idDocPaciente', null, array('required' => false, 'label' => $this->getTranslator()->trans('idDocPaciente')))
                ->add('idMunicipioDomicilio', null, array('required' => false, 'label' => $this->getTranslator()->trans('idMunicipioDomicilio'), 'attr' => array('class' => 'span5 deshabilitados')))
                ->add('idParentescoBeneficiarioVeterano', 'entity', array(
                    'label' => 'Parentesco del Beneficiario',
                    'required' => false,
                    'empty_value' => 'Parentesco del Beneficiario del Veterano..',
                    'class' => 'MinsalSiapsBundle:CtlParentesco',
                    'property' => 'parentesco',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('parentesco')
                                ->where('parentesco.id IN (1,2,3,8,9)');
                    }
                ))
                ->add('idTipoVeterano', null, array('label' => 'Tipo de Afiliación: '))
                ->add('telefonoCasa', null, array('label' => $this->getTranslator()->trans('telefonoCasa'), 'attr' => array('class' => 'span5 telefono')))
        ;//FIN DECLARACIÓN INICIAL DEL formMapper

        //SI NO VIENE D ELA PANTALLA DE CITAS LE AGREGA LAS SIGUIENTES VARIABLES
        if ($this->getRequest()->get('procedencia') !== 'citas') {
            $formMapper
            ->add('horaNacimiento', null, array('required' => false))
            ->add('areaGeograficaDomicilio', null, array('required' => false))
            ->add('idCantonDomicilio', null, array('required' => false, 'label' => $this->getTranslator()->trans('idCantonDomicilio'), 'attr' => array('class' => 'span5 deshabilitados')))
            ->add('direccion', null, array('required' => true, 'attr' => array('class' => 'span5 mayuscula')))
            ->add('lugarTrabajo', null, array('attr' => array('class' => 'span5 mayuscula')))
            ->add('telefonoTrabajo', null, array('label' => 'Telefono Trabajo', 'attr' => array('class' => 'span5 telefono')))
            ->add('nombrePadre', null, array('attr' => array('class' => 'span5 limpiar')))
            ->add('nombreConyuge', null, array('attr' => array('class' => 'span5 limpiar')))
            ->add('nombreResponsable', null, array('required' => true, 'attr' => array('class' => 'span5 limpiar')))
            ->add('direccionResponsable', null, array('attr' => array('class' => 'span5 mayuscula')))
            ->add('telefonoResponsable', null, array('label' => $this->getTranslator()->trans('telefonoResponsable'), 'attr' => array('class' => 'span5 telefono')))
            ->add('numeroDocIdeResponsable', null, array('label' => $this->getTranslator()->trans('numeroDocIdeResponsable')))
            ->add('nombreProporcionoDatos', null, array('required' => true, 'label' => $this->getTranslator()->trans('nombreProporcionoDatos'), 'attr' => array('class' => 'span5 limpiar')))
            ->add('numeroDocIdeProporDatos', null, array('label' => $this->getTranslator()->trans('numeroDocIdeProporDatos')))
            ->add('observacion', null, array('attr' => array('class' => 'span5 mayuscula')))
            ->add('idDocProporcionoDatos', null, array('required' => false, 'label' => $this->getTranslator()->trans('idDocProporcionoDatos')))
            ->add('idDocResponsable', null, array('required' => false, 'label' => $this->getTranslator()->trans('idDocResponsable')))
            ->add('idEstadoCivil', null, array('required' => false, 'label' => $this->getTranslator()->trans('idEstadoCivil')))
            ->add('idDepartamentoNacimiento', null, array('required' => false, 'label' => $this->getTranslator()->trans('idDepartamentoNacimiento'), 'attr' => array('class' => 'span5 deshabilitados')))
            ->add('idMunicipioNacimiento', null, array('required' => false, 'label' => $this->getTranslator()->trans('idMunicipioNacimiento'), 'attr' => array('class' => 'span5 deshabilitados')))
            ->add('idNacionalidad', null, array(
                'label' => $this->getTranslator()->trans('idNacionalidad'),
                'required' => false
            ))
            ->add('idOcupacion', null, array('required' => false, 'label' => $this->getTranslator()->trans('idOcupacion')))
            ->add('idPaisNacimiento', 'entity', array('required' => false, 'label' => $this->getTranslator()->trans('idPaisNacimiento'),
                'class' => 'MinsalSiapsBundle:CtlPais',
                'preferred_choices' => array($elSalvador)
            ))
            ->add('idParentescoResponsable', null, array('required' => false, 'label' => $this->getTranslator()->trans('idParentescoResponsable')))
            ->add('idParentescoProporDatos', null, array('required' => false, 'label' => $this->getTranslator()->trans('idParentescoProporDatos')))
            ;
        }
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalSiapsBundle:MntPacienteAdmin:list.html.twig';
                break;
            case 'edit':
                return 'MinsalSiapsBundle:MntPacienteAdmin:edit.html.twig';
                break;
            case 'view':
                return 'MinsalSiapsBundle:MntPacienteAdmin:view.html.twig';
                break;
            case 'buscaremergencia':
                return 'MinsalSiapsBundle:MntPacienteAdmin:list.html.twig';
                break;
            case 'pacientecitas':
                return 'MinsalSiapsBundle:MntPacienteAdmin:registrar_paciente_citas.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function prePersist($paciente) {
        $paciente->setPrimerNombre(chop(ltrim($paciente->getPrimerNombre())));
        $paciente->setSegundoNombre(chop(ltrim($paciente->getSegundoNombre())));
        $paciente->setTercerNombre(chop(ltrim($paciente->getTercerNombre())));
        $paciente->setPrimerApellido(chop(ltrim($paciente->getPrimerApellido())));
        $paciente->setSegundoApellido(chop(ltrim($paciente->getSegundoApellido())));
        $paciente->setApellidoCasada(chop(ltrim($paciente->getApellidoCasada())));
        $paciente->setIdGrupoDispensarial($this->getModelManager()
                        ->findOneBy('MinsalSiapsBundle:CtlGrupoDispensarial', array('id' => 1)));
        $paciente->setIdCondicionPersona($this->getModelManager()
                        ->findOneBy('MinsalSeguimientoBundle:CtlCondicionPersona', array('id' => 4)));
        $establecimiento = $this->getModelManager()
                ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
        $fecha_actual = new \DateTime();
        $paciente->setFechaRegistro($fecha_actual);
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $paciente->setIdUser($user);

        if ($this->getRequest()->get('procedencia') != 'citas'){
            if ($this->getRequest()->get('procedencia') != 'e'){
                    $expediente=new MntExpediente();
                    $expediente->setIdEstablecimiento($establecimiento);
                    $expediente->setIdPaciente($paciente);
                    $expediente->setFechaCreacion($fecha_actual);
                    $expediente->setHoraCreacion($fecha_actual);
                    $expediente->setNumeroTemporal(false);
                    $expediente->setExpedienteFisicoEliminado(false);
                    switch ($this->getForm()->get('noValido')->getData()) {
                        case 'n':
                        case 't':
                            $expediente->setCun(false);
                            switch ($establecimiento->getTipoExpediente()) {
                                case 'G':
                                    $ayuda=explode('-',$this->getForm()->get('numero')->getData()) ;
                                    $nec=(string)((int)$ayuda[0]).'-'.$ayuda[1];
                                    $expediente->setNumero($nec);
                                    break;
                                case 'I':
                                    $nec=(int) $this->getForm()->get('numero')->getData();
                                    $expediente->setNumero($nec);
                                    break;
                            }
                            break;
                        default:
                            $expediente->setNumero($this->getForm()->get('numero')->getData());
                            $expediente->setCun(true);
                            break;
                    }
                    $expediente->setIdCreacionExpediente($this->getModelManager()
                                    ->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => $this->getForm()->get('idCreacionExpediente')->getData())));
                    $this->getModelManager()->create($expediente);
                    if($this->getForm()->get('noValido')->getData()=='t'){
                        $justificacion= new MntJustificacionCumNoValido();
                        $justificacion->setIdExpediente($expediente);
                        $justificacion->setFechaHoraRegistro($fecha_actual);
                        $justificacion->setJustificacion($this->getForm()->get('justificacion')->getData());
                        $justificacion->setIdUsuarioRegistra($user);
                        $this->getModelManager()->create($justificacion);
                    }
            } else {
                $emergencia = new SecEmergencia();
                $anio = date("Y");
                $emergencia->setAnioEmergencia($anio);
                $sql = "SELECT COALESCE(MAX(CAST(numero_emergencia AS integer))+1,1) AS numero FROM sec_emergencia WHERE anio_emergencia=" . $anio;
                $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
                $con = $em->getConnection();
                $query = $con->query($sql);
                $query = $query->fetch();
                $emergencia->setNumeroEmergencia($query['numero']);
                $emergencia->setIdPaciente($paciente);
                $emergencia->setIdUsuarioRegistra($user);
                $emergencia->setFechaRegistra($fecha_actual);
                $this->getModelManager()->create($emergencia);
            }
        }
    }

    public function postPersist($paciente) {
        $this->actualizaFonetica($paciente);
        //Para ingresar el número de expediente temporal para los pacientes que piden cita teléfonica
        if ($this->getRequest()->get('procedencia') === 'citas'){
            $fecha_actual = new \DateTime();
            $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
            $establecimiento = $this->getModelManager()
                    ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));

            $expediente = new MntExpediente();
            $expediente->setNumero('T'.$paciente->getId());
            $expediente->setIdEstablecimiento($establecimiento);
            $expediente->setIdPaciente($paciente);
            $expediente->setFechaCreacion($fecha_actual);
            $expediente->setHoraCreacion($fecha_actual);
            $expediente->setNumeroTemporal(true);
            $expediente->setExpedienteFisicoEliminado(false);
            $expediente->setIdCreacionExpediente($this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => 3)));
            $this->getModelManager()->create($expediente);
        }
    }

    public function postUpdate($paciente) {
        $this->actualizaFonetica($paciente);
    }

    private function actualizaFonetica($paciente){
        $sql = "UPDATE mnt_paciente SET nombre_completo_fonetico=concat(soundexesp(primer_nombre),soundexesp(segundo_nombre),soundexesp(tercer_nombre)),
	            apellido_completo_fonetico=concat(soundexesp(primer_apellido),soundexesp(segundo_apellido),soundexesp(apellido_casada))
	            WHERE id=" . $paciente->getId();
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $con = $em->getConnection();
        $query = $con->query($sql);
        return $query->fetchAll();
    }

    public function preUpdate($paciente) {
        $establecimiento = $this->getModelManager()
                ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
        $fecha_actual = new \DateTime();
        $procedencia = $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $con = $em->getConnection();

        $query = "SELECT * FROM mnt_expediente where habilitado=true AND id_paciente=" . $paciente->getId();
        $resultado = $con->query($query);
        $expedienteBase = $resultado->fetch();

        $paciente->setIdUserMod($user);
        $paciente->setFechaMod($fecha_actual);
        $paciente->setPrimerNombre(chop(ltrim($paciente->getPrimerNombre())));
        $paciente->setSegundoNombre(chop(ltrim($paciente->getSegundoNombre())));
        $paciente->setTercerNombre(chop(ltrim($paciente->getTercerNombre())));
        $paciente->setPrimerApellido(chop(ltrim($paciente->getPrimerApellido())));
        $paciente->setSegundoApellido(chop(ltrim($paciente->getSegundoApellido())));
        $paciente->setApellidoCasada(chop(ltrim($paciente->getApellidoCasada())));


        $query = "SELECT * FROM mnt_paciente where id=" . $paciente->getId();
        $resultado = $con->query($query);
        $pacienteBase = $resultado->fetch();
        $auditoria = new MntAuditoriaPaciente();
        $cambio = false;
        $procedencia = $this->getRequest()->get('procedencia');
        if (!$expedienteBase) {
            //CUANDO NO EXISTE PORQUE EL PACIENTE VIENE DE LA EMERGENCIA Y SE
            //HA ACTUALIZADO Y VIENE DE LA CONSULTA
            if ($procedencia != 'e') {
                $expediente=new MntExpediente();
                $expediente->setIdEstablecimiento($establecimiento);
                $expediente->setIdPaciente($paciente);
                $expediente->setFechaCreacion($fecha_actual);
                $expediente->setHoraCreacion($fecha_actual);
                $expediente->setNumeroTemporal(false);
                $expediente->setExpedienteFisicoEliminado(false);
                switch ($this->getForm()->get('noValido')->getData()) {
                    case 'n':
                    case 't':
                        $expediente->setCun(false);
                        switch ($establecimiento->getTipoExpediente()) {
                            case 'G':
                                $ayuda=explode('-',$this->getForm()->get('numero')->getData()) ;
                                $nec=(string)((int)$ayuda[0]).'-'.$ayuda[1];
                                $expediente->setNumero($nec);

                                break;
                            case 'I':
                                $nec=(int) $this->getForm()->get('numero')->getData();
                                $expediente->setNumero($nec);

                                break;
                        }
                        break;
                    default:
                        $expediente->setNumero($this->getForm()->get('numero')->getData());
                        $expediente->setCun(true);
                        break;
                }
                $expediente->setIdCreacionExpediente($this->getModelManager()
                                ->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => $this->getForm()->get('idCreacionExpediente')->getData())));
                $this->getModelManager()->create($expediente);
                if($this->getForm()->get('noValido')->getData()=='t'){
                    $justificacion= new MntJustificacionCumNoValido();
                    $justificacion->setIdExpediente($expediente);
                    $justificacion->setFechaHoraRegistro($fecha_actual);
                    $justificacion->setJustificacion($this->getForm()->get('justificacion')->getData());
                    $justificacion->setIdUsuarioRegistra($user);
                    $this->getModelManager()->create($justificacion);
                }
            }
        } else {
                if ($procedencia != 'e') {
                    $expediente=$em->getRepository('MinsalSiapsBundle:MntExpediente')->find($expedienteBase['id']);
                    $expediente->setNumeroTemporal(false);
                    $expediente->setExpedienteFisicoEliminado(false);
                    switch ($this->getForm()->get('noValido')->getData()) {
                        case 'n':
                        case 't':
                            $expediente->setCun(false);
                            switch ($establecimiento->getTipoExpediente()) {
                                case 'G':
                                    $ayuda=explode('-',$this->getForm()->get('numero')->getData()) ;
                                    $nec=(string)((int)$ayuda[0]).'-'.$ayuda[1];
                                    $expediente->setNumero($nec);

                                    break;
                                case 'I':
                                    $nec=(int) $this->getForm()->get('numero')->getData();
                                    $expediente->setNumero($nec);
                                    break;
                            }
                            break;
                        default:
                            $expediente->setNumero($this->getForm()->get('numero')->getData());
                            $expediente->setCun(true);
                            break;
                    }
                    $expediente->setIdCreacionExpediente($this->getModelManager()
                                    ->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => $this->getForm()->get('idCreacionExpediente')->getData())));
                    $this->getModelManager()->update($expediente);
                    if ($this->getForm()->get('numero')->getData() != $expedienteBase['numero']) {
                        $auditoria->setNumeroExpediente($expedienteBase['numero']);
                        $cambio = TRUE;
                    }
                }

        }
        if ($paciente->getPrimerNombre() != $pacienteBase['primer_nombre']) {
            $auditoria->setPrimerNombre($pacienteBase['primer_nombre']);
            $cambio = TRUE;
        }
        if ($paciente->getSegundoNombre() != $pacienteBase['segundo_nombre']) {
            $auditoria->setSegundoNombre($pacienteBase['segundo_nombre']);
            $cambio = TRUE;
        }
        if ($paciente->getTercerNombre() != $pacienteBase['tercer_nombre']) {
            $auditoria->setTercerNombre($pacienteBase['tercer_nombre']);
            $cambio = TRUE;
        }
        if ($paciente->getPrimerApellido() != $pacienteBase['primer_apellido']) {
            $auditoria->setPrimerApellido($pacienteBase['primer_apellido']);
            $cambio = TRUE;
        }
        if ($paciente->getSegundoApellido() != $pacienteBase['segundo_apellido']) {
            $auditoria->setSegundoApellido($pacienteBase['segundo_apellido']);
            $cambio = TRUE;
        }
        if ($paciente->getApellidoCasada() != $pacienteBase['apellido_casada']) {
            $auditoria->setApellidoCasada($pacienteBase['apellido_casada']);
            $cambio = TRUE;
        }
        if ($paciente->getNombrePadre() != $pacienteBase['nombre_padre']) {
            $auditoria->setNombrePadre($pacienteBase['nombre_padre']);
            $cambio = TRUE;
        }
        if ($paciente->getNombreMadre() != $pacienteBase['nombre_madre']) {
            $auditoria->setNombreMadre($pacienteBase['nombre_madre']);
            $cambio = TRUE;
        }
        if ($paciente->getNombreResponsable() != $pacienteBase['nombre_responsable']) {
            $auditoria->setNombreResponsable($pacienteBase['nombre_responsable']);
            $cambio = TRUE;
        }
        if ($paciente->getObservacion() != $pacienteBase['observacion']) {
            $auditoria->setObservacion($pacienteBase['observacion']);
            $cambio = TRUE;
        }
        if ($paciente->getDireccion() != $pacienteBase['direccion']) {
            $auditoria->setDireccion($pacienteBase['direccion']);
            $cambio = TRUE;
        }
        if (!is_null($paciente->getIdDepartamentoDomicilio())) {
            if ($paciente->getIdDepartamentoDomicilio()->getId() != $pacienteBase['id_departamento_domicilio']) {
                if (!is_null($pacienteBase['id_departamento_domicilio'])) {
                    $departamento = $this->getModelManager()->find('MinsalSiapsBundle:CtlDepartamento', $pacienteBase['id_departamento_domicilio']);
                    $auditoria->setIdDepartamentoDomicilio($departamento);
                    $cambio = TRUE;
                }
            }
        }
        if (!is_null($paciente->getIdMunicipioDomicilio())) {
            if ($paciente->getIdMunicipioDomicilio()->getId() != $pacienteBase['id_municipio_domicilio']) {
                if (!is_null($pacienteBase['id_municipio_domicilio'])) {
                    $municipio = $this->getModelManager()->find('MinsalSiapsBundle:CtlMunicipio', $pacienteBase['id_municipio_domicilio']);
                    $auditoria->setIdMunicipioDomicilio($municipio);
                    $cambio = TRUE;
                }
            }
        }
        if (($paciente->getIdCantonDomicilio()) != NULL) {
            if ($paciente->getIdCantonDomicilio()->getId() != $pacienteBase['id_canton_domicilio']) {
                if (!is_null($pacienteBase['id_canton_domicilio'])) {
                    $canton = $this->getModelManager()->find('MinsalSiapsBundle:CtlCanton', $pacienteBase['id_canton_domicilio']);
                    $auditoria->setIdCantonDomicilio($canton);
                    $cambio = TRUE;
                }
            }
        }

        if ($paciente->getAreaGeograficaDomicilio()->getId() != $pacienteBase['area_geografica_domicilio']) {
            if (!is_null($pacienteBase['area_geografica_domicilio'])) {
                $areaGeografica = $this->getModelManager()->find('MinsalSiapsBundle:CtlAreaGeografica', $pacienteBase['area_geografica_domicilio']);
                $auditoria->setAreaGeograficaDomicilio($areaGeografica);
                $cambio = TRUE;
            }
        }
        if ($paciente->getIdSexo()->getId() != $pacienteBase['id_sexo']) {
            if (!is_null($pacienteBase['id_sexo'])) {
                $sexo = $this->getModelManager()->find('MinsalSiapsBundle:CtlSexo', $pacienteBase['id_sexo']);
                $auditoria->setIdSexo($sexo);
                $cambio = TRUE;
            }
        }
//Para verificar si la fecha o la hora de nacimiento ha cambiado las convertimos en una marca de tiempo
        $fecha_form = $paciente->getFechaNacimiento();
        foreach ($fecha_form as $valor) {
            $datos[] = $valor;
        }
        if (strtotime($datos[0]) != strtotime($pacienteBase['fecha_nacimiento'])) {
            $auditoria->setFechaNacimiento(new \DateTime($pacienteBase['fecha_nacimiento']));
            $cambio = TRUE;
        }
        if ($paciente->getHoraNacimiento() != NULL) {
            $hora_form = $paciente->getHoraNacimiento();
            foreach ($hora_form as $valor_hora) {
                $datos_hora[] = $valor_hora;
            }
            $hora = explode(' ', $datos_hora[0]);
            if ($pacienteBase['hora_nacimiento'] != null) {
                if (strtotime($hora[1]) != strtotime($pacienteBase['hora_nacimiento'])) {
                    $auditoria->setHoraNacimiento($pacienteBase['hora_nacimiento']);
                    $cambio = TRUE;
                }
            } else {
                $auditoria->setHoraNacimiento($pacienteBase['hora_nacimiento']);
                $cambio = TRUE;
            }
        }
        //si alguno de los valores ha cambiado se guarda en la tabla auditoría paciente
        if ($cambio == TRUE) {
            $establecimiento = $this->getModelManager()
                    ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
            $auditoria->setIdEstablecimiento($establecimiento);
            $auditoria->setFechaModificacion($fecha_actual);
            $auditoria->setIdUser($user);
            $auditoria->setIdPaciente($paciente);
            $this->getModelManager()->create($auditoria);
        }
    }

    public function validate(ErrorElement $errorElement, $paciente) {
        /* ESTA VALIDACIÓN SE REALIZARA SOLO CUANDO EL PACIENTE VENGA POR ARCHIVO NO DE EMERGENCIA */
        $fechaActual=new \DateTime();
        if ($this->getRequest()->get('procedencia') != 'e' and $this->getRequest()->get('procedencia') != 'citas') {
                $establecimiento = $this->getModelManager()
                        ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
                $formatoExpediente = $establecimiento->getTipoExpediente();
                //VERIFICAR EL TIPO DE EXPEDIENTE CONFIGURADO
                $fechaValidacion=new \DateTime('01-01-2017');
                $noValido=$this->getForm()->get('noValido')->getData();

                if($paciente->getFechaNacimiento()<$fechaValidacion || ($paciente->getFechaNacimiento()>=$fechaValidacion && $noValido=='t')){
                    switch ($formatoExpediente) {
                        case 'G':
                            if (preg_match('/^\d{1,}-\d{2}$/', $this->getForm()->get('numero')->getData()) == 0) {
                                $errorElement->with('error')
                                        ->addViolation('El formato del número de expediente es incorrecto o contiene letras')
                                        ->end();
                            } else {
                                list($entero, $anio) = explode('-', $this->getForm()->get('numero')->getData());
                                $entero = (int) $entero;
                                if ($entero == 0)
                                    $errorElement->with('error')
                                            ->addViolation('El numero de expediente no puede ser 0')
                                            ->end();
                                else
                                    $numero=(string) $entero . '-' . $anio;
                            }
                        break;
                        default:
                            if (preg_match('/^\d{1,}$/', $this->getForm()->get('numero')->getData()) == 0) {
                                $errorElement->with('error')
                                        ->addViolation('El formato del número de expediente es incorrecto o contiene letras')
                                        ->end();
                            } else {
                                $numero = (int) $this->getForm()->get('numero')->getData();
                                if ($numero == 0)
                                    $errorElement->with('error')
                                            ->addViolation('El numero de expediente no puede ser 0')
                                            ->end();
                                else
                                    $numero=(string) $numero;
                            }
                        break;
                    }
                }else{
                    $numero=$this->getForm()->get('numero')->getData();
                    if(strlen($numero)<12){
                        $errorElement->with('error')
                                ->addViolation('El Código Único del Nacimiento no es un número valido, favor digitelo nuevamente')
                                ->end();
                    }else{
                        if($paciente->getFechaNacimiento()->format('dmY')<>substr(trim($numero), 0, 8)){
                            $errorElement->with('error')
                                    ->addViolation('El Código Único del Nacimiento no es un número valido. Porque no coinciden los primeros 8 numeros con la fecha de nacimiento')
                                    ->end();

                        }else{
                            $valoresNumero=substr(trim($numero), 0, -1);
                            $codigoFinal='0'.$valoresNumero;
                            $codigoFinalArreglo=str_split($codigoFinal);
                            $par = array();
                            $impar = array();
                            foreach ($codigoFinalArreglo as $key => $valor) {
                                if ($key % 2 == 0) {
                                      $par[] = $valor;
                                } else {
                                      $impar[] = $valor;
                                }
                            }
                            $calculo_impar=array_sum($impar)*3;
                            $calculo_par=array_sum($par);
                            $suma=$calculo_impar+$calculo_par;
                            $decena_superior=(ceil($suma/10))*10;
                            $verificador=$decena_superior-$suma;
                            $verificadorCodigoUnico = substr(trim($numero), -1);
                            if ($verificador<>$verificadorCodigoUnico) {
                                $errorElement->with('error')
                                        ->addViolation('El Código Único del Nacimiento no es un número valido, favor digitelo nuevamente')
                                        ->end();
                            }
                        }
                    }
                }

                if (is_null($paciente->getId())) {
                    $dql = "SELECT count(e) as resul
                      FROM MinsalSiapsBundle:MntExpediente e
                      JOIN e.idPaciente p
                      WHERE e.numero LIKE :variable";
                            $repuesta = $this->getModelManager()
                                    ->getEntityManager('MinsalSiapsBundle:MntExpediente')
                                    ->createQuery($dql)
                                    ->setParameter('variable', $numero)
                                    ->getArrayResult();
                } else {
                    $dql = "SELECT count(e) as resul
                      FROM MinsalSiapsBundle:MntExpediente e
                      JOIN e.idPaciente p
                      WHERE e.numero LIKE :variable AND p.id != :paciente";
                            $repuesta = $this->getModelManager()
                                    ->getEntityManager('MinsalSiapsBundle:MntExpediente')
                                    ->createQuery($dql)
                                    ->setParameter('variable', $numero)
                                    ->setParameter('paciente', $paciente->getId())
                                    ->getArrayResult();
                }

                if ($repuesta[0]['resul'] == 1) {
                    $errorElement->with('error')
                            ->addViolation('Este expediente ya existe digite otro')
                            ->end();
                }
        }
        /* VALIDACIÓN DE QUE EL PACIENTE NO EXISTA */
        if (is_null($paciente->getId())) {
            $dql = "SELECT count(p) as resul
                  FROM MinsalSiapsBundle:MntPaciente p
                  WHERE p.primerNombre = :primer_nombre AND p.segundoNombre = :segundo_nombre AND
                        p.primerApellido = :primer_apellido AND p.segundoApellido = :segundo_apellido AND
                        p.fechaNacimiento = :fecha_nacimiento";
            $repuesta = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntPaciente')
                    ->createQuery($dql)
                    ->setParameters(array(
                        'primer_nombre' => (chop(ltrim($paciente->getPrimerNombre()))),
                        'segundo_nombre' => (chop(ltrim($paciente->getSegundoNombre()))),
                        'primer_apellido' => (chop(ltrim($paciente->getPrimerApellido()))),
                        'segundo_apellido' => (chop(ltrim($paciente->getSegundoApellido()))),
                        'fecha_nacimiento' => $paciente->getFechaNacimiento()
                    ))
                    ->getArrayResult();
            if ($repuesta[0]['resul'] == 1)
                $errorElement->with('error')
                        ->addViolation('Ya existe esta persona, debe buscarla para saber su número de expediente')
                        ->end();
        }
        //Verificando los formatos de acuerdo el documento seleccionado
        if ($paciente->getIdDocPaciente() == 'DUI') {
            $numero_doc = $paciente->getNumeroDocIdePaciente();
            if (preg_match('/[0-9]{8}-[0-9]{1}/', $numero_doc) == 0) {
                $errorElement->with('error')
                        ->addViolation('El formato del número de DUI es incorrecto')
                        ->end();
            }
            $dql = "SELECT count(p) as resul
                    FROM MinsalSiapsBundle:MntPaciente p
                        JOIN p.idDocPaciente tp
                    WHERE tp.id=1 AND p.numeroDocIdePaciente='" . $numero_doc . "'";
            if (!is_null($paciente->getId())) {
                $dql = $dql . ' AND p.id <> ' . $paciente->getId();
            }
            $repuesta = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntPaciente')
                    ->createQuery($dql)
                    ->getArrayResult();
            if ($repuesta[0]['resul'] > 0) {
                $errorElement->with('error')
                        ->addViolation('Este número de dui ya fue digitado para otro paciente')
                        ->end();
            }
        } elseif ($paciente->getIdDocPaciente() == 'NIT') {
            $numero_doc = $paciente->getNumeroDocIdePaciente();
            if (preg_match('/[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}/', $numero_doc) == 0) {
                $errorElement->with('error')
                        ->addViolation('El formato del número de NIT es incorrecto')
                        ->end();
            }
            $dql = "SELECT count(p) as resul
                    FROM MinsalSiapsBundle:MntPaciente p
                        JOIN p.idDocPaciente tp
                    WHERE tp.id=10 AND p.numeroDocIdePaciente='" . $numero_doc . "'";
            if (!is_null($paciente->getId())) {
                $dql = $dql . ' AND p.id <> ' . $paciente->getId();
            }
            $repuesta = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntPaciente')
                    ->createQuery($dql)
                    ->getArrayResult();
            if ($repuesta[0]['resul'] > 0) {
                $errorElement->with('error')
                        ->addViolation('Este número de NIT ya fue digitado')
                        ->end();
            }
        } else if ($paciente->getIdDocPaciente() == 'Carné ISSS') {
                $numero_doc = $paciente->getNumeroDocIdePaciente();
                if (preg_match('/[0-9]{9}/', $numero_doc) == 0) {
                    $errorElement->with('error')
                            ->addViolation('El formato del número de documento es incorrecto')
                            ->end();
                }
                $dql = "SELECT count(p) as resul
                    FROM MinsalSiapsBundle:MntPaciente p
                        JOIN p.idDocPaciente tp
                    WHERE tp.id=3 AND p.numeroDocIdePaciente='" . $numero_doc . "'";
                if (!is_null($paciente->getId())) {
                    $dql = $dql . ' AND p.id <> ' . $paciente->getId();
                }
                $repuesta = $this->getModelManager()
                        ->getEntityManager('MinsalSiapsBundle:MntPaciente')
                        ->createQuery($dql)
                        ->getArrayResult();
                if ($repuesta[0]['resul'] > 0) {
                    $errorElement->with('error')
                            ->addViolation('Este número de CARNET DEL ISSS ya fue digitado')
                            ->end();
                }
        }

            //Validando número de documento para el responsable
        if( $this->getRequest()->get('procedencia') !== 'citas'){
            if ($paciente->getIdDocResponsable() == 'DUI') {
                $numero_doc = $paciente->getNumeroDocIdeResponsable();
                if (preg_match('/[0-9]{8}-[0-9]{1}/', $numero_doc) == 0) {
                    $errorElement->with('error')
                            ->addViolation('El formato del número de DUI es incorrecto')
                            ->end();
                }
            } elseif ($paciente->getIdDocResponsable() == 'NIT') {
                $numero_doc = $paciente->getNumeroDocIdeResponsable();
                if (preg_match('/[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}/', $numero_doc) == 0) {
                    $errorElement->with('error')
                            ->addViolation('El formato del número de NIT es incorrecto')
                            ->end();
                }
            } elseif($paciente->getIdDocResponsable() == 'Carné ISSS') {
                    $numero_doc = $paciente->getNumeroDocIdeResponsable();
                    if (preg_match('/[0-9]{9}/', $numero_doc) == 0) {
                        $errorElement->with('error')
                                ->addViolation('El formato del número de documento es incorrecto')
                                ->end();
                    }
            }
            //Validando número de documento para la persona que proporcionó datos
            if ($paciente->getIdDocProporcionoDatos() == 'DUI') {
                $numero_doc = $paciente->getNumeroDocIdeProporDatos();
                if (preg_match('/[0-9]{8}-[0-9]{1}/', $numero_doc) == 0) {
                    $errorElement->with('error')
                            ->addViolation('El formato del número de DUI es incorrecto')
                            ->end();
                }
            } elseif ($paciente->getIdDocProporcionoDatos() == 'NIT') {
                $numero_doc = $paciente->getNumeroDocIdeProporDatos();
                if (preg_match('/[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}/', $numero_doc) == 0) {
                    $errorElement->with('error')
                            ->addViolation('El formato del número de NIT es incorrecto')
                            ->end();
                }
            } elseif ($paciente->getIdDocProporcionoDatos() == 'Carné ISSS') {
                    $numero_doc = $paciente->getNumeroDocIdeProporDatos();
                    if (preg_match('/[0-9]{9}/', $numero_doc) == 0) {
                        $errorElement->with('error')
                                ->addViolation('El formato del número de documento es incorrecto')
                                ->end();
                    }
            }

            if (is_null($paciente->getIdDocResponsable()))
                $errorElement->with('idDocResponsable')
                        ->addViolation('Debe de seleccionar el tipo de documento del responsable')
                        ->end();
            if (is_null($paciente->getIdDocProporcionoDatos()))
                $errorElement->with('idDocProporcionoDatos')
                        ->addViolation('Debe de seleccionar el tipo de documento de la persona que proporcionó datos')
                        ->end();
            if (is_null($paciente->getIdParentescoProporDatos()))
                $errorElement->with('idParentescoProporDatos')
                        ->addViolation('Debe de seleccionar el parentesco del que proporcionó datos')
                        ->end();
            if (is_null($paciente->getIdParentescoResponsable()))
                $errorElement->with('idParentescoResponsable')
                        ->addViolation('Debe de seleccionar el parentesco del responsable')
                        ->end();
            if (is_null($paciente->getAreaGeograficaDomicilio()))
                $errorElement->with('areaGeograficaDomicilio')
                        ->addViolation('Debe de seleccionar el área geografica del domicilio')
                        ->end();
            if (is_null($paciente->getIdNacionalidad()))
                $errorElement->with('idNacionalidad')
                        ->addViolation('Debe de seleccionar la nacionalidad del paciente')
                        ->end();

        }
        //VALIDACIÓN DE QUE EL SEXO EXISTA
        if (is_null($paciente->getIdSexo())) {
            $errorElement->with('idSexo')
                    ->addViolation('El Sexo es obligatorio')
                    ->end();
        } else {
            $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
            $conn = $em->getConnection();
            $calcular = new Funciones();
            if ($paciente->getHoraNacimiento())
                $edad = $calcular->calcularEdad($conn, $paciente->getFechaNacimiento()->format('d/m/Y'), $paciente->getHoraNacimiento()->format('H:i'));
            else
                $edad = $calcular->calcularEdad($conn, $paciente->getFechaNacimiento()->format('d/m/Y'));
            $aux = explode(' ', $edad);
            if (count($aux) > 1) {
                if (strstr($aux[1], 'año')) {
                    if ($paciente->getIdSexo()->getId() == 3) {
                        $errorElement->with('idSexo')
                                ->addViolation('No se puede elegir el sexo indeterminado para alguien mayor de 6 meses')
                                ->end();
                    }
                } elseif (strstr($aux[1], 'meses')) {
                    if ($aux[0] > 6) {
                        if ($paciente->getIdSexo()->getId() == 3) {
                            $errorElement->with('idSexo')
                                    ->addViolation('No se puede elegir el sexo indeterminado para alguien mayor de 6 meses')
                                    ->end();
                        }
                    }
                }
            } else {
                if (is_null($paciente->getHoraNacimiento())) {
                    $errorElement->with('horaNacimiento')
                            ->addViolation('Debe de elegir una hora para la persona si es que ha nacido el día de hoy')
                            ->end();
                }
            }
        }

        if (is_null($paciente->getPrimerNombre())) {
            $errorElement->with('primerNombre')
                    ->addViolation('El Primer nombre es obligatorio')
                    ->end();
        }

        if (is_null($paciente->getPrimerApellido())) {
            $errorElement->with('primerApellido')
                    ->addViolation('El Primer Apellido es Obligatorio')
                    ->end();
        }
        if (is_null($paciente->getPrimerApellido())) {
            $errorElement->with('primerApellido')
                    ->addViolation('El Primer Apellido es Obligatorio')
                    ->end();
        }
        if (is_null($paciente->getIdDocPaciente()))
            $errorElement->with('idDocPaciente')
                    ->addViolation('Debe de seleccionar el tipo de documento del paciente')
                    ->end();
        if ($paciente->getFechaNacimiento()>$fechaActual)
        $errorElement->with('error')
                ->addViolation('La fecha de nacimiento debe ser menor a la fecha actual')
                ->end();

    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('view', $this->getRouterIdParameter() . '/view');
        $collection->add('buscaremergencia', 'consulta/emergencia');
        $collection->add('pacientecitas', 'paciente/citas');
        // $collection->remove('delete');
    }

//PARA LIMITAR EL NUMERO DE EXPEDIENTES A AGREGAR LA PRIMERA VEZ
    public function getFormTheme() {
        return array_merge(
                parent::getFormTheme(), array('MinsalSiapsBundle:Form:form_admin_fields.html.twig')
        );
    }

}

?>
