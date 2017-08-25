<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Minsal\SiapsBundle\Form\DataTransformer\DateTimeToStringTransformer;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;



class MntRangohoraAdmin extends Admin
{
    // Variables Globales para envio de parametros al Twig si no se ha Customizado el Controlador
    public $parameters = array();
    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'horaIni' // name of the ordered field (default = the model id field, if any)
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $user        = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $currentTime = new \DateTime();

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $datagridMapper
                ->add('idEstablecimiento', null, array('label'=>'Establecimiento') )
                ->add('idModulo', null, array('label'=>'Módulo') )
            ;
        }

        $datagridMapper
            ->add('horaIni', null,
                array(
                    'label' => 'Hora Inicial'
                ),
                null,
                array(
                    'attr'  => array(
                        'data-clockpicker-enabled'   => 'true',
                        'data-clockpicker-placement' => 'top',
                        'data-mask'                  => '99:99aa',
                        'placeholder'                => $currentTime->format('h:iA')
                    )
                )
            )
            ->add('horaFin', null,
                array(
                    'label' => 'Hora Final'
                ),
                null,
                array(
                    'attr'  => array(
                        'data-clockpicker-enabled'   => 'true',
                        'data-clockpicker-placement' => 'top',
                        'data-mask'                  => '99:99aa',
                        'placeholder'                => $currentTime->format('h:iA')
                    )
                )
            )
            ->add('activo',null,array('label'=>'Habilitado') )
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $session       = $this->getConfigurationPool()->getContainer()->get('session');

        if($session->getFlashBag()->has('sonata_flash_warning')){
            $tmpBag=$session->getFlashBag()->get('sonata_flash_warning');
        }

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $listMapper
                ->add('idEstablecimiento.nombre', null, array('label'=>'Establecimiento') )
                ->add('idModulo.nombre', null, array('label'=>'Módulo') )
            ;
        }

        $listMapper
            ->add('formatterHoraIni',null,array('label'=>'Hora Inicial') )
            ->add('formatterHoraFin',null,array('label'=>'Hora Final') )
            ->add('activo',null,array('label'=>'Habilitado') )
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $action        = $this->getSubject()->getId() ? 'edit' : 'create';
        $em            = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $user          = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $session       = $this->getConfigurationPool()->getContainer()->get('session');
        $sessionModulo = $session->get('_moduleSelection');
        $CtlModulo     = $em->getRepository('MinsalSiapsBundle:CtlModulo')->findOneBy(array('ordenMenuSiap'=>$sessionModulo));
        $currentTime   = new \DateTime();
        $object        = $this->getSubject();
        $disabled      = false;
        $distribucionM = false;
        $distribucionP = false;
        $transformer   = new DateTimeToStringTransformer($em,'h:iA');

        $activoOptions = array(
            'label'    => 'Habilitado',
            'required' => false,
            'attr'     => array(
                'data-switch-enabled' => "true"
            )
        );

        if($action === 'edit') {
            $codModulo = $object->getIdModulo()->getCodModulo();

            if($codModulo === 'CIT') {
                $dql = "SELECT t01.id
                        FROM MinsalCitasBundle:CitDistribucion t01
                        WHERE t01.idRangohora = :idRangohora";

                $result = $em->createQuery($dql)
        	    			   ->setParameter(':idRangohora',$object->getId())
        	    			   ->getArrayResult();

                if($result) {
                    $disabled      = true;
                    $distribucionM = true;
                } else {
                    $dql = "SELECT t02.id
                            FROM MinsalCitasBundle:CitDistribucionProcedimiento t02
                            WHERE t02.idRangohora = :idRangohora";

            	    $result = $em->createQuery($dql)
            	    			   ->setParameter(':idRangohora',$object->getId())
            	    			   ->getArrayResult();

                    if($result) {
                        $disabled      = true;
                        $distribucionP = true;
                    }
                }
            }

            if($disabled) {
                $msjComplement  = $distribucionM ? ' Distribución Médica' : '';
                $msjComplement .= $distribucionP ? ' Distribución de Procedimiento' : '';
                $session->getFlashBag()->add('sonata_flash_warning', 'El rango hora seleccionado no puede ser editado debido a que ya esta siendo utilizado en una'.$msjComplement);
            }

        } else {
            $activoOptions['data'] = true;
        }

        // Envio de parametros del admin a la vista si no se ha customizado el Controlador.
        $this->parameters = array('actionDisabled' => $disabled);

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $formMapper
                ->add('idEstablecimiento', null,
                    array(
                        'label'         => 'Establecimiento',
                        'class'         => 'MinsalSiapsBundle:CtlEstablecimiento',
                        'property'      => 'nombre',
                        'required'      => true,
                        'disabled'      => $disabled,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('t01')
                                      ->orderBy('t01.nombre')
                            ;
                        }
                    )
                )
                ->add('idModulo', null,
                    array(
                        'label'         => 'Módulo',
                        'class'         => 'MinsalSiapsBundle:CtlModulo',
                        'property'      => 'nombre',
                        'required'      => true,
                        'disabled'      => $disabled,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('t01')
                                      ->orderBy('t01.nombre')
                            ;
                        }
                    )
                )
            ;
        }

        $formMapper
            ->add(
                $formMapper->getFormBuilder()->create(
                    'horaIni','text',
                    array(
                        'label'    => 'Hora Inicial',
                        'required' => true,
                        'disabled' => $disabled,
                        'attr'     => array(
                            'data-clockpicker-enabled'   => 'true',
                            'data-clockpicker-placement' => 'top',
                            'data-mask'                  => '99:99aa',
                            'placeholder'                => $currentTime->format('h:iA')
                        )
                    )
                )
                ->addModelTransformer($transformer)
            )
            ->add(
                $formMapper->getFormBuilder()->create(
                    'horaFin','text',
                    array(
                        'label'    => 'Hora Final',
                        'required' => true,
                        'disabled' => $disabled,
                        'attr'     => array(
                            'data-clockpicker-enabled'   => 'true',
                            'data-clockpicker-placement' => 'top',
                            'data-mask'                  => '99:99aa',
                            'placeholder'                => $currentTime->format('h:iA')
                        )
                    )
                )
                ->addModelTransformer($transformer)
            )
            ->add('activo',null,$activoOptions)
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $currentTime = new \DateTime();

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $showMapper
                ->add('idEstablecimiento.nombre', null, array('label'=>'Establecimiento') )
                ->add('idModulo.nombre', null, array('label'=>'Módulo') )
            ;
        }

        $showMapper
            ->add('formatterHoraIni',null,array('label'=>'Hora Inicial'))
            ->add('formatterHoraFin',null,array('label'=>'Hora Final'))
            ->add('activo',null,array('label'=>'Habilitado'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object) {
        $action             = $object->getId() ? 'edit' : 'create';
        $em                 = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $user               = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $session            = $this->getConfigurationPool()->getContainer()->get('session');
        $superAdmin         = $user->hasRole('ROLE_SUPER_ADMIN');
        $currentDateTime    = new \DateTime();
        $horaInicial        = $object->getHoraIni();
        $horaFinal          = $object->getHoraFin();
        //LE DEJAMOS QUE POR DEFECTO LE SETEE EL MODULO DE CITAS PORQUE HAY PROBLEMAS DEPENDIENDO DEL MODULO QUE INICIO SESION
        //$sessionModulo      = $session->get('_moduleSelection');
        $sessionModulo      =  2;
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        $timeInterval         = $horaInicial->diff($horaFinal);
        $hoursInterval        = $timeInterval->h;
        $minutesInterval      = $timeInterval->i;
        $totalMinutesInterval = ($hoursInterval * 60) + $minutesInterval;

        if($horaInicial > $horaFinal) {
            $errorElement
			    ->with('horaIni')
			        ->addViolation('La hora inicial no puede ser mayor a la hora final')
			    ->end()
            ;
        } else {
            if($totalMinutesInterval === 0) {
                $errorElement
                    ->with('horaFin')
                        ->addViolation('El horario final no puede ser igual al horario inicial')
                    ->end()
                ;
            } else {
                if($totalMinutesInterval < 30) {
                    $errorElement
        			    ->with('error')
        			        ->addViolation('El tiempo entre horarios no puede ser menor a 30 minutos')
        			    ->end()
                    ;
                } else {
                    if($superAdmin === false) {
                        if($totalMinutesInterval > 180) {
                            $errorElement
                			    ->with('error')
                			        ->addViolation('El tiempo entre horarios no puede ser mayor a 3 horas')
                			    ->end()
                            ;
                        }
                    }
                }
            }
        }

        if($superAdmin) {
            $idEstablecimiento = $object->getIdEstablecimiento();
            $idModulo          = $object->getIdModulo();
        } else {
            $idEstablecimiento = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento() : $CtlEstablecimiento ) : $CtlEstablecimiento );
            $idModulo          = $em->getRepository('MinsalSiapsBundle:CtlModulo')->findOneBy(array('ordenMenuSiap'=>$sessionModulo));

            if(!$idModulo) {
                throw new \Exception('Error no existe el id '.$sessionModulo.' en la columna ordenMenuSiap de la Entidad CtlModulo');
            }
        }

        $dql = 'SELECT p
                FROM MinsalSiapsBundle:MntRangohora p
                WHERE p.idEstablecimiento = :idEstablecimiento
                    AND p.idModulo = :idModulo
                    AND p.horaIni  = :horaIni
                    AND p.horaFin  = :horaFin ';

        if($action === 'edit') {
            $dql .= 'AND p.id != :id';
        }

        $query = $em->createQuery($dql)
                     ->setParameter('idEstablecimiento', $idEstablecimiento->getId())
                     ->setParameter('idModulo', $idModulo->getId())
                     ->setParameter('horaIni', $horaInicial->format('h:i:s A'))
                     ->setParameter('horaFin', $horaFinal->format('h:i:s A'));

        if($action === 'edit') {
            $query->setParameter('id', $object->getId());
        }

        $result = $query->getResult();

        if ($result) {
            $msjError = 'El rango de hora: "'.$horaInicial->format('h:i:s A').' - '.$horaFinal->format('h:i:s A').'" ya se encuentra registrado,';

            if($superAdmin) {
                $msjError .= ' para el Establecimiento seleccionado,';
            }

            $msjError .= ' por favor seleccione otro rango de hora.';

            $errorElement
                ->with('error')
                    ->addViolation($msjError)
                ->end()
            ;
        }
    }

    public function prePersist($object) {
        $em              = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $user            = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $superAdmin      = $user->hasRole('ROLE_SUPER_ADMIN');
        $session         = $this->getConfigurationPool()->getContainer()->get('session');
        $currentDateTime = new \DateTime();

        $object->setIdusuarioreg($user);
        $object->setFechahorareg($currentDateTime);

        if($superAdmin === false) {
            //$sessionModulo      = $session->get('_moduleSelection');
            $sessionModulo      = 2;
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $CtlModulo          = $em->getRepository('MinsalSiapsBundle:CtlModulo')->findOneBy(array('ordenMenuSiap'=>$sessionModulo));

            if(!$CtlModulo) {
                throw new \Exception('Error no existe el id '.$sessionModulo.' en la columna ordenMenuSiap de la Entidad CtlModulo');
            }

            $object->setIdEstablecimiento($CtlEstablecimiento);
            $object->setIdModulo($CtlModulo);
        }
    }

    public function getTemplate($name) {
		switch ($name) {
			case 'list':
				return 'MinsalSiapsBundle:CRUD:MntRangohora/list.html.twig';
				break;
			case 'edit':
				return 'MinsalSiapsBundle:CRUD:MntRangohora/edit.html.twig';
				break;
			default:
				return parent::getTemplate($name);
				break;
		}
	}

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('delete');
    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        $user            = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        if(!$user->hasRole('ROLE_SUPER_ADMIN')){
            return new ProxyQuery(
                    $query
                            ->where($query->getRootAlias() . '.idModulo IN (4)')
            );
        }else {
            return $query;
        }
    }


}
