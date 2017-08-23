<?php

namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
//use Minsal\SeguimientoBundle\Entity\TarPaciente;
use Symfony\Component\Validator\Constraints;

class TarSecTarAdminController extends CRUDController {

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
    public function createAction() {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        $fantecedente = $this->findFormulario('FVIH05');

        $historia = $this->findObject('SecHistorialClinico', 161);
        $idpaciente = $historia->getIdExpediente()->getIdPaciente()->getId();
        $em = $this->getDoctrine()->getManager();
        $idantecedente = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->getIdPorPaciente($idpaciente);

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios * */
        $formGenerator = $this->container->get('form.generator.service');
        $formGeneratorB = $this->container->get('form.generator.service');
        /** Al obtener la instancia del Servicio, utilizamos el metodo generateForm($formulario, $opciones) para crear un formBuilder.
         * * El Primer Parametro es una instancia de la Entity FrmFormulario que desea generarse, y el Segundo es una Array de opciones.
         * * El metodo retorna una instancia de FormBuilder, que sirve para luego obtener un Form */
        $formBuilder = $formGenerator->generateForm($fantecedente, array(/* Opciones Disponibles:
              'action' => $this->generateUrl('url'),  // Action del Formulario    - DEFAULT: Ninguna
              'method' => 'POST',                     // Metodo POST o GET        - DEFAULT: POST
              'submit_button' => true,                // Boton Submit Por Defecto - DEFAULT: true
              'submit_button_name' => 'Registrar'     // Nombre de Boton Submit   - DEFAULT: Guardar */
            'add_button' => array('saveAndExit' => array('label' => 'Guardar y Salir', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                    'type' => 'submit', // Tipo de Boton (submit, reset o button) - DEFAULT: button
                    'class' => 'btn-primary', // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                    'icon' => '<span class="glyphicon glyphicon-floppy-open"></span>' // Icono dentro de boton
                ),
                'reset' => array('label' => 'Restablecer Valores',
                    'type' => 'reset',
                    'class' => 'btn-danger',
                    'icon' => '<span class="glyphicon glyphicon-unchecked"></span>'
                )
            )
        ));

        $formBuilderB = $formGeneratorB->generateForm($this->findFormulario('FVIH05-A'), array('submit_button' => false));

        $mainIds = array('sec_antecedentes' => $idantecedente);

        /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales.
         * * Al igual que el metedo anterior, este retorna una instancia de FormBuilder, la cual puede ser  modificada (ver mas detalles en generateFormTestAction). */
        if ($idantecedente)
            $formGeneratorB->setFormData($mainIds);

        $formBuilder->add($formBuilderB);
        /** Obtener instancia de Form (Formulario construido y que puede ser renderizado) * */
        //$form = $formGenerator->getGeneratedForm();
        /**
         * --Form Se puede generar tambien a partir de $formBuilder:
         *   $form = $formBuilder->getForm();
         *
         * --Si se desea agregar otros Campos, se puede realizar a partir del $formBuilder y luego obtener el Form. Ejemplo:
         *   $formBuilder->add('nombreNuevoCampo', 'integer', array('label'=>'My label', 'required' => false) );
         *   $form = $formBuilder->getForm();
         *
         * --O si se desea remover algunos no deseados, como elimina el boton de submit por defecto "Guardar":
         *   $formBuilder->remove('save');
         */
        $form = $formGenerator->getGeneratedForm();

        //$form = $formBuilder->getForm();
        /** Cuando se realiza un POST (submit del Formulario por el usuario) * */
        if ($this->getRestMethod() == 'POST') {
            //var_dump($this->get('request')->get('form'));
            //var_dump($this->get('request')->get('form'));
            /* Setear la Data en el Form por medio de handleRequest. Mas info: http://symfony.com/doc/master/book/forms.html#handling-form-submissions */
            $form->handleRequest($this->get('request'));
            $request = Request::createFromGlobals();
            /* isValid aplica los Constraints verificando que la Data del Formulario sea valida, sino renderiza los errores al Form */
            if ($form->isValid()) {

                /* Si se tienen Parametros de Inserción, definirlos en un array segun su nombre */

                $pacienteid = 1;
                $formid = $fantecedente->getId();
                $estado = true;
                $parameters = array('id_historial_clinico' => $pacienteid, 'estado' => $estado, 'id_formulario' => $formid);

                /* Se guarda la Data en la BD por medio del metodo saveDataToDB($parametrosDeInsercionNecesarios)
                 * y segun la Configuracion de Guardado del Formulario en cuestion.
                 * En caso de no poder guardar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                if ($formGenerator->saveDataToDB($parameters)) {

                    /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                    $this->addFlash('sonata_flash_success', 'Registro exitoso!');
                }

                /* Si se tiene mas de un Boton de Submit, para determinar a cual boton se ha dado click utlizar lo siguiente */
                if ($form->get('save')->isClicked()) {
                    // ... realizar accion deseada o redireccionar
                    $route = 'create';
                    return $this->redirect($this->admin->generateUrl($route));
                }
                if ($form->get('saveAndExit')->isClicked()) {
                    // ... realizar accion deseada o redireccionar
                    $route = 'list';
                    return $this->redirect($this->admin->generateUrl($route));
                }
            } else {
                $this->addFlash('sonata_flash_error', 'Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }

        /** Generar la Vista que se renderizara del Formulario por medio del metodo getFormView: * */
        $view = $formGenerator->getFormView();
        //$view = $form->createView();
        //$this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
        /**  Importante:
         * --Si el $form se genero a partir del $formBuilder, la vista debe obtenerse tambien con el metodo createView
         *   $view = $form->createView();
         *
         * --Por lo cual habra que setearle un Theme. El Theme por defecto utilizado y recomendado es el siguiente:
         *   $this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
         */
        /* No olvidar obtener el JavaScript del FormularioDinamico. Especificar si se desea la funcionalidad de accordion que por defecto es false. */
        $itemsActionJs = $formGenerator->getItemsActionJs(array('accordion' => true));
        $itemsActionJsB = $formGeneratorB->getItemsActionJs(array('accordion' => true, 'inner' => true));
        /* Importante:
         * --Si se han agregado Campos mediante el $formBuilder, el atributo "for" de los Label debe terminar en "s<<NumeroSeccion>>"
         *   para ser incluidos en el accordion, en donde <<NumeroSeccion>> es el numero o Id de la seccion donde se desea. Por Ejemplo:
         *  ( 'label'=>'My label', 'label_attr' => array('for'=>'someName_s<<NumeroSeccion>>') )
         */
        //var_dump($itemsActionJsB);
        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'itemsActionJs' => $itemsActionJs,
                    'itemsActionJsB' => $itemsActionJsB
        ));
    }

    /**
     * return the Response object associated to the action
     *
     *
     * @param null $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function createEspeAction($idhistoria = null) {
        // the key used to lookup the template
        $templateKey = 'edit';
        $cerrar=false;

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        $fantecedente = $this->findFormulario('FVIH05');

        $historia = $this->findObject('SecHistorialClinico', $idhistoria);
        $idpaciente = $historia->getIdExpediente()->getIdPaciente()->getId();
        $em = $this->getDoctrine()->getManager();
        $idantecedente = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->getIdPorPaciente($idpaciente);

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios * */
        $formGenerator = $this->container->get('form.generator.service');
        $formGeneratorB = $this->container->get('form.generator.service');
        /** Al obtener la instancia del Servicio, utilizamos el metodo generateForm($formulario, $opciones) para crear un formBuilder.
         * * El Primer Parametro es una instancia de la Entity FrmFormulario que desea generarse, y el Segundo es una Array de opciones.
         * * El metodo retorna una instancia de FormBuilder, que sirve para luego obtener un Form */
        $formBuilder = $formGenerator->generateForm($fantecedente, array(/* Opciones Disponibles:
              'action' => $this->generateUrl('url'),  // Action del Formulario    - DEFAULT: Ninguna
              'method' => 'POST',                     // Metodo POST o GET        - DEFAULT: POST
              'submit_button' => true,                // Boton Submit Por Defecto - DEFAULT: true
              'submit_button_name' => 'Registrar'     // Nombre de Boton Submit   - DEFAULT: Guardar */
            'submit_button' => false,
            'add_button' => array('saveAndExit' => array('label' => 'Guardar y Salir', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                    'type' => 'submit', // Tipo de Boton (submit, reset o button) - DEFAULT: button
                    'class' => 'btn-primary', // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                    'icon' => '<span class="glyphicon glyphicon-floppy-open"></span>' // Icono dentro de boton
                )
               
            )
        ));

        $formBuilderB = $formGeneratorB->generateForm($this->findFormulario('FVIH05-A'), array('submit_button' => false));

        $mainIds = array('sec_antecedentes' => $idantecedente);

        /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales.
         * * Al igual que el metedo anterior, este retorna una instancia de FormBuilder, la cual puede ser  modificada (ver mas detalles en generateFormTestAction). */
        if ($idantecedente)
            $formGeneratorB->setFormData($mainIds);

        $formBuilder->add($formBuilderB);
        /** Obtener instancia de Form (Formulario construido y que puede ser renderizado) * */
        //$form = $formGenerator->getGeneratedForm();
        /**
         * --Form Se puede generar tambien a partir de $formBuilder:
         *   $form = $formBuilder->getForm();
         *
         * --Si se desea agregar otros Campos, se puede realizar a partir del $formBuilder y luego obtener el Form. Ejemplo:
         *   $formBuilder->add('nombreNuevoCampo', 'integer', array('label'=>'My label', 'required' => false) );
         *   $form = $formBuilder->getForm();
         *
         * --O si se desea remover algunos no deseados, como elimina el boton de submit por defecto "Guardar":
         *   $formBuilder->remove('save');
         */
        $form = $formGenerator->getGeneratedForm();
        $formB = $formGeneratorB->getGeneratedForm();

        //$form = $formBuilder->getForm();
        /** Cuando se realiza un POST (submit del Formulario por el usuario) * */
        if ($this->getRestMethod() == 'POST' && ($this->get('request')->get('_external')==false || !$this->get('request')->get('_external'))) {
            //var_dump($this->get('request')->get('form'));
            //var_dump($this->get('request')->get('form'));
            /* Setear la Data en el Form por medio de handleRequest. Mas info: http://symfony.com/doc/master/book/forms.html#handling-form-submissions */

            $form->handleRequest($this->get('request'));
            //Importante: En vez de $formB->handleRequest($this->get('request'));, debido a que la data de formB esta inscrustada
            //            dentro de form hacer lo siguiente:
            $formGeneratorB->setGeneratedForm($form->get('form'));

            //$request = Request::createFromGlobals();
            /* isValid aplica los Constraints verificando que la Data del Formulario sea valida, sino renderiza los errores al Form */
            if ($form->isValid()) {

                /* Si se tienen Parametros de Inserción, definirlos en un array segun su nombre */

                $pacienteid = 1;
                $formid = $fantecedente->getId();
                $estado = true;
                $parameters = array('id_historial_clinico' => $idhistoria, 'estado' => $estado, 'id_formulario' => $formid);

                $parametersB = array();
                /* Se guarda la Data en la BD por medio del metodo saveDataToDB($parametrosDeInsercionNecesarios)
                 * y segun la Configuracion de Guardado del Formulario en cuestion.
                 * En caso de no poder guardar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                if ($formGenerator->saveDataToDB($parameters)) {
                    //  var_dump($formGeneratorB); exit();

                    if ($formGeneratorB->updateDataToDb($parametersB, $mainIds)) {
                        /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                        $this->addFlash('sonata_flash_success', 'Registro exitoso!');
                    }
                }

                /* Si se tiene mas de un Boton de Submit, para determinar a cual boton se ha dado click utlizar lo siguiente */
             
                if ($form->get('saveAndExit')->isClicked()) {
                    // ... realizar accion deseada o redireccionar
                    //$route = 'list';
                    //return $this->redirect($this->admin->generateUrl($route));
                    $cerrar=true;
                }
            } else {
                $this->addFlash('sonata_flash_error', 'Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }

        /** Generar la Vista que se renderizara del Formulario por medio del metodo getFormView: * */
        $view = $formGenerator->getFormView();
        //$view = $form->createView();
        //$this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
        /**  Importante:
         * --Si el $form se genero a partir del $formBuilder, la vista debe obtenerse tambien con el metodo createView
         *   $view = $form->createView();
         *
         * --Por lo cual habra que setearle un Theme. El Theme por defecto utilizado y recomendado es el siguiente:
         *   $this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
         */
        /* No olvidar obtener el JavaScript del FormularioDinamico. Especificar si se desea la funcionalidad de accordion que por defecto es false. */
        $itemsActionJs = $formGenerator->getItemsActionJs(array('accordion' => true));
        $itemsActionJsB = $formGeneratorB->getItemsActionJs(array('accordion' => true, 'inner' => true));
        /* Importante:
         * --Si se han agregado Campos mediante el $formBuilder, el atributo "for" de los Label debe terminar en "s<<NumeroSeccion>>"
         *   para ser incluidos en el accordion, en donde <<NumeroSeccion>> es el numero o Id de la seccion donde se desea. Por Ejemplo:
         *  ( 'label'=>'My label', 'label_attr' => array('for'=>'someName_s<<NumeroSeccion>>') )
         */
        //var_dump($itemsActionJsB);
        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'itemsActionJs' => $itemsActionJs,
                    'itemsActionJsB' => $itemsActionJsB,
                    'cerrar'=>$cerrar
        ));
    }

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
    public function showAction($id = null) {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            throw new AccessDeniedException();
        }
        $fichaTar = $this->findObject('TarSecTar', $id);
        // var_dump($fichaTar);         exit();
        $formularioid = $fichaTar->getIdFormulario()->getId();
        $formulario = $this->findFormulario2($formularioid);
        //var_dump($formulario);         exit();
        $this->admin->setSubject($object); /* object es la instancia de la Entity FrmFormulario que desea generarse */

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios * */
        $formGenerator = $this->container->get('form.generator.service');

        /** Definir un array con los Id de las tablas principales (o padres). En esto caso se desea el show de la persona con Id 74 * */
        $mainIds = array('tar_sec_tar' => $id);

        /** Llamamos al metodo getFormSavedData, especificando el form del cual se generara un show y el array con los ID's principales * */
        $savedData = $formGenerator->getFormSavedData($formulario, $mainIds);

        /**
         * La plantilla show estandar para Formularios Dinamicos es: ApplicationCoreBundle:FormDinamico:base_show.html.twig
         * en la cual se puede basar para realizar su propio show. Ver el archivo para mayor detalle.
         */
        return $this->render('MinsalSeguimientoBundle:SecAntecedentes:show.html.twig', array(
                    'action' => 'show',
                    'object' => $object,
                    'elements' => $this->admin->getShow(),
                    'savedData' => $savedData
        ));
    }

