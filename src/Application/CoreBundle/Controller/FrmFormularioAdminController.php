<?php
namespace Application\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Minsal\SeguimientoBundle\Entity\FrmFormItem;
use Minsal\SeguimientoBundle\Entity\FrmFormularioSeccionPool;
use Minsal\SeguimientoBundle\Entity\FrmGrupoInsercion;
use Minsal\SeguimientoBundle\Entity\FrmFormSeccionItem;
use Minsal\SeguimientoBundle\Entity\FrmInsercionParametro;
use Minsal\SeguimientoBundle\Entity\FrmInsercionDependencia;
use Application\CoreBundle\Form\Type\EmbedFormType;


class FrmFormularioAdminController extends CRUDController
{

     /**
     * return the Response object associated to the action
     *
     *
     * @param mixed $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function generateFormTestAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('GENERATEFORMTEST')) {
            throw new AccessDeniedException();
        }

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios **/
        $formGenerator = $this->container->get('form.generator.service');
        //$formGeneratorB = $this->container->get('form.generator.service');

        /** Al obtener la instancia del Servicio, utilizamos el metodo generateForm($formulario, $opciones) para crear un formBuilder.
         *  El Primer Parametro es una instancia de la Entity FrmFormulario que desea generarse, y el Segundo es una Array de opciones.
         *  El metodo retorna una instancia de FormBuilder.
         */
        $formBuilder = $formGenerator->generateForm($object, array(/* Opciones Disponibles:
                                                            'action' => $this->generateUrl('url'),  // Action del Formulario    - DEFAULT: Ninguna
                                                            'method' => 'POST',                     // Metodo POST o GET        - DEFAULT: POST
                                                            'submit_button' => true,                // Boton Submit Por Defecto - DEFAULT: true
                                                            'submit_button_name' => 'Registrar'     // Nombre de Boton Submit   - DEFAULT: Guardar */
                                                            'add_button' => array( 'saveAndExit' => array('label' => 'Guardar y Salir', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                                                                                                          'type'  => 'submit',          // Tipo de Boton (submit, reset o button) - DEFAULT: button
                                                                                                          'class' => 'btn-primary',      // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                                                                                                          'icon'  => '<span class="glyphicon glyphicon-floppy-open"></span>', // Icono dentro de boton
                                                                                                          'style' => 'font-weight: bold;'
                                                                                                    ),
                                                                                   'resetForm'   => array('label'  => 'Restablecer Valores',
                                                                                                          'type'   => 'reset',
                                                                                                          'class'  => 'btn-danger',
                                                                                                          'icon'   => '<span class="glyphicon glyphicon-unchecked"></span>'
                                                                                                    )
                                                                            )
                                                            ));
        //$formBuilderB = $formGeneratorB->generateForm($this->findObject('FrmFormulario', 4), array('submit_button' => false));
        /** Obtener instancia de Form (Formulario construido y que puede ser renderizado) **/
        //this works $formBuilder->add($formBuilderB);

        $form = $formGenerator->getGeneratedForm();
        //$formB = $formGeneratorB->getGeneratedForm();
        /* This works too
        $form->add(
                    $formBuilderB->create('form', new EmbedFormType($formBuilderB), array('auto_initialize'=>false))->getForm()
                );*/
        /*This works too*/
        //$form->add('form', new EmbedFormType($formBuilderB));

        /*********      Agregar Nuevos Campos       *************************************************************
         * --Si se desea agregar otros Campos, se puede realizar a partir del $form (instancia de Form). Ejemplo:
         *   $form->add('nombreNuevoCampo', 'integer', array('label'=>'My label', 'required' => false) );
         *
         * --O si se desea remover algunos no deseados, como elimina el boton de submit por defecto "Guardar":
         *   $form->remove('save');
         *
         ********* Opcional (Se recomienda la instruccion anterior): ********************************************
         * --Form Se puede generar tambien a partir de $formBuilder:
         *   $form = $formBuilder->getForm();
         *
         * --En caso de querer agregar campos al $formBuilder (y no directamente a $form), se debe realizar asi:
         *   $formBuilder->add('nombreNuevoCampo', 'integer', array('label'=>'My label', 'required' => false) );
         *   $form = $formBuilder->getForm();
         *   $formGenerator->setGeneratedForm($form);
         *
         * --IMPORTANTE:
         *   El metodo $formGenerator->setGeneratedForm($form) es importante aplicarlo en caso de haber obtenido
         *   el $form a partir del $formBuilder, esto permitira poder seguir utilizando los metodos
         *   $formGenerator->saveDataToDB() y $formGenerator->getFormView().
         */

