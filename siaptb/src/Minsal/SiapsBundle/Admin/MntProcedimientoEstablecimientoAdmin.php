<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Minsal\SiapsBundle\Form\DataTransformer\MntCiqToStringTransformer;

class MntProcedimientoEstablecimientoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idCiq',null,array('label'=>'Procedimiento'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idCiq.nombreProcedimiento',null,array('label'=>'Procedimiento'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array()
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object  = $this->getSubject();
        $action  = $object->getId() ? 'edit' : 'create';
        $em      = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $transformer = new MntCiqToStringTransformer($em);

        $formMapper
            ->add('idCiq','hidden',
                array(
                    'label'    => 'Procedimiento',
                    'required' => true,
                    'attr'     => array(
                        'required'  => 'true'
                    )
                )
            )
            ->get('idCiq')
            ->addModelTransformer($transformer)
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $showMapper
            ->add('idCiq',null,array('label'=>'Procedimiento'))
        ;

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $showMapper
                ->add('idusuarioreg',null,array('label'=>'Usuario que registró'))
                ->add('fechahorareg',null,array('label'=>'Fecha y Hora de Registro'))
                ->add('idusuariomod',null,array('label'=>'Usuario que modificó'))
                ->add('fechahoramod',null,array('label'=>'Fecha y Hora de modificación'))
            ;
        }
    }

    public function validate(ErrorElement $errorElement, $object) {
        $action             = $object->getId() ? 'edit' : 'create';
        $em                 = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $currentDateTime    = new \DateTime();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        $dql = 'SELECT p
                FROM MinsalSiapsBundle:MntProcedimientoEstablecimiento p
                WHERE p.idEstablecimiento = :idEstablecimiento
                    AND p.idCiq = :idCiq';

        if($action === 'edit') {
            $dql .= ' AND p.id != :id';
        }

        $query = $em->createQuery($dql)
                     ->setParameter('idEstablecimiento', $CtlEstablecimiento->getId())
                     ->setParameter('idCiq', $object->getIdCiq()->getId());

        if($action === 'edit') {
            $query->setParameter('id', $object->getId());
        }

        $result = $query->getResult();

        if ($result) {
            $errorElement
                ->with('error')
                    ->addViolation('El Procedimiento seleccionado "'.$object->getIdCiq()->getProcedimiento().'" ya ha sido habilitado en el Establecimiento.')
                ->end()
            ;
        }
    }

    public function prePersist($object) {
        $em                 = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $user               = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $currentDateTime = new \DateTime();

        $object->setIdusuarioreg($user);
        $object->setFechahorareg($currentDateTime);
        $object->setIdEstablecimiento($CtlEstablecimiento);
    }

	public function preUpdate($object) {
        $em              = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $user            = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $currentDateTime = new \DateTime();

        $object->setIdusuariomod($user);
        $object->setFechahoramod($currentDateTime);
    }

    public function getTemplate($name) {
		switch ($name) {
			case 'edit':
				return 'MinsalSiapsBundle:CRUD:MntProcedimientoEstablecimiento/edit.html.twig';
				break;
			default:
				return parent::getTemplate($name);
				break;
		}
	}

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
        $actions['edit'] = null;
    }
}