    private function findObject($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository('MinsalSeguimientoBundle:' . $entity)->findOneById($id);
        return $foundObject;
    }

    private function findFormulario($codigo) {
        $em = $this->getDoctrine()->getManager();
        $id = $em->getRepository('ApplicationCoreBundle:FrmFormulario')->getFormularioPorCodigo($codigo);
        $foundObject = $em->getRepository('ApplicationCoreBundle:FrmFormulario')->findOneById($id);
        return $foundObject;
    }

    private function findFormulario2($id) {
        $em = $this->getDoctrine()->getManager();

        $foundObject = $em->getRepository('ApplicationCoreBundle:FrmFormulario')->findOneById($id);
        return $foundObject;
    }

    private function findObject2($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository('MinsalSiapsBundle:' . $entity)->findOneById($id);
        return $foundObject;
    }

    private function is_empty($var) {
        return empty($var);
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
    public function editAction($id = null) {
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        $fichatar = $this->findObject('TarSecTar', $id);
        $idpaciente = $fichatar->getIdHistorialClinico()->getIdExpediente()->getIdPaciente()->getId();

        $em = $this->getDoctrine()->getManager();
        $idantecedente = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->getIdPorPaciente($idpaciente);

        $formularioid = $fichatar->getIdFormulario()->getId();
        $formulario = $this->findFormulario2($formularioid);
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object); /* object debe substituirse por la instancia de la Entity FrmFormulario que desea generarse */

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios * */
        $formGenerator = $this->container->get('form.generator.service');
        $formGeneratorB = $this->container->get('form.generator.service');
        /** Al obtener la instancia del Servicio, utilizamos el metodo generateForm($formulario, $opciones) para crear un formBuilder.
         * * El Primer Parametro es una instancia de la Entity FrmFormulario que desea generarse, y el Segundo es una Array de opciones.
         * * El metodo retorna una instancia de FormBuilder, que sirve para luego obtener un Form. Pero en este caso, para el edit
         * * omitiremos el retorno del formbuilder y solo llamamos al metodo. */
        /* $formBuilder = */
       $formBuilder = $formGenerator->generateForm($formulario, array(/* Opciones Disponibles:
              'action' => $this->generateUrl('url'),  // Action del Formulario    - DEFAULT: Ninguna
              'method' => 'POST',                     // Metodo POST o GET        - DEFAULT: POST
              'submit_button' => true,                // Boton Submit Por Defecto - DEFAULT: true */
            'submit_button_name' => 'Actualizar', // Nombre de Boton Submit   - DEFAULT: Guardar
            'add_button' => array('updateAndExit' => array('label' => 'Actualizar y Salir', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                    'type' => 'submit', // Tipo de Boton (submit, reset o button) - DEFAULT: button
                    'class' => 'btn-success', // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                    'icon' => '<span class="glyphicon glyphicon-floppy-open"></span>' // Icono dentro de boton
                )
            )
        ));

        $formBuilderB = $formGeneratorB->generateForm($this->findFormulario('FVIH05-A'), array('submit_button' => false));

        $mainIdsB = array('sec_antecedentes' => $idantecedente);
       // var_dump($mainIdsB); exit();
        /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales.
         * * Al igual que el metedo anterior, este retorna una instancia de FormBuilder, la cual puede ser  modificada (ver mas detalles en generateFormTestAction). */
        if ($idantecedente)
            $formGeneratorB->setFormData($mainIdsB);


        /** Definir un array con los Id de las tablas principales (o padres). En esto caso se desea el edit de la persona con Id 74 * */
        $mainIds = array('tar_sec_tar' => $id);

        /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales.
         * * Al igual que el metedo anterior, este retorna una instancia de FormBuilder, la cual puede ser  modificada (ver mas detalles en generateFormTestAction). */
        $formGenerator->setFormData($mainIds);

        $formBuilder->add($formBuilderB);
        /** Obtener instancia de Form (Formulario construido y seteado, que puede ser renderizado), y el cual puede ser  modificado (ver mas detalles en generateFormTestAction) * */
        $form = $formGenerator->getGeneratedForm();

        if ($this->getRestMethod() == 'POST') {
            /* Setear la Data en el Form por medio de handleRequest. Mas info: http://symfony.com/doc/master/book/forms.html#handling-form-submissions */
            $form->handleRequest($this->get('request'));

            /* var_dump('<br/><br/><b>getData After Handle Request</b><br/>');
              var_dump( $form->getData() );
              var_dump('<br/><br/><br/>'); */
            $formGeneratorB->setGeneratedForm($form->get('form'));
            /* isValid aplica los Constraints verificando que la Data del Formulario sea valida, sino renderiza los errores al Form */
            if ($form->isValid()) {

                /* Si se tienen Parametros que se desea actualizar, definirlos en un array segun su nombre, sino enviar el array vacio */

                $idhistoria = $fichatar->getIdHistorialClinico()->getId();
                $formid = $formulario->getId();
                $parameters = array('id_historial_clinico' => $idhistoria, 'id_formulario' => $formid);
                $parametersB = array();
                /* Se Actualiza la Data en la BD por medio del metodo updateDataToDB( $parameters, $mainIds)
                 * y segun la Configuracion de Guardado del Formulario en cuestion.
                 * En caso de no poder actualizar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                if ($formGenerator->updateDataToDb($parameters, $mainIds)) {

                    /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                    if ($formGeneratorB->updateDataToDb($parametersB, $mainIdsB)) {
                        /* Si todo salio bien mandamos un mensaje o redireccionado a cierta url */
                        $this->addFlash('sonata_flash_success', 'Registro exitoso!');
                    }

                    /* Si se tiene mas de un Boton de Submit, para determinar a cual boton se ha dado click utlizar lo siguiente */
                    if ($form->get('updateAndExit')->isClicked()) {
                        // ... realizar accion deseada o redireccionar
                    }
                }
            } else {
                $this->addFlash('sonata_flash_error', 'Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }

        /** Generar la Vista que se renderizara del Formulario por medio del metodo getFormView: * */
        $view = $formGenerator->getFormView();

        /*         * *******      Importante:     *************************************************************************
         * --Si el $form se genero a partir del $formBuilder y NO se ha utilizado el metodo
         *   $formGenerator->setGeneratedForm($form) la vista debe obtenerse tambien con el metodo createView:
         *   $view = $form->createView();
         *
         * --Por lo cual habra que setearle un Theme. El Theme por defecto utilizado y recomendado es el siguiente:
         *   $this->get('twig')->getExtension('form')->renderer->setTheme($view,'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig');
         */

        /* No olvidar obtener el JavaScript del FormularioDinamico. Especificar si se desea la funcionalidad de accordion que por defecto es false. */
        $itemsActionJs = $formGenerator->getItemsActionJs(array('accordion' => true));
        $itemsActionJsB = $formGeneratorB->getItemsActionJs(array('accordion' => true, 'inner' => true));

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'edit',
                    'form' => $view,
                    'object' => $object,
                    'itemsActionJs' => $itemsActionJs,
                    'itemsActionJsB' => $itemsActionJsB
        ));
    }

}