        /** Cuando se realiza un POST (submit del Formulario por el usuario) **/
        if ($this->getRestMethod() == 'POST') {

            /* Setear la Data en el Form por medio de handleRequest. Mas info: http://symfony.com/doc/master/book/forms.html#handling-form-submissions */
            $form->handleRequest($this->get('request'));

            /* isValid aplica los Constraints verificando que la Data del Formulario sea valida, sino renderiza los errores al Form */
            if ($form->isValid()) {

                /* Si se tienen Parametros de Inserción, definirlos en un array segun su nombre */
        		$fecha_registro= new \DateTime();
        		$id_empleado=1;
        		$id_aten_area_mod_estab=1;
        		$id_formulario=6;
        		$id_paciente=10;
                $parameters = array('fecha_registro'=>$fecha_registro,'id_empleado'=>$id_empleado,'id_aten_area_mod_estab'=>$id_aten_area_mod_estab,'id_formulario'=>$id_formulario,'id_paciente'=>$id_paciente);
                /* Se guarda la Data en la BD por medio del metodo saveDataToDB($parametrosDeInsercionNecesarios)
                 * y segun la Configuracion de Guardado del Formulario en cuestion.
                 * En caso de no poder guardar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                if($formGenerator->saveDataToDB($parameters)){

                    /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                    $this->addFlash('sonata_flash_success','Registro exitoso!');

                    /* Si se tiene mas de un Boton de Submit, para determinar a cual boton se ha dado click utlizar lo siguiente */
                    if( $form->get('saveAndExit')->isClicked() ){
                        // ... realizar accion deseada o redireccionar
                    }
                }
            }
            else{
                $this->addFlash('sonata_flash_error','Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }

        /** Generar la Vista que se renderizara del Formulario por medio del metodo getFormView: **/
        $view = $formGenerator->getFormView();

        /*********      Importante:     *************************************************************************
         * --Si el $form se genero a partir del $formBuilder y NO se ha utilizado el metodo
         *   $formGenerator->setGeneratedForm($form) la vista debe obtenerse tambien con el metodo createView:
         *   $view = $form->createView();
         *
         * --Por lo cual habra que setearle un Theme. El Theme por defecto utilizado y recomendado es el siguiente:
         *   $this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
         */

        /* No olvidar obtener el JavaScript del FormularioDinamico. Especificar si se desea la funcionalidad de accordion que por defecto es false. */
        $itemsActionJs = $formGenerator->getItemsActionJs( array('accordion'=>true) );

        /* Importante:
         * --Si se han agregado Campos mediante el $form o $formBuilder, el atributo "for" de los Label debe terminar en "s<<NumeroSeccion>>"
         *   para ser incluidos en el accordion, en donde <<NumeroSeccion>> es el numero o Id de la seccion donde se desea. Por Ejemplo:
         *  ( 'label'=>'My label', 'label_attr' => array('for'=>'someName_s<<NumeroSeccion>>') )
         */

        return $this->render('MinsalSeguimientoBundle:GenerateFormTest:generateFormAdminTest.html.twig', array(
            'action' => 'generateformtest',
            'form'   => $view,
            'object' => $object,
            'itemsActionJs'   => $itemsActionJs,
        ));

    }

    /*** Utilidades ***

    **Acceder al Form por medio del Request**
        var_dump('<br/><b>The Form Request:</b><br/>');
        var_dump($this->get('request')->get('form'));

    **Metodos equivalentes a handleRequest**
        $form->handleRequest($this->get('request'));
        $form->submit($this->get('request'));

    **Acceder a la Data de cada Item del Form**
      //Con un foreach
        $elements = $form->all();
        foreach ($elements as $key => $elem) {
            var_dump($this->get('request')->get('form')[$elem->getName()]);
            //OR depues del handleRequest: var_dump( $form->get($elem->getName())->getData() );
        }
      //De forma directa
        var_dump( $this->get('request')->get('form')['Nombre'] );
        var_dump( $form->get('Nombre')->getData() );


    ** Imprimir Toda la Data despues de handleRequest**
        var_dump('<br/><br/><b>getData After Handle Request</b><br/>');
        var_dump( $form->getData() );
        var_dump('<br/><br/><br/>');
    */

    /**
     * return the Response object associated to the view action
     *
     * @param null $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function showAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object); /*object debe substituirse por la instancia de la Entity FrmFormulario que desea generarse */

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios **/
        $formGenerator = $this->container->get('form.generator.service');

        /** Definir un array con los Id de las tablas principales (o padres). En esto caso se desea el show de la persona con Id 74 **/
        $mainIds = array('sec_antecedentes'=>5);

        /** Llamamos al metodo getFormSavedData, especificando el form del cual se generara un show y el array con los ID's principales **/
        $savedData = $formGenerator->getFormSavedData($object, $mainIds);

        /**
         * La plantilla show estandar para Formularios Dinamicos es: ApplicationCoreBundle:FormDinamico:base_show.html.twig
         * en la cual se puede basar para realizar su propio show. Ver el archivo para mayor detalle.
         */
        return $this->render('ApplicationCoreBundle:FormDinamico:base_show.html.twig', array(
            'action'   => 'show',
            'object'   => $object,
            'elements' => $this->admin->getShow(),
            'savedData'=> $savedData
        ));
    }


