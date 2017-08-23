<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Doctrine\ORM\EntityRepository;
use Minsal\SiapsBundle\Entity\MntEmpleadoEspecialidadEstab as EmpleadoEstablecimiento;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Minsal\Metodos\Funciones as Funciones;

class MntEmpleadoAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'configurado' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('nombreempleado', null, array('label' => 'Nombre del Médico'))
                ->add('nombreEmpleado',
                        'doctrine_orm_callback',array(
                            'label'         => 'Médico',
                            'callback'      => array($this, 'getNombreEmpleadoFilter')
                        ),
                        'sonata_type_filter_default', array(
                            'field_options' => array(
                                'label_attr'    => array('class' => 'hidden')
                            )
                        )
                    )
                ->add('idTipoEmpleado', null, array('label' => 'Tipo Empleado'))
                ->add('habilitado', null, array('label' => 'Habilitado'))
                ->add('especialidadesEstab', null, array('label' => 'Especialidades Asignada al Médico'), null, array('query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('A')
                                ->where('A.nombreAmbiente IS NULL')
                        ;
                    }));
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre', null, array('label' => 'Nombre', 'required' => true, 'attr' => array('class' => 'limpiar')))
                ->add('apellido', null, array('label' => 'Apellido', 'required' => true, 'attr' => array('class' => 'limpiar')))
                ->add('numeroJuntaVigilancia', null, array('label' => 'JVPM', 'required' => false))
                ->add('dui', null, array('label' => 'DUI', 'required' => false))
                ->add('correoElectronico', 'email', array('label' => 'Correo Electrónico', 'required' => false))
                ->add('numeroCelular', null, array('label' => 'Teléfono Contacto', 'required' => false))
                ->add('habilitado', null, array('label' => 'Habilitado', 'required' => false))
                ->add('idTipoEmpleado', 'entity', array(
                    'label' => 'Tipo de Empleado',
                    'required' => true,
                    'empty_value' => 'Seleccione..',
                    'class' => 'MinsalSiapsBundle:MntTipoEmpleado',
                    'property' => 'tipo',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('mte')
                                ->where('mte.id IN (2,4,5,10)')
                        ;
                    }
                ))
                ->add('idAreaModEstab', 'choice', array(
                    'label' => 'Seleccione la Modalidad con la que trabaja el empleado',
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'mapped' => false,
                    'choices' => array('1' => 'MINSAL', '2' => 'FOSALUD')
                ))
                ->add('especialidadesEstab', 'entity', array(
                    'label' => 'Especialidades con las que trabaja el médico',
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'class' => 'MinsalSiapsBundle:MntAtenAreaModEstab',
                    'property' => 'nombreConsulta',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('f')
                                ->join('f.idAtencion', 'a')
                                ->join('f.idAreaModEstab', 'ame')
                                ->where('ame.idAreaAtencion=1')
                                ->andWhere('f.nombreAmbiente IS NULL')
                                ->orderBy('ame.idServicioExternoEstab', 'DESC')
                        ;
                    }
                ))
                ->add('especialidadesMedico', 'entity', array(
                    'label' => 'Estudios con los que cuenta en médico',
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'class' => 'MinsalSiapsBundle:CtlAtencion',
                    'property' => 'nombre',
                    'query_builder' => function(EntityRepository $repositorio) {
                        return $repositorio
                                ->createQueryBuilder('a')
                                ->join('a.idTipoAtencion', 'ta')
                                ->where('ta.id=1');
                    }
                ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('nombreempleado', null, array('label' => 'Nombre Empleado'))
                ->add('idTipoEmpleado', null, array('label' => 'Tipo Empleado'))
                ->add('habilitado', null, array('editable' => false, 'label' => 'Habilitado'))
                ->add('especialidadesEstab', null, array('label' => 'Especialidades Asignada al Médico'))
                ->add('_action', 'actions', array(
                    'label' => $this->getTranslator()->trans('Action'),
                    'actions' => array(
                        'edit' => array()
                    )
        ));
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        return new ProxyQuery(
                $query
                        ->where($query->getRootAlias() . '.idTipoEmpleado IN (2,4,5,10)')
        );
    }

    /*
     * DESCRIPCIÓN: Función que se realiza para.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:MntEmpleadoAdmin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function prePersist($empleado) {
        $empleado->setIdEstablecimiento($this->getModelManager()
                        ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true)));
        //ATRIBUTOS DE LA AUDITORIA
        $empleado->setIdusuarioreg($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser());
        $empleado->setFechahorareg(new \DateTime());
        //CONCATENAR LOS NOMBRES PARA FORMAR EL NOMBRE EL EMPLEADO
        $empleado->setNombreempleado($empleado->getNombre() . ' ' . $empleado->getApellido());
        //PARA VERIFICAR SI TIENE NUMERO DE VIGILANCIA


        if ($empleado->getNumeroJuntaVigilancia() != '') {
            $empleado->setCodigoFarmacia($empleado->getNumeroJuntaVigilancia());
        }
    }

    /*
     * DESCRIPCIÓN: Función que se realiza despues de insertar el empleado.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function postPersist($empleado) {
        switch ($empleado->getIdTipoEmpleado()->getId()) {
            case 4:
                /* Setear los valores especificos de los usuarios */
                /*
                 * Se utiliza el User Manager porque el encriptado es especial y con este crearemos
                 * el nuevo usuario
                 * */
                $idAreaModEstab = '';
                foreach ($empleado->getEspecialidadesEstab() as $especialidadesEstab) {

                    if ($especialidadesEstab->getIdAreaModEstab() != $idAreaModEstab) {
                        $idAreaModEstab = $especialidadesEstab->getIdAreaModEstab();
                        /* Setear los valores generales del usuario */
                        $contrasenia = "123";
                        $firstname = $empleado->getNombre();
                        $lastname = $empleado->getApellido();
                        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
                        $Funciones=new Funciones();
                        $username=$Funciones->obtenerUsername($em,$firstname,$lastname);
                        $idAreaModEstab = $especialidadesEstab->getIdAreaModEstab();
                        if (is_null($empleado->getCorreoElectronico())) {
                            $correo = $username . '@salud.gob.sv';
                        } else {
                            $correo = $empleado->getCorreoElectronico();
                        }
                        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
                        $usuario = $userManager->createUser();
                        $usuario->setUsername($username);
                        $usuario->setPlainPassword($contrasenia);
                        $usuario->setFirstName($firstname);
                        $usuario->setLastname($lastname);
                        $usuario->setEnabled(true);
                        $usuario->setModulo('SEC');
                        $usuario->setIdEmpleado($empleado);
                        $usuario->setEmail($correo);
                        $establecimiento = $this->getModelManager()
                                ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
                        $usuario->setIdEstablecimiento($establecimiento);
                        $grupo = $this->getModelManager()
                                ->getEntityManager('ApplicationSonataUserBundle:Group')
                                ->createQuery("	SELECT g
                                				FROM ApplicationSonataUserBundle:Group g
                                				WHERE g.name = 'Modulo6AgendaMedica'")
                                ->getSingleResult();
                        $usuario->addGroup($grupo);
                        /* AGREGANDO AL MEDICO EL SEGUIMIENTO CLINICO */
                        $grupoSeguimiento = $this->getModelManager()
                                ->getEntityManager('ApplicationSonataUserBundle:Group')
                                ->createQuery("
                                    SELECT g
                                    FROM ApplicationSonataUserBundle:Group g
                                    WHERE g.name like 'Modulo3Seg%'")
                                ->getResult();
                        foreach ($grupoSeguimiento as $grupo) {
                            $usuario->addGroup($grupo);
                        }
                        $usuario->setIdAreaModEstab($idAreaModEstab);
                        $userManager->updateUser($usuario);
                    }
                    $idAreaModEstabEnfermeria = $this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab'
                            , array('idEmpleado' => $empleado->getId(), 'idAtenAreaModEstab' => $especialidadesEstab->getId(), 'idAreaModEstab' => null));
                    if (!is_null($idAreaModEstabEnfermeria)) {
                        $idAreaModEstabEnfermeria->setIdAreaModEstab($especialidadesEstab->getIdAreaModEstab());
                        $this->getModelManager()->update($idAreaModEstabEnfermeria);
                    }
                }

                break;
             case 2:
             case 5:
             case 10:
                $areaSeleccionada = $this->getForm()->get('idAreaModEstab')->getData();

                foreach ($areaSeleccionada as $area) {
                    $idAreaModEstab = $grupo = $this->getModelManager()
                            ->getEntityManager('MinsalSiapsBundle:MntAreaModEstab')
                            ->createQuery("
				SELECT a
				FROM MinsalSiapsBundle:MntAreaModEstab a
                                JOIN a.idModalidadEstab b
				WHERE a.idServicioExternoEstab IS NULL AND a.idAreaAtencion=1 AND b.idModalidad=" . $area)
                            ->getSingleResult();
                    $verificar = $this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab', array('idEmpleado' => $empleado->getId(), 'idAtenAreaModEstab' => null, 'idAreaModEstab' => $idAreaModEstab->getId()));
                    if (count($verificar) == 0) {
                        $empleadoEstablecimiento = new EmpleadoEstablecimiento();
                        $empleadoEstablecimiento->setIdEmpleado($empleado);
                        $empleadoEstablecimiento->setIdAreaModEstab($idAreaModEstab);
                        $this->getModelManager()->create($empleadoEstablecimiento);
                    }
                }
                break;
        }
    }

    /*
     * DESCRIPCIÓN: Función que se realiza antes de insertar el empleado.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function preUpdate($empleado) {
        //ATRIBUTOS DE LA AUDITORIA
        $empleado->setIdusuariomod($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser());
        $empleado->setFechahoramod(new \DateTime());
        //CONCATENAR LOS NOMBRES PARA FORMAR EL NOMBRE EL EMPLEADO
        $empleado->setNombreempleado($empleado->getNombre() . ' ' . $empleado->getApellido());
        //PARA VERIFICAR SI TIENE NUMERO DE VIGILANCIA
        if ($empleado->getNumeroJuntaVigilancia() != '')
            $empleado->setCodigoFarmacia($empleado->getNumeroJuntaVigilancia());

        $areaSeleccionada = $this->getForm()->get('idAreaModEstab')->getData();
        if (empty($areaSeleccionada)) {
            $idAreaModEstabEnfermeria = $this->getModelManager()
                    ->findBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab'
                    , array('idEmpleado' => $empleado->getId(), 'idAtenAreaModEstab' => null));
            foreach ($idAreaModEstabEnfermeria as $area) {
                $this->getModelManager()->delete($area);
            }
        } else {
            foreach ($areaSeleccionada as $area) {
                $idAreaModEstab = $grupo = $this->getModelManager()
                        ->getEntityManager('MinsalSiapsBundle:MntAreaModEstab')
                        ->createQuery("
				SELECT a
				FROM MinsalSiapsBundle:MntAreaModEstab a
                                JOIN a.idModalidadEstab b
				WHERE a.idServicioExternoEstab IS NULL AND a.idAreaAtencion=1 AND b.idModalidad=" . $area)
                        ->getSingleResult();
                $verificar = $this->getModelManager()
                        ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab', array('idEmpleado' => $empleado->getId(), 'idAtenAreaModEstab' => null, 'idAreaModEstab' => $idAreaModEstab->getId()));
                if (count($verificar) == 0) {
                    $empleadoEstablecimiento = new EmpleadoEstablecimiento();
                    $empleadoEstablecimiento->setIdEmpleado($empleado);
                    $empleadoEstablecimiento->setIdAreaModEstab($idAreaModEstab);
                    $this->getModelManager()->create($empleadoEstablecimiento);
                }
            }
        }
        $usuarios = $this->getModelManager()->findBy('ApplicationSonataUserBundle:User', array('idEmpleado' => $empleado->getId()));
        foreach ($usuarios as $usuario) {
            $usuario->setEnabled($empleado->getHabilitado());
            $usuario->setFirstName($empleado->getNombre());
            $usuario->setLastName($empleado->getApellido());
        }
    }

    public function postUpdate($empleado) {
        switch ($empleado->getIdTipoEmpleado()->getId()) {
            case 4:
                $idAreaModEstab = '';
                $usuario = $this->getModelManager()
                        ->findOneBy('ApplicationSonataUserBundle:User', array('idEmpleado' => $empleado->getId()));

                if (is_null($usuario)) {
                    foreach ($empleado->getEspecialidadesEstab() as $especialidadesEstab) {

                        if ($especialidadesEstab->getIdAreaModEstab() != $idAreaModEstab) {
                            $idAreaModEstab = $especialidadesEstab->getIdAreaModEstab();
                            /* Setear los valores generales del usuario */
                            $contrasenia = "123";
                            $firstname = $empleado->getNombre();
                            $lastname = $empleado->getApellido();
                            if (strpos($lastname, " "))
                                list($primerA, $segundoApellido) = explode(" ", $lastname);
                            else
                                $primerA = $lastname;
                            $bandera = false;
                            $i = 0;
                            $primero = '';
                            $username = '';
                            while (!$bandera) {
                                $primero.=$firstname[$i];
                                $username = strtolower($primero . $primerA);
                                $valor = $this->getModelManager()
                                        ->findOneBy('ApplicationSonataUserBundle:User', array('username' => $username));
                                if (count($valor) == 0)
                                    $bandera = true;
                                else
                                    $i++;
                            }
                            $idAreaModEstab = $especialidadesEstab->getIdAreaModEstab();
                            /* Setear los valores especificos de los usuarios */
                            /*
                             * Se utiliza el User Manager porque el encriptado es especial y con este crearemos
                             * el nuevo usuario
                             * */
                            if (is_null($empleado->getCorreoElectronico())) {
                                $correo = $username . '@salud.gob.sv';
                            } else {
                                $correo = $empleado->getCorreoElectronico();
                            }
                            $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
                            $usuario = $userManager->createUser();
                            $usuario->setUsername($username);
                            $usuario->setPlainPassword($contrasenia);
                            $usuario->setFirstName($firstname);
                            $usuario->setLastname($lastname);
                            $usuario->setEnabled(true);
                            $usuario->setModulo('SEC');
                            $usuario->setIdEmpleado($empleado);
                            $establecimiento = $this->getModelManager()
                                    ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
                            $usuario->setIdEstablecimiento($establecimiento);
                            $grupo = $this->getModelManager()
                                    ->getEntityManager('ApplicationSonataUserBundle:Group')
                                    ->createQuery("
				SELECT g
				FROM ApplicationSonataUserBundle:Group g
				WHERE g.name = 'Modulo6AgendaMedica'")
                                    ->getSingleResult();

                            $usuario->addGroup($grupo);
                            /* AGREGANDO AL MEDICO EL SEGUIMIENTO CLINICO */
                            $grupoSeguimiento = $this->getModelManager()
                                    ->getEntityManager('ApplicationSonataUserBundle:Group')
                                    ->createQuery("
                                    SELECT g
                                    FROM ApplicationSonataUserBundle:Group g
                                    WHERE g.name like 'Modulo3%'")
                                    ->getResult();
                            foreach ($grupoSeguimiento as $grupo) {
                                $usuario->addGroup($grupo);
                            }
                            $usuario->setIdAreaModEstab($idAreaModEstab);
                            $userManager->updateUser($usuario);
                        }
                    }
                } else {
                    $firstname = $empleado->getNombre();
                    $lastname = $empleado->getApellido();
                    if (strpos($lastname, " "))
                        list($primerA, $segundoApellido) = explode(" ", $lastname);
                    else
                        $primerA = $lastname;
                    $bandera = false;
                    $i = 0;
                    $primero = '';
                    $username = '';
                    while (!$bandera) {
                        $primero.=$firstname[$i];
                        $username = strtolower($primero . $primerA);
                        $valor = $this->getModelManager()
                                ->findOneBy('ApplicationSonataUserBundle:User', array('username' => $username, 'idEmpleado' => $empleado->getId()));
                        if (count($valor) == 0)
                            $bandera = true;
                        else
                            $i++;
                    }
                    $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
                    $usuario->setUsername($username);
                    $usuario->setFirstName($firstname);
                    $usuario->setLastname($lastname);
                    $usuario->setEnabled($empleado->getHabilitado());
                    $userManager->updateUser($usuario);
                }
                foreach ($empleado->getEspecialidadesEstab() as $atenAreaModEstab) {
                    $idAreaModEstabEnfermeria = $this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab'
                            , array('idEmpleado' => $empleado->getId(), 'idAtenAreaModEstab' => $atenAreaModEstab->getId(), 'idAreaModEstab' => null));
                    if (!is_null($idAreaModEstabEnfermeria)) {
                        $idAreaModEstabEnfermeria->setIdAreaModEstab($atenAreaModEstab->getIdAreaModEstab());
                        $this->getModelManager()->update($idAreaModEstabEnfermeria);
                    }
                }
                break;
        }
    }

    /*
     * DESCRIPCIÓN: Función que se utiliza para la validación del Empleado.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function validate(ErrorElement $errorElement, $object) {
        /* Validando que exista el tipo de empleado sino existe lanza el error */
        if (is_null($object->getIdTipoEmpleado())) {
            $errorElement
                    ->with('idTipoEstablecimiento')
                    ->addViolation('Debe seleccionar el tipo de empleado')
                    ->end();
        } else {
            /* Si existe el tipo de empleado valida que si es 4(MÃ©dico) debe de haber seleccionado
             * la especialidad o especialidades con las que trabajara dentro del establecimiento */
            if ($object->getIdTipoEmpleado()->getId() == 4) {
                if (count($object->getEspecialidadesEstab()) == 0) {
                    $errorElement
                            ->with('especialidadesEstab')
                            ->addViolation('')
                            ->end()
                            ->with('error')
                            ->addViolation('Debe seleccionar al menos una especialidad con la que trabaja el mÃ©dico')
                            ->end();
                }
            }
        }
    }

    public function getNombreEmpleadoFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em      = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb      = $em->createQueryBuilder();

        $queryBuilder
           ->where($qb->expr()->orX(
                   $qb->expr()->like($qb->expr()->lower($alias.'.nombreempleado'), ':nombreEmpleado'),
                   $qb->expr()->like($qb->expr()->lower($alias.'.nombreempleado'), ':nombreEmpleado')
               )
           )
           ->setParameter(':nombreEmpleado', '%' . strtolower($value['value']['value']) . '%')
        ;
    }

}