    /**
     * return the Response object associated to the edit action
     *
     *
     * @param mixed $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function editAction($id = null)
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object); /*object debe substituirse por la instancia de la Entity FrmFormulario que desea generarse */

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios **/
        $formGenerator = $this->container->get('form.generator.service');

        /** Al obtener la instancia del Servicio, utilizamos el metodo generateForm($formulario, $opciones) para crear un formBuilder.
         ** El Primer Parametro es una instancia de la Entity FrmFormulario que desea generarse, y el Segundo es una Array de opciones.
         ** El metodo retorna una instancia de FormBuilder, que sirve para luego obtener un Form. Pero en este caso, para el edit
         ** omitiremos el retorno del formbuilder y solo llamamos al metodo. */
        /*$formBuilder = */
        $formGenerator->generateForm($object, array(/* Opciones Disponibles:
                                                    'action' => $this->generateUrl('url'),  // Action del Formulario    - DEFAULT: Ninguna
                                                    'method' => 'POST',                     // Metodo POST o GET        - DEFAULT: POST
                                                    'submit_button' => true,                // Boton Submit Por Defecto - DEFAULT: true */
                                                    'submit_button_name' => 'Actualizar',     // Nombre de Boton Submit   - DEFAULT: Guardar
                                                    'add_button' => array( 'updateAndExit' => array('label' => 'Actualizar y Salir', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                                                                                                    'type'  => 'submit',          // Tipo de Boton (submit, reset o button) - DEFAULT: button
                                                                                                    'class' => 'btn-success',      // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                                                                                                    'icon'  => '<span class="glyphicon glyphicon-floppy-open"></span>' // Icono dentro de boton
                                                                                                )
                                                                         )
                                                    ));


        /** Definir un array con los Id de las tablas principales (o padres). En esto caso se desea el edit de la persona con Id 74 **/
        //$mainIds = array('ctl_persona_test'=>74);
        $mainIds = array('sec_historial_clinico'=>442);

        /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales.
         ** Al igual que el metedo anterior, este retorna una instancia de FormBuilder, la cual puede ser  modificada (ver mas detalles en generateFormTestAction).*/
        $formGenerator->setFormData($mainIds);

        /** Obtener instancia de Form (Formulario construido y seteado, que puede ser renderizado), y el cual puede ser  modificado (ver mas detalles en generateFormTestAction) **/
        $form = $formGenerator->getGeneratedForm();

        if ($this->getRestMethod() == 'POST') {
            /* Setear la Data en el Form por medio de handleRequest. Mas info: http://symfony.com/doc/master/book/forms.html#handling-form-submissions */
            $form->handleRequest($this->get('request'));

                /*var_dump('<br/><br/><b>getData After Handle Request</b><br/>');
                var_dump( $form->getData() );
                var_dump('<br/><br/><br/>');*/

            /* isValid aplica los Constraints verificando que la Data del Formulario sea valida, sino renderiza los errores al Form */
            if ($form->isValid()) {

                /* Si se tienen Parametros que se desea actualizar, definirlos en un array segun su nombre, sino enviar el array vacio */
                $parameters = array();

                /* Se Actualiza la Data en la BD por medio del metodo updateDataToDB( $parameters, $mainIds)
                 * y segun la Configuracion de Guardado del Formulario en cuestion.
                 * En caso de no poder actualizar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                if($formGenerator->updateDataToDb($parameters, $mainIds)){

                    /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                    $this->addFlash('sonata_flash_success','Registro exitoso!');

                    /* Si se tiene mas de un Boton de Submit, para determinar a cual boton se ha dado click utlizar lo siguiente */
                    if( $form->get('updateAndExit')->isClicked() ){
                        // ... realizar accion deseada o redireccionar
                    }
                }
            }
            else{
                $this->addFlash('sonata_flash_error','Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }

        /** Generar la Vista que se renderizara del Formulario por medio del metodo getFormView: **/
        $view = $formGenerator->getFormView();

        /*********      Importante:     *************************************************************************
         * --Si el $form se genero a partir del $formBuilder y NO se ha utilizado el metodo
         *   $formGenerator->setGeneratedForm($form) la vista debe obtenerse tambien con el metodo createView:
         *   $view = $form->createView();
         *
         * --Por lo cual habra que setearle un Theme. El Theme por defecto utilizado y recomendado es el siguiente:
         *   $this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
         */

        /* No olvidar obtener el JavaScript del FormularioDinamico. Especificar si se desea la funcionalidad de accordion que por defecto es false. */
        $itemsActionJs = $formGenerator->getItemsActionJs( array('accordion'=>true) );

        return $this->render('MinsalSeguimientoBundle:GenerateFormTest:generateFormAdminTest.html.twig', array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
            'itemsActionJs'   => $itemsActionJs,
        ));
    }

    private function findObject($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository('ApplicationCoreBundle:'.$entity)->findOneById($id);
        return $foundObject;
    }

}
