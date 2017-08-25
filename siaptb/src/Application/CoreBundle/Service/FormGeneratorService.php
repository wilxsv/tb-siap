<?php
namespace Application\CoreBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Application\CoreBundle\Form\DataTransformer\CommaToDotTransformer;
use Application\CoreBundle\Form\DataTransformer\DefaultDataTransformer;
use Application\CoreBundle\Form\Type\EmbedFormType;

class FormGeneratorService extends Controller{

	private $formulario = null;
    private $formBuilder = null;
	private $generatedForm = null;
	private $itemsActionJs = "";
	private $preCheckedItemsJs = "";
	private $onOffSwitchItemsJs = "";
	private $auxVar = false;


	public function __construct($container = null) {
		$this->container = $container;
	}

	public function generateForm($formulario, $formGralConfig = array('action' => null, 'method' => null, 'submit_button' => true, 'submit_button_name' => 'Guardar', 'add_button' => array() ), $band = true ){

		/*** Inicializar el Formulario ***/
        $this->formulario = $formulario;
		$defaultData = array('noItems' => 'Default init Item');

    	$formBuilder = $this->createFormBuilder($defaultData)
        			->add('noItems', 'text', array('read_only' => true, 'label'=> 'Default init Item', 'attr' => array('hidden' => 'hidden') ))
        		;

        /*** Buscar cada uno de los Items por cada Seccion y SubSeccion ***/

        $gralSections = $this->getFormGeneralSections($formulario->getId());
        if($gralSections)
        	$formBuilder->remove('noItems');

        foreach ($gralSections as $key => $section) { //Por cada Seccion (FrmFormularioSeccionPool)

            if( $section->getIsCollection() == false ){//Section is not marked as Collection
            	$formBuilder->add('section'.$section->getId(),'text', $this->getSectionArray($section) );

            	$this->setSectionItems($section, $formBuilder); //Agregar los Items y SubItems de la Seccion Actual
            }
            else{
                $this->setSectionAsCollection($section, $formBuilder);
            }

        	$sectionsCollection[''.$section->getId()] = $section; //Se agrega la Seccion a la Coleccion de Secciones
            $sectionsChilds[''.$section->getId()] = $this->getChildSections($section->getId()); //Se buscan Secciones dependientes de la Seccion Actual

            if($sectionsChilds[''.$section->getId()] != null) //Si tiene Secciones Dependientes, se agregan al Form Builder
                $this->setSubSections($sectionsCollection, $sectionsChilds, $section->getId(), $formBuilder);

        }

        if(isset($formGralConfig['action']))
	        if($formGralConfig['action'] != null){
	        	$formBuilder->setAction( $formGralConfig['action'] );
	        }

	    if(isset($formGralConfig['method']))
	        if($formGralConfig['method'] != null){
	        	$formBuilder->setMethod( $formGralConfig['method'] );
	        }
        $firstButtonAdded = false;
	    if(isset($formGralConfig['submit_button'])){
	        if($formGralConfig['submit_button'] == true){
	        	if(isset($formGralConfig['submit_button_name']))
	        		$formBuilder->add('save', 'submit', array('attr'=>array('class'=>'fd_middle_space_btn btn btn-primary', 'data-first-button'), 'label' => '<span class="glyphicon glyphicon-floppy-disk"></span> '.$formGralConfig['submit_button_name'] ));
	        	else
	        		$formBuilder->add('save', 'submit', array('attr'=>array('class'=>'fd_middle_space_btn btn btn-primary', 'data-first-button'), 'label' => '<span class="glyphicon glyphicon-floppy-disk"></span> Guardar' ));
                $firstButtonAdded = true;
	        }
	    }
	    else{
			if(isset($formGralConfig['submit_button_name']))
	        	$formBuilder->add('save', 'submit', array('attr'=>array('class'=>'fd_middle_space_btn btn btn-primary', 'data-first-button'), 'label' => '<span class="glyphicon glyphicon-floppy-disk"></span> '.$formGralConfig['submit_button_name'] ));
	        else
	        	$formBuilder->add('save', 'submit', array('attr'=>array('class'=>'fd_middle_space_btn btn btn-primary', 'data-first-button'), 'label' => '<span class="glyphicon glyphicon-floppy-disk"></span> Guardar') );
            $firstButtonAdded = true;
		}

        if( ! isset($formGralConfig['add_button']))
            $formGralConfig['add_button'] = array();
        $totalButtons = count($formGralConfig['add_button']);
        $auxCount = 0;
        foreach ($formGralConfig['add_button'] as $buttonName => $buttonConfig) {
            $auxCount++;
            if($firstButtonAdded)
                if( $auxCount == $totalButtons )
                $formBuilder->add(  $buttonName,
                                    ( isset($buttonConfig['type'] ) ? ( ( $buttonConfig['type'] == 'submit' || $buttonConfig['type'] == 'reset' ) ? $buttonConfig['type'] : 'button'  ) : 'button' ),
                                    array( 'label' => ( isset($buttonConfig['label'] ) ? ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonConfig['label'] : ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonName ), 'attr' => array( 'class' => 'fd_middle_space_btn btn '.( isset($buttonConfig['class'] ) ? $buttonConfig['class'] : '' ), 'style' =>  ( isset($buttonConfig['style'] ) ? $buttonConfig['style'] : '' ), 'data-last-button' ) )
                                );
                else
                $formBuilder->add(  $buttonName,
                                    ( isset($buttonConfig['type'] ) ? ( ( $buttonConfig['type'] == 'submit' || $buttonConfig['type'] == 'reset' ) ? $buttonConfig['type'] : 'button'  ) : 'button' ),
                                    array( 'label' => ( isset($buttonConfig['label'] ) ? ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonConfig['label'] : ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonName ), 'attr' => array( 'class' => 'fd_middle_space_btn btn '.( isset($buttonConfig['class'] ) ? $buttonConfig['class'] : '' ), 'style' =>  ( isset($buttonConfig['style'] ) ? $buttonConfig['style'] : '' ) ) )
                                );
            else
                $formBuilder->add(  $buttonName,
                                ( isset($buttonConfig['type'] ) ? ( ( $buttonConfig['type'] == 'submit' || $buttonConfig['type'] == 'reset' ) ? $buttonConfig['type'] : 'button'  ) : 'button' ),
                                array( 'label' => ( isset($buttonConfig['label'] ) ? ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonConfig['label'] : ( isset($buttonConfig['icon']) ? $buttonConfig['icon'].' ' : '' ).$buttonName ), 'attr' => array( 'class' => 'fd_middle_space_btn btn '.( isset($buttonConfig['class'] ) ? $buttonConfig['class'] : '' ), 'data-first-button', 'style' =>  ( isset($buttonConfig['style'] ) ? $buttonConfig['style'] : '' ) ) )
                            );
        }

        $this->formBuilder = $formBuilder;
        return $this->formBuilder;

	}

    public function getGeneratedForm(){
        if($this->formBuilder != null)
            $this->generatedForm = $this->formBuilder->getForm();
        return $this->generatedForm;
    }

    public function setGeneratedForm($externalForm){
        $this->generatedForm = $externalForm;
        return $this->generatedForm;
    }

	public function getSectionArray($section){
		return array('read_only' => true,
					 'required' => false,
					 'label'=> str_pad($section->getIdSeccionPool()->getIdSeccion()->getNombre(), 0, "-", STR_PAD_BOTH),
					 'attr' => array('style' => 'display: none !important;'),
					 'label_attr' => array('class' => 'fd_base_section_label ')
					);
	}

    public function setSectionAsCollection($section, &$formBuilder){
        $gralItems = $this->getSectionGralItems($section->getIdSeccionPool()->getId());
        $tempFormBuilder = $this->createFormBuilder(array());
        foreach ($gralItems as $key => $item) { //Por cada Item (FrmFormItemPool)
            $options = $this->setOptionsArray($item, $section); //Establecer opciones para el elemento a agregar segun el Item
            if( $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
                /* Sintaxis original */
                $tempFormBuilder->add('i'.$item->getId().'_s'.$section->getId(),
                              $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $item->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                              $options
                            );
            }
            else{
                /* Transformar la Coma Decimal a Punto Decimal (debido a que la coma interfiere en validaciones de JS) */
                $tempFormBuilder->add(
                    $tempFormBuilder->create('i'.$item->getId().'_s'.$section->getId(),
                                          $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $item->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                          $options
                                        )->addViewTransformer(new CommaToDotTransformer())//o usar getDataTransformer($item)
                );
            }
            /* Codigo para agregar SubItems, pero habra que arreglar en JS que le de soporte tambien. Ya que son varios inputs con similar
               id pero no igual. Esto es Factible siempre cuando el SubItem pertenezca a la misma tabla de Insercion. Por motivos de tiempo aun no se implementara. */
                /*$itemsCollection[''.$item->getId()] = $item;
                $itemsChilds[''.$item->getId()] = $this->getChildItems($item->getId());

                if($itemsChilds[''.$item->getId()] != null)
                    $this->setSubItems($section, $itemsCollection, $itemsChilds, $item->getId(), $tempFormBuilder);*/
            /* End */
        }
        $formBuilder->add('collectionSection'.$section->getId(), 'collection',
                            array('type' => new EmbedFormType($tempFormBuilder),
                                  'allow_add' => true, 'allow_delete' => true,
                                  'prototype' => true, 'prototype_name'=>'__X__', 'required'=>false,
                                  'label'=>$section->getIdSeccionPool()->getIdSeccion()->getNombre(),
                                  'label_attr' => array('class'=>'fd_collection_label ', 'for'=>'form_collection_section'.$section->getId()),
                                  'attr'=>array('class'=>'fd_collection_div')
                                ));
    }

	public function setSectionItems($section, &$formBuilder){
		$gralItems = $this->getSectionGralItems($section->getIdSeccionPool()->getId());

		foreach ($gralItems as $key => $item) { //Por cada Item (FrmFormItemPool)

			$options = $this->setOptionsArray($item, $section); //Establecer opciones para el elemento a agregar segun el Item

			/* La Sintaxis Original de agregar un elemento al formBuilder, cambia a otra Sintaxis para poder agregar
             * un dataTranformer (de tipo ViewTransformer) en caso de se necesario. Es la razon del if else a continuacion.
               Se puede hacer en una sola sentencia, para ello ver Nota al final de este Archivo. */
            if( $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
                /* Sintaxis original */
                $formBuilder->add('i'.$item->getId().'_s'.$section->getId(),
                              $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $item->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                              $options
                            );
            }
            else{
                /* Transformar la Coma Decimal a Punto Decimal (debido a que la coma interfiere en validaciones de JS) */
                $formBuilder->add(
                    $formBuilder->create('i'.$item->getId().'_s'.$section->getId(),
                                          $item->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $item->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                          $options
                                        )->addViewTransformer(new CommaToDotTransformer())//o usar getDataTransformer($item)
                );
            }

			$itemsCollection[''.$item->getId()] = $item; //Se agrega el Item a la Coleccion de Items
			$itemsChilds[''.$item->getId()] = $this->getChildItems($item->getId()); //Se buscan los Items dependientes del Item actual

			if($itemsChilds[''.$item->getId()] != null) //Si tiene Items Dependientes, se agregan tambien al Form Builder
                $this->setSubItems($section, $itemsCollection, $itemsChilds, $item->getId(), $formBuilder);
		}
	}

	public function setSubItems($section, &$itemsCollection, &$itemsChilds, $id, &$formBuilder){

		foreach ($itemsChilds[''.$id] as $key => $subItem) { //Por cada Item Dependiente encontrado

			$options = $this->setOptionsArray($subItem, $section); //Establecer opciones para el elemento a agregar segun el Item

            if( $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
                $formBuilder->add('i'.$subItem->getId().'_s'.$section->getId(),
                              $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                              $options
                            );
            }
            else{
                $formBuilder->add(
                    $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                          $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                          $options
                                        )->addViewTransformer(new CommaToDotTransformer())
                );
            }

            /* El siguiente FormEvent PRE_SUBMIT ayuda a cambiar la configuracion de un SubItem o field del Formulario,
             * si el SubItem ha sido desplegado, habilitado y seteado con un Valor por el usuario **/
			$formBuilder->addEventListener(
	            FormEvents::PRE_SUBMIT,
	            function(FormEvent $event) use ($subItem, $section, $options, $formBuilder) {

	            	if( isset( $event->getData()['i'.$subItem->getId().'_s'.$section->getId()] ) ){
	            		/** Lo habilitamos en el formBuilder y añadimos sus respectivas Validaciones o Constraints **/
		            	$options['disabled'] = false;
						$options['constraints'] = $this->generateConstraintsArray($subItem->getIdFormItem());
						$options['attr']['style'] = '';
						if( ! ($subItem->getIdFormItem()->getInscripcion() == 1 && $subItem->getIdFormItem()->getIdTipoObjeto()->getId() != 3) )
                        $options['label_attr']['style'] = str_replace('display: none;','', $options['label_attr']['style'] );

						/** Actualizamos la configuracion del formBuilder **/
                        if( $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
    		                $event->getForm()->add('i'.$subItem->getId().'_s'.$section->getId(),
    								  				$subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
    								  				$options
    											);
                        }
                        else{
                            $options['auto_initialize'] = false;//Automatic initialization is only supported on root forms
                            $event->getForm()->add(
                                $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                                      $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                      $options
                                                    )->addViewTransformer(new CommaToDotTransformer())->getForm()
                            );
                        }
	            	}
                    else{ /* Esto sirve con el Edit de Formularios Dinamicos. Si estaba seteado pero ya no, es decir, si el SubItem ha sido
                           * escondido, deshabilitado y no se ha seteado con un Valor por el usuario entonces se aplica lo contrario*/
                        $options['disabled'] = true;
                        $options['constraints'] = array();
                        $options['attr']['style'] = 'display: none;';
                        $options['label_attr']['style'] = ($options['label_attr']['style']).'display: none;' ;

                        /** Actualizamos la configuracion del formBuilder **/
                        if( $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
                            $event->getForm()->add('i'.$subItem->getId().'_s'.$section->getId(),
                                                    $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                    $options
                                                );
                        }
                        else{
                            $options['auto_initialize'] = false;//Automatic initialization is only supported on root forms
                            $event->getForm()->add(
                                $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                                      $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                      $options
                                                    )->addViewTransformer(new CommaToDotTransformer())->getForm()
                            );
                        }
                    }
	            }
        	);

            /* El siguiente FormEvent POST_SET_DATA ayuda a cambiar la configuracion de un SubItem o field del Formulario,
             * si el SubItem ha sido seteado con un valor (esto sirve para el EDIT, cuando ya el Formulario lleva data)  **/
            $formBuilder->addEventListener(
                FormEvents::POST_SET_DATA,
                function(FormEvent $event) use ($subItem, $section, $options, $formBuilder) {

                    /** Si el SubItem ha sido seteado con data **/
					//if( $event->getForm()->get('i'.$subItem->getId().'_s'.$section->getId())->getData() ||  ( $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'checkbox' ) ){
					$evalme = $event->getForm()->get('i'.$subItem->getId().'_s'.$section->getId())->getData();
                    if( isset( $evalme ) ){ //Se cambio de esta forma pues los checkbox, al ser false, no entraban en el if
                        /** Lo habilitamos en el formBuilder y añadimos sus respectivas Validaciones o Constraints **/
                        $options['data'] = $event->getForm()->get('i'.$subItem->getId().'_s'.$section->getId())->getData();
                        $options['disabled'] = false;
                        $options['constraints'] = $this->generateConstraintsArray($subItem->getIdFormItem());
                        $options['attr']['style'] = '';
						if( ! ($subItem->getIdFormItem()->getInscripcion() == 1 && $subItem->getIdFormItem()->getIdTipoObjeto()->getId() != 3) )
                        $options['label_attr']['style'] = str_replace('display: none;','', $options['label_attr']['style'] );

                        /** Actualizamos la configuracion del formBuilder **/
                        if( $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() != 'number' ){
                            $event->getForm()->add('i'.$subItem->getId().'_s'.$section->getId(),
                                                    $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                    $options
                                                );
                        }
                        else{
                            $options['auto_initialize'] = false;//Automatic initialization is only supported on root forms
                            $event->getForm()->add(
                                $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                                      $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                      $options
                                                    )->addViewTransformer(new CommaToDotTransformer())->getForm()
                            );
                        }
                    }
                }
            );

			//Verificar Modo de Visualizacion de la Pregunta
			if( !( $subItem->getValidacionPadre() == null && $subItem->getValorPadre() == null ) ){
				$this->setItemJs($subItem, $section);
			}

			$itemsCollection[''.$subItem->getId()] = $subItem; //Se agrega el Item a la Coleccion de Items
			$itemsChilds[''.$subItem->getId()] = $this->getChildItems($subItem->getId()); //Se buscan los Items dependientes del Item actual

			if($itemsChilds[''.$subItem->getId()] != null) //Si tiene Items Dependientes, se agregan tambien al Form Builder
                $this->setSubItems($section, $itemsCollection, $itemsChilds, $subItem->getId(), $formBuilder);
		}
	}

	public function setSubSections(&$sectionsCollection, &$sectionsChilds, $id, &$formBuilder){

		foreach ($sectionsChilds[''.$id] as $key => $subSection) {

            if( $subSection->getIsCollection() == false ){//Section is not marked as Collection
                $formBuilder->add('section'.$subSection->getId(),'text', $this->getSectionArray($subSection));

                $this->setSectionItems($subSection, $formBuilder); //Agregar los Items y SubItems de la Seccion Actual
            }
            else{
                $this->setSectionAsCollection($subSection, $formBuilder);
            }

        	$sectionsCollection[''.$subSection->getId()] = $subSection; //Se agrega la Seccion a la Coleccion de Secciones
            $sectionsChilds[''.$subSection->getId()] = $this->getChildSections($subSection->getId()); //Se buscan Secciones dependientes de la Seccion Actual

            if($sectionsChilds[''.$subSection->getId()] != null) //Si tiene Secciones Dependientes, se agregan al Form Builder
                $this->setSubSections($sectionsCollection, $sectionsChilds, $subSection->getId(), $formBuilder);

		}
	}

	/*** Retorna las Secciones dependientes o hijas de una determinada Seccion ***/
	public function getChildSections($idSeccionPool){
        $em = $this->getDoctrine()->getManager();
        /*$hijos = null;*/
        $dql = "SELECT fsp
                FROM ApplicationCoreBundle:FrmFormularioSeccionPool fsp
                WHERE fsp.idPadre = ".$idSeccionPool."
                ORDER BY fsp.orden";

        $result = $em->createQuery($dql)->getResult();

        /*foreach($result as $row){
            $hijos[] = $this->findObject('FrmFormularioSeccionPool',$row['id']);
        }*/

        return $result;
    }

	/*** Retorna los Item dependientes o hijos de un determinado Item ***/
	public function getChildItems($idItemPool){
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT fip
                FROM ApplicationCoreBundle:FrmFormItemPool fip
                WHERE fip.idPadre = ".$idItemPool."
                ORDER BY fip.orden";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

	/*** Retorna las Secciones Generales del Formulario, es decir, que no dependen de otra Seccion ***/
	public function getFormGeneralSections($idFormulario){
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT fsp
                FROM ApplicationCoreBundle:FrmFormularioSeccionPool fsp
                WHERE fsp.idFormulario = ".$idFormulario."
                AND fsp.idPadre is null
                ORDER BY fsp.orden ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    /*** Retorna los Items Generales de una Seccion, es decir, que no dependen de otro Item ***/
    public function getSectionGralItems($idSeccionPool){
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT fip
                FROM ApplicationCoreBundle:FrmFormItemPool fip
                WHERE fip.idSeccionPool = ".$idSeccionPool."
                AND fip.idPadre is null
                ORDER BY fip.orden ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    /*** Retorna un Array que contiene todas las opciones aplicables al Elemento que se agrega al FormBuilder
         que Depende del Tipo de Origen del Item y del Tipo de Objeto deseado ***/
    public function setOptionsArray($item, $section){
    	$options = array('label' => $item->getIdFormItem()->getNombreDescriptivo() );
    	$attr = array();
    	$label_attr = array();
    	$constraints = array();
        $label_attr['style'] = '';
        $label_attr['class'] = ' fd_base_label ';


    	$type = $item->getIdFormItem()->getIdTipoObjeto()->getCodigo();
    	$typeIdentifier = $item->getIdFormItem()->getIdTipoObjeto()->getId();
    	$origin = $item->getIdFormItem()->getTipoOrigen();

    	if( $origin == 1){
    		if( $type == 'choice'){
    			if( $typeIdentifier == 2 ){ //Select Simple
    				$options['multiple'] = false;
    				$options['expanded'] = false;
    				$options['empty_value'] = 'Seleccione...';
    				$options['empty_data']  = null;
    				$attr['class'] = 'fd_choice_select';
                    if($item->getIdFormItem()->getInscripcion()==1)
                        $label_attr['style'] = 'display: none; ';

    			}
    			else
    			if( $typeIdentifier == 3 ){ //Checkboxes (Multiples Respuestas)
    				$options['multiple'] = true;
    				$options['expanded'] = true;
    				$options['empty_data']  = null;
    				$label_attr['for'] = "form_i".$item->getId()."_s".$section->getId();
                    if($item->getIdFormItem()->getInscripcion()==1)//Esconder Titulos de Opciones?
                        $attr['class']  = 'fd_checkboxes_hidden_title';
                    if( $item->getIdFormItem()->getOcultarOpciones() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkboxes_hidden_options' : 'fd_checkboxes_hidden_options';
					if( $item->getIdFormItem()->getPreSeleccionado() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkboxes_precheck' : 'fd_checkboxes_precheck';
					if( $item->getIdFormItem()->getAplicarPluginMascara() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkboxes_onoffswitch' : 'fd_checkboxes_onoffswitch';
    			}
    			else
    			if( $typeIdentifier == 4 ){ //Radio Buttons (Una Respuesta)
    				$options['multiple'] = false;
    				$options['expanded'] = true;
    				$options['empty_value'] = 'No seleccionado...';
    				$options['empty_data']  = null;
    				$label_attr['for'] = "form_i".$item->getId()."_s".$section->getId();
					if($item->getIdFormItem()->getInscripcion()==1){
						$label_attr['style'] = 'display: none; ';
					}
    			}
    			$options['choices'] = $this->generateChoicesArray($item->getIdFormItem());
    		}
    	}
    	else{
    		if( $type == 'text' ){
    			//if( $typeIdentifier == 1 ){ //Input Text o Campo de Texto
    				$options['trim'] = true;
    				$options['empty_data']  = null;
                    /*if($item->getIdFormItem()->getInscripcion()==1)
                        $label_attr['class'] = 'fd_input_hidden_title';*/
    			//}
    		}
    		else
    		if( $type == 'date' ){
    			//if( $typeIdentifier == 5 ){ //Campo de Fecha
    				$options['widget'] = 'single_text';
    				$options['format'] = 'dd/MM/yyyy';
    				$options['input']  = "string";
					$attr['class']     = 'fd_date bootstrap-datepicker ';
					$attr['onFocus']   = 'initializeElementBootstrapDatePicker(jQuery(this)); jQuery(this).mask(\'99/99/9999\'); jQuery(this).datepicker("show");';
					//$options['trim'] = true;
					//$options['empty_data']  = null;
    				//$attr['onClick'] = 'this.setAttribute("type","text");';
					if( $item->getIdFormItem()->getAplicarPluginMascara() ){
						$attr['data-date-start-view'] = '2';
						$attr['data-date-min-view-mode'] = '1';
					}
    			//}
    		}
    		else
    		if( $type == 'birthday' ) {
    			//if( $typeIdentifier == 7 ){ //Campo de Fecha de Nacimiento
    				$options['widget'] = 'single_text';
    				$options['format'] = 'dd/MM/yyyy';
					$options['input']  = "string";
					$attr['class']     = 'fd_date bootstrap-datepicker';
					$attr['onFocus']   = 'initializeElementBootstrapDatePicker(jQuery(this)); jQuery(this).mask(\'99/99/9999\'); jQuery(this).datepicker("show");';
					$now = new \DateTime();
					$attr['data-date-end-date'] = $now->format('d-m-Y');
    				if( $item->getIdFormItem()->getAplicarPluginMascara() ){
						$attr['data-date-start-view'] = '2';
						$attr['data-date-min-view-mode'] = '1';
					}
    			//}
    		}
    		else
    		if( $type == 'time' ) {
    			//if( $typeIdentifier == 8 ){ //Campo Horas-Minutos
    				$options['widget'] = 'single_text';//Modificado de choice a single_text debido a facilidad con Js, sino crea dos select
    				$options['input'] = 'datetime';
    				$options['with_seconds'] = false;
    				$attr['class'] = 'fd_time';
    			//}
    		}
    		else
    		if( $type == 'integer' ) {
    			//if( $typeIdentifier == 6 ){ //Campo Numero Entero
    				$options['precision'] = 0; //Decimales no seran tomados en cuenta
    				$options['empty_data']  = null;
					$attr['class'] = 'fd_numeric';
					$attr['onFocus'] = 'jQuery(this).numeric();';
    			//}
    		}
    		else
    		if( $type == 'number' ) {
    			//if( $typeIdentifier == 9 ){ //Campo Numerico
    				$options['precision'] = 2; //2 decimales seran tomados en cuenta
    				$options['rounding_mode'] = NumberToLocalizedStringTransformer::ROUND_HALF_UP; //Rounds 2.5 to 3, 1.6 and 1.5 to 2 and 1.4 to 1
    				$options['empty_data']  = null;
                    $options['grouping'] = false;//Evita que sea separado por coma Ej: 1,200.5 (debido a que la coma interfiere en validaciones)
					$attr['class'] = 'fd_numeric';
					$attr['onFocus'] = 'jQuery(this).numeric();';
    			//}
    		}
    		else
    		if( $type == 'textarea' ) {
    			//if( $typeIdentifier == 10 ){ //Area de Texto Libre
    				$options['trim'] = true;
    				$options['empty_data']  = null;
					if( $item->getIdFormItem()->getAplicarPluginMascara() ){
						if( $item->getValidacionPadre() == null && $item->getValorPadre() == null && $section->getIsCollection() == false ){
							$attr['data-editor-enabled'] = 'true';
							$attr['data-editor-type'] = 'wysihtml5';
						}else{
							$attr['onFocus'] = 'if( ! jQuery(this).data("wysihtml5") ){ initializeElementWysihtml5(jQuery(this)); jQuery(this).addClass("fd_textarea_hide"); jQuery(this).siblings("iframe").addClass("fd_textarea_editor_show"); }';
						}
					}
    			//}
    		}
    		else
    		if( $type == 'email' ) {
    			//if( $typeIdentifier == 11 ){ //Correo Electronico
    				$options['trim'] = true;
    				$options['empty_data']  = null;
    			//}
    		}
            else
            if( $type == 'checkbox' ) {
                //if( $typeIdentifier == 12 ){ //Checkbox (Casilla Simple)
                    $options['required']  = false;
                    $options['empty_data']  = null;
                    $label_attr['style'] = $label_attr['style'].'float: left; margin-right: 10px;';
					if( $item->getIdFormItem()->getOcultarOpciones() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkbox_hidden_option' : 'fd_checkbox_hidden_option';
					if( $item->getIdFormItem()->getPreSeleccionado() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkboxes_precheck' : 'fd_checkboxes_precheck';
					if( $item->getIdFormItem()->getAplicarPluginMascara() )
						$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_checkboxes_onoffswitch' : 'fd_checkboxes_onoffswitch';

                //}
            }

    	}

    	/* Verificar Modo de Visualizacion de la Pregunta, Si depende de un Valor o Condicion del Item Padre se debe ocultar y deshabilitar. */
		if( ! ($item->getValidacionPadre() == null && $item->getValorPadre() == null) ){
			$attr['style'] = 'display: none;';
			$label_attr['style'] = $label_attr['style'].'display: none;';
			$options['disabled'] = true;
		}
		else{
			/** Si no depende del Valor o Condicion del Item Padre
				Determinar los Constraints (Validaciones) a aplicar al Item **/
			$options['constraints'] = $this->generateConstraintsArray($item->getIdFormItem());
		}

		/** Por defecto, los items que son NotNull seran requeridos **/
		if( $this->hasNotNullConstraint( $item->getIdFormItem() ) ){
			$options['required'] = true;
		}
		else
			$options['required'] = false;

		if( $type != 'checkbox' )
			$attr['class'] = isset( $attr['class'] ) ? $attr['class'].' fd_parent_ident' : 'fd_parent_ident';

    	$options['attr'] = $attr;
    	$options['label_attr'] = $label_attr;
        $options['help'] = $item->getIdFormItem()->getMensajeAyuda();

    	return $options;
    }

    /*** Retorna una Array que contiene las opciones disponibles del Item cuyo origen es un Catalogo ***/
    public function generateChoicesArray($formItem){
    	$choices = array();

    	$itemCatalogo = $this->getItemCatalogo($formItem->getId());
    	$habilitados = $this->getEnabledRegs($itemCatalogo, false);

    	foreach ($habilitados as $key => $opt) {
    		$choices[$opt["id"]] = $opt["desc"];
    	}

    	return $choices;
    }

    public function generateConstraintsArray($formItem){
    	$validations = $this->getItemValidations($formItem->getId());
    	$constraints = array();

    	foreach ($validations as $key => $validation) {
    		$newConstraint = $this->getConstraintObject($validation, $formItem);
    		if($newConstraint != null)
    			$constraints[] = $newConstraint;
    	}

    	return $constraints;
    }

    public function hasNotNullConstraint($formItem){
    	$validations = $this->getItemValidations($formItem->getId());

    	foreach ($validations as $key => $validation) {
    		if($validation->getIdValidacionCampo()->getId()== 3)
    			return true;
    	}

    	return false;
    }

    public function hasCheckedConstraint($formItem){
        $validations = $this->getItemValidations($formItem->getId());

        foreach ($validations as $key => $validation) {
            if($validation->getIdValidacionCampo()->getId()== 15)
                return true;
        }

        return false;
    }

    public function getConstraintObject($validation, $formItem){
    	$typeId = $validation->getIdValidacionCampo()->getId();

    	if( $typeId == 1 ){			// Igual a
    		return new Constraints\EqualTo(
    					array(
    						'value' => $validation->getValorComparacion()
    					));
    	}
    	elseif ( $typeId == 2 ){	// Diferente de
    		return new Constraints\NotEqualTo(
    					array(
    						'value' => $validation->getValorComparacion()
    					));
    	}
    	elseif( $typeId == 3 ){		// No Nulo
    		//return new Constraints\NotNull();
    			return new Constraints\NotBlank();
    	}
    	elseif( $typeId == 4 ){		// Mayor que 0
    		return new Constraints\GreaterThan(
    					array(
            				'value' => 0
        				));
    	}
    	elseif( $typeId == 5 ) {	// Rango
    		return new Constraints\Range(
    					array(
    						'min' => substr($validation->getValorComparacion(), 0, strpos($validation->getValorComparacion(), ',')),
    						'max' => substr($validation->getValorComparacion(), strpos($validation->getValorComparacion(), ',')+1 )
    					));
    	}
    	elseif ( $typeId == 6 ){	// Mayor que
    		return new Constraints\GreaterThan(
    					array(
            				'value' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 7 ){	// Menor que
    		return new Constraints\LessThan(
    					array(
            				'value' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 8 ){ 	// Mayor o igual que
    		return new Constraints\GreaterThanOrEqual(
    					array(
            				'value' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 9 ){	// Menor o igual que
    		return new Constraints\LessThanOrEqual(
    					array(
            				'value' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 10 ) { 	// Longitud Mayor que
    		return new Constraints\Length(
    					array(
            				'min' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 11 ){ 	// Longitud Menor que
    		return new Constraints\Length(
    					array(
            				'max' => $validation->getValorComparacion()
        				));
    	}
    	elseif ( $typeId == 12 ){	// Fecha Valida
    		return new Constraints\Date(
    					array(
    						'message' => 'Este valor no es una fecha valida.'
    					));
    	}
    	elseif ( $typeId == 13 ){	// Regex Match True
    		return new Constraints\Regex(
    					array(
    						'pattern' => $validation->getValorComparacion(),
				            'match'   => true,
				            'message' => 'Este valor no contiene o no coincide con los valores permitidos.'
    					));
    	}
    	elseif ( $typeId == 14 ){	// Regex Match True
    		return new Constraints\Regex(
    					array(
    						'pattern' => $validation->getValorComparacion(),
				            'match'   => false,
				            'message' => 'Este valor contiene o coincide con valores no permitidos.'
    					));
    	}
        elseif ( $typeId == 15 ) { // Checked
            return new Constraints\True(
                        array(
                            'message' => 'Debe seleccionar este elemento.',
                        ));
        }
        /*elseif ( $typeId == 16 ) { // Checked
            return new Constraints\Null(
                        array(
                            'message' => 'Este Valor deberia estar vacio.',
                        ));
        }*/
    	else
    		return null;
    }

    public function getDataTransformer($item){
        if($item->getIdFormItem()->getIdTipoObjeto()->getCodigo()=='number')
                return new CommaToDotTransformer();////Transforma la coma decimal a punto decimal (debido a que la coma interfiere en validaciones de JS)
        else
                return new DefaultDataTransformer();//No efectua ninguna conversion
    }

    public function getFormView(){
    	if($this->generatedForm != null ){
    		$view = $this->generatedForm->createView();
    		$this->get('twig')->getExtension('form')->renderer
    												->setTheme($view,
    															'ApplicationCoreBundle:FormDinamico:customFormFields.html.twig'
    														   );
    		return $view;
    	}
    	else
    		return null;
    }

    /*** Añadir Codigo JavaScript para la vizualizacion del SuItem dado ***/
    public function setItemJs($subItem, $section){

    	/*** Determinar la condicion a evaluar***/

    	$validation = $subItem->getValidacionPadre()->getCodigoValidacion();
    	$comparation = ( $subItem->getValidacionPadre()->getRequiereComparacion() ? $subItem->getValorPadre() : '' );
		$preAction = '';

    	if( $subItem->getIdPadre()->getIdFormItem()->getTipoOrigen() == 1){ //Si es de tipo Catalogo
			/* Determina si compara contra id's de registros, equivale a: $(this).val() in (1,2,3,..) */
			if($validation == '==')
				$condition = '( ( "'.$comparation.'".split(",") ).indexOf( ""+$(this).val() ) > -1 )';
			elseif($validation == '!=')
					$condition = '(! ( ( "'.$comparation.'".split(",") ).indexOf( ""+$(this).val() ) > -1 ) )';
				else
					$condition = "$(this).val() ".$validation." ".$comparation;
		}
		else{
			if($validation == 'between'){
				$condition = "fd_".$validation."($(this).val(),".$comparation.")";
			}
            elseif( $validation == 'checked' ){
                $condition = "$(this).prop('checked')";
            }
			else{
				$comparation = ( $subItem->getValidacionPadre()->getRequiereComparacion() ? ( ( is_numeric($subItem->getValorPadre()) ) ? $subItem->getValorPadre() : "'".$subItem->getValorPadre()."'" ) : '' );
				$condition = "$(this).val() ".$validation." ".$comparation;
			}
		}

		/*** Determinar el Evento deseado segun el Tipo Objeto del Item Padre***/

        $typePadre = $subItem->getIdPadre()->getIdFormItem()->getIdTipoObjeto()->getCodigo();

		if( $typePadre == 'integer' || $typePadre == 'number' || $typePadre == 'text' || $typePadre == 'textarea' || $typePadre == 'email')
			$event = 'keyup change';
		elseif( $typePadre == 'checkbox' )//Casilla Simple --> no choices (checkboxeS)
            $event = 'ifChecked ifUnchecked';
            else
			 $event = 'change';

		/*** Determinar el metodo de Cambio de Valor del elemento. ".change" ejecuta el evento change para la reaccion en cadena ***/

        $typeChild = $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo();

		if( $typeChild == 'integer' || $typeChild == 'number' || $typeChild == 'text' || $typeChild == 'textarea' || $typeChild == 'email')
			$changeValMethod = "val('').change()";
		elseif ( $typeChild == 'choice' )
				$changeValMethod = "val('').change()"; //Or select2('val','') pero solo para selects
			else
				$changeValMethod = "val('').change()";

		/*** Los Selectores se utilizan solo cuando cambiamos el val() del elemento, pues los Radio Button, y los
		 *** Checkboxes se dividen automaticamente en varios input que finalizan con un correlativo ***/

		/*** Determinar el Selector del elemento Padre, y si es necesario cambiar las variables $event y/o $codition ***/
		$typeIdentifier = $subItem->getIdPadre()->getIdFormItem()->getIdTipoObjeto()->getId();

		if( $typePadre == 'choice' ){
			if( $typeIdentifier == 2 ){ //Select Simple
    			$selectorPadre = "$('#form_i".$subItem->getIdPadre()->getId()."_s".$section->getId()."')";
    			$condition = $condition." && $(this).val()";
    		}
    		else{	//Radio Buttons (Una Respuesta) o Checkboxes (Multiples Respuestas)
    			$selectorPadre = "$('input[id^=\"form_i".$subItem->getIdPadre()->getId()."_s".$section->getId()."_\"]')";
    			$event = 'ifChecked ifUnchecked'; //Cambiamos el Evento
    			//$condition = $condition."";

    			if( $typeIdentifier == 3 ){ // En caso de ser Checkboxes cambiamos la variable $condicion
    				if($validation == '==')
    					$condition = $condition." && $(this).prop('checked') || fd_someValStillChecked('".$comparation."', ".$selectorPadre.")";
    				else
    					$condition = " fd_someValStillChecked('".$comparation."', ".$selectorPadre.") == false && $('input[id^=\"form_i".$subItem->getIdPadre()->getId()."_s".$section->getId()."_\"]:checked').length > 0 ";
    			}
    			else{//Para los radio button, se evalua si el Evento no ha sido forzado (Que el usuario no dio click en el radio button)
    				$condition = $condition." && aux != 'forced' ";
    			}

    		}
		}
		else{
			$selectorPadre = "$('#form_i".$subItem->getIdPadre()->getId()."_s".$section->getId()."')";
            if( $typePadre == 'checkbox'){
                if( $validation != 'checked' )
                    $condition = 'false';
            }
            if( $typePadre != 'checkbox'){
                if( $validation == 'checked' )
                    $condition = 'false';
            }
		}

		/*** Acciones o Eventos previos a ejecutar asociados al Padre ***/
		if( $typePadre == 'checkbox'){
			$preAction .= "
			if( ".$selectorPadre.".prop('checked') ){
				".$selectorPadre.".trigger('ifChecked');
			}else{
				".$selectorPadre.".trigger('ifUnchecked');
			}";
		}

		/** Default Enable/Disabled Method **/
		$disableMethod = "prop( 'disabled', true )";
		$enableMethod = "prop( 'disabled', false )";

		/*** Determinar el Selector del elemento Actual, y si es necesario cambiar la variables $changeValMethod, $dis/$enableMethod y/o $auxCodeFalse ***/
		$typeIdentifier = $subItem->getIdFormItem()->getIdTipoObjeto()->getId();
		$auxCodeFalse = '';
		$auxCodeTrue = '';
		$outAction = '';

		if( $typeChild == 'choice' ){
			if( $typeIdentifier == 2 ){ //Select Simple
    			$selectorChild = "$('#form_i".$subItem->getId()."_s".$section->getId()."')";
    		}
    		else{	//Radio Buttons (Una Respuesta) o Checkboxes (Multiples Respuestas)
    			$selectorChild = "$('input[id^=\"form_i".$subItem->getId()."_s".$section->getId()."_\"]')";
    			$changeValMethod = "iCheck('uncheck').trigger('ifUnchecked', 'forced')"; //Cambiamos tambien el metodo de cambio de valor, y forzamos disparar cualquier evento ligado a ifUnchecked
    			$disableMethod = "iCheck('disable')";
    			$enableMethod = "iCheck('enable')";
    			if( $typeIdentifier == 3 ){//Checkboxes
    				if( $this->hasNotNullConstraint( $subItem->getIdFormItem() ) ){
	    				$auxCheck = "
	    						$('#form_i".$subItem->getId()."_s".$section->getId()."').prepend('\
	    							<li><input type=\"checkbox\" id=\"aux_i".$subItem->getId()."_s".$section->getId()."_10000\"\
	    								name=\"form[i".$subItem->getId()."_s".$section->getId()."][]\"\
	    								value checked style=\"display: none;\">\
	    							</li>\
	    						');";
						$outAction = "
						$('form').on('submit', function(){
							if( $('input[id^=\"form_i".$subItem->getId()."_s".$section->getId()."_\"]:checked').length == 0){
								if( $('input[id^=\"form_i".$subItem->getId()."_s".$section->getId()."_\"]:enabled').length > 0){
									".$auxCheck."
								}
							}
						});";
					}
    			}
    			else{//Radio Button
    				$auxCodeFalse = "$('#form_i".$subItem->getId()."_s".$section->getId()."_placeholder').iCheck('check');"; //resetear el radio button en el placeholder
    			}
    		}
		}
		else{
			/*if( $typeChild == 'time' ){//Horas Minutos en caso de que el widget sea choice, pero debe modificarse tmabn el selector padre
				$selectorChild = "$('select[id^=\"form_i".$subItem->getId()."_s".$section->getId()."_\"]')";
			}else*/
			$selectorChild = "$('#form_i".$subItem->getId()."_s".$section->getId()."')";
            if( $typeChild == 'checkbox' ){
                $changeValMethod = "iCheck('uncheck').trigger('ifUnchecked', 'forced')"; //Cambiamos el metodo de cambio de valor, y forzamos disparar cualquier evento ligado a ifUnchecked
                $disableMethod = "iCheck('disable')";
                $enableMethod = "iCheck('enable')";
                $auxCodeFalse = $selectorChild.'.parent().parent().hide();';
                $auxCodeTrue = $selectorChild.'.parent().parent().show(); '.$selectorChild.'.parent().show();'.($subItem->getIdFormItem()->getAplicarPluginMascara() ? ' '.$selectorChild.'.parent().parent().parent().show();' : '' );
                if( $this->hasCheckedConstraint( $subItem->getIdFormItem() ) ){
                    $outAction = "
                        if( ".$selectorChild.".prop('disabled') == true ){
                            ".$auxCodeFalse."
                        }

                        $('form').on('submit', function(e){
                            if( ".$selectorChild.".prop('checked') == false ){
                                if( ".$selectorChild.".prop('disabled') == false ){
                                    if( $('#checkme_i".$subItem->getId()."_s".$section->getId()."').length > 0)
                                        $('#checkme_i".$subItem->getId()."_s".$section->getId()."').remove();
                                    $('label[for=\"form_i".$subItem->getId()."_s".$section->getId()."\"]').after('\
                                        <div id=\"checkme_i".$subItem->getId()."_s".$section->getId()."\"\
                                            style=\"float: left;margin-right: 10px;\">\
                                            <p class=\"text-danger\">Debe seleccionar este elemento.</p>\
                                        </div>\
                                    ');
                                    ".$selectorChild.".on('ifChecked', function(){
                                        if( $('#checkme_i".$subItem->getId()."_s".$section->getId()."').length > 0)
                                            $('#checkme_i".$subItem->getId()."_s".$section->getId()."').remove();
                                    });
                                    e.preventDefault();
                                }
                            }
                        });";
                }
                else{
                    $outAction = "
                        if( ".$selectorChild.".prop('disabled') == true ){
                            ".$auxCodeFalse."
                        }";
                }
            }
		}



		/*** Añadir el Codigo JavaScript ***/
		$this->itemsActionJs = $this->itemsActionJs."
			".$selectorPadre.".on('".$event."', function(e, aux){
				if( ".$condition." ){
					".( ($subItem->getIdFormItem()->getInscripcion() == 1 && $typeIdentifier != 3 ) ? "" : "$('label[for=\"form_i".$subItem->getId()."_s".$section->getId()."\"]').show();").
                    "$('#form_i".$subItem->getId()."_s".$section->getId()."').parent().show();".
                    "$('#form_i".$subItem->getId()."_s".$section->getId()."').show();
					".$selectorChild.".".$enableMethod.";
					$('#s2id_form_i".$subItem->getId()."_s".$section->getId()."').show();
					".$auxCodeTrue."
				}
				else{
					".$selectorChild.".".$changeValMethod.";
					$('label[for=\"form_i".$subItem->getId()."_s".$section->getId()."\"]').hide('drop');".
                    "$('#form_i".$subItem->getId()."_s".$section->getId()."').parent().hide();".
                    "$('#form_i".$subItem->getId()."_s".$section->getId()."').hide('drop');
					".$selectorChild.".".$disableMethod.";
					$('#s2id_form_i".$subItem->getId()."_s".$section->getId()."').hide('drop');
					".$auxCodeFalse."
				}
			});
			".$outAction.
			  $preAction."
		";
    }

    /*** Retorna todo el JavaScript generado para los Items del Formulario dentro un jQuery(document).ready(function($) ***/
    public function getItemsActionJs( $options = array('accordion' => false, 'inner' => false) ){
    	$startjQ = '	/*** Inicio Jquery Generacion de Form Dinamico ***/
    		jQuery(document).ready(function($) {
				$("body").prepend(\'\
					<div class="floating-menu">\
						<i class="fa fa-fw fa-bars"></i>\
						<div class="nav-tabs-custom floating-menu-options">\
                                <ul class="nav nav-tabs ">\
									<li class="pull-left header"><i style="font-size: 15px;" class="fa fa-fw fa-bars"></i> </li>\
                                    <li class="active"><a href="#tab_1-1" data-toggle="tab"><i style="font-size: 12px;" class="fa fa-fw fa-bookmark"></i> Ir a Secci&oacute;n</a></li>\
									<!--<li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>\
                                    <li class="dropdown">\
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">\
                                            Dropdown <span class="caret"></span>\
                                        </a>\
                                        <ul class="dropdown-menu">\
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>\
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>\
                                            <li role="presentation" class="divider"></li>\
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>\
                                        </ul>\
                                    </li>-->\
                                </ul>\
                                <div class="tab-content">\
                                    <div class="tab-pane active" id="tab_floating-menu-sections">\
                                    </div>\
                                    <div class="tab-pane" id="tab_2-2">\
                                        Other Options.\
                                    </div>\
                                </div>\
                        </div>\
					</div>\
				\')';
    	$endjQ = '});
		/*** Fin JQuery Generacion de Form Dinamico ***/';

		$this->addBetweenFunction();
        $this->addSomeValidStillChecked();
		$this->addPreCheckedJs();
		$this->addOnOffSwitchJs();

        if( isset($options['accordion']) ){
            if( $options['accordion'] == true ){
				if( isset($options['inner']) ){
					if( $options['inner'] == true )
						$this->addAccordionInnerFormFunctionality();
					else
						$this->addAccordionFunctionality();
				}
				else
                	$this->addAccordionFunctionality();
			}
        }

    	return $startjQ.$this->itemsActionJs.$this->preCheckedItemsJs.$this->onOffSwitchItemsJs.$endjQ;
    }

    /*** Retorna la funcion Js fd_between que determina si un valor se encuentra entre un rango ***/
    public function addBetweenFunction(){
    	$this->itemsActionJs = $this->itemsActionJs."
    		function fd_between(valueX, min, max){
    			return (valueX >= min && valueX <= max);
    		};
    	";
    }

    public function addSomeValidStillChecked(){
    	$this->itemsActionJs = $this->itemsActionJs."
    		function fd_someValStillChecked(validValues, checkInputs){
    			found = false;
    			checkInputs.each(function(){
    				if( ( ( validValues.split(',') ).indexOf( ''+$(this).val() ) > -1 ) && $(this).prop('checked') ){
    					found = true;
    				}
    			});
				return found;
    		}
    	";
    }

	public function addPreCheckedJs(){
		//$typeIdentifier = $item->getIdFormItem()->getIdTipoObjeto()->getId();

		// if( $typeIdentifier == 3 ){//Checkboxes (Multiple)
		// 	$this->preCheckedItemsJs = $this->preCheckedItemsJs."
		// 		$('input[id^=\"form_i".$item->getId()."_s".$section->getId()."_\"]').iCheck('check').trigger('ifChecked');
		// 	";
		// }
		// else{//Checkbox
		// 	$this->preCheckedItemsJs = $this->preCheckedItemsJs."
		// 		$('input[id^=\"form_i".$item->getId()."_s".$section->getId()."\"]').iCheck('check').trigger('ifChecked');
		// 	";
		// }
		$this->preCheckedItemsJs = $this->preCheckedItemsJs."
			$('.fd_checkboxes_precheck').each(function(){
				if($(this).is('input')){
					$(this).iCheck('check').trigger('ifChecked');
				}
				else{
					$( \"input[id^=\"+$(this).attr('id')+\"_]\" ).iCheck('check').trigger('ifChecked');
				}
			});
		";

	}

	public function addOnOffSwitchJs(){

		$this->onOffSwitchItemsJs = $this->onOffSwitchItemsJs."
			$('.fd_checkboxes_onoffswitch').each(function(){
				if($(this).is('input')){
					//$(this).parent().hide();
					$(this).parent().css('width','auto');
					$(this).parent().prepend('\
						<div class=\"onoffswitch\" id=\"onoff_'+$(this).attr('id')+'\">\
							<label class=\"onoffswitch-label\" for=\"'+$(this).attr('id')+'\">\
								<span class=\"onoffswitch-inner\" data-switch-on-label=\"Sí\" data-switch-off-label=\"No\"></span>\
								<span class=\"onoffswitch-switch\"></span>\
							</label>\
						</div>\
					');
					$(this).prependTo( $('#onoff_'+$(this).attr('id')) ).addClass('onoffswitch-checkbox');
				}
				else{
					$( \"input[id^=\"+$(this).attr('id')+\"_]\" ).each(function(){
						$(this).parent().hide();
						$(this).parent().after('\
							<div class=\"onoffswitch\" id=\"onoff_'+$(this).attr('id')+'\">\
								<label class=\"onoffswitch-label\" for=\"'+$(this).attr('id')+'\">\
									<span class=\"onoffswitch-inner\" data-switch-on-label=\"Sí\" data-switch-off-label=\"No\"></span>\
									<span class=\"onoffswitch-switch\"></span>\
								</label>\
							</div>\
						');
						$(this).prependTo( $('#onoff_'+$(this).attr('id')) ).addClass('onoffswitch-checkbox');
					});
				}
			});
		";

	}


    public function addAccordionFunctionality(){
        $this->itemsActionJs = $this->itemsActionJs."
            $('label[for^=\"form_section\"]').each(function(){
                var secNum = $(this).attr('for').replace('form_section','');
                $(this).parent().wrap('<div id=\"labelSection'+secNum+'\"><h4></h4></div>');
                $(this).prepend('<span id=\"displaySection'+secNum+'\" class=\"glyphicon glyphicon-resize-small fd_section_accordion_button\"></span>');
                $('label[for$=\"s'+secNum+'\"]').parent().wrapAll('<div id=\"divSection'+secNum+'\" />');
				$('#tab_floating-menu-sections').append('<a href=\"#labelSection'+secNum+'\"><i style=\"font-size: 6px;\" class=\"fa fa-fw fa-circle\"></i>'+$(this).text()+'</a>');
            });

            $('label[for^=\"form_collection_section\"]').each(function(){
                var secNum = $(this).attr('for').replace('form_collection_section','');
                //$(this).wrap('<div id=\"labelSection'+secNum+'\"><h4></h4></div>');
                $(this).prepend('<span id=\"displaySection'+secNum+'\" class=\"glyphicon glyphicon-resize-small fd_section_accordion_button_cl\"></span>');
                $('div[id$=\"form_collectionSection'+secNum+'\"]').parent().wrapAll('<div id=\"divSection'+secNum+'\" />');
				$('#tab_floating-menu-sections').append('<a href=\"#form_collectionSection'+secNum+'\"><i style=\"font-size: 6px;\" class=\"fa fa-fw fa-circle\"></i>'+$(this).text()+'</a>');
            });

            $('span[id^=\"displaySection\"]').on('click', function(){
                var secNum = $(this).attr('id').replace('displaySection','');
                if( $('#divSection'+secNum).is(':hidden') ){
                    $('#divSection'+secNum).show('blind');
					$(this).attr('class', $(this).attr('class').replace('full','small') );
                }
                else{
                    $('#divSection'+secNum).hide('blind');
					$(this).attr('class', $(this).attr('class').replace('small','full') );
                }
            });
        ";
    }

	public function addAccordionInnerFormFunctionality(){
		$this->itemsActionJs = $this->itemsActionJs."
			$('label[for^=\"form_form_section\"]').each(function(){
				var secNum = $(this).attr('for').replace('form_form_section','');
				$(this).parent().wrap('<div id=\"labelSection'+secNum+'\"><h4></h4></div>');
				$(this).prepend('<span id=\"displaySectionInner'+secNum+'\" class=\"glyphicon glyphicon-resize-small fd_section_accordion_button\"></span>');
				$('label[for$=\"s'+secNum+'\"]').parent().wrapAll('<div id=\"divSection'+secNum+'\" />');
			});

			// $('label[for^=\"form_collection_section\"]').each(function(){
			// 	var secNum = $(this).attr('for').replace('form_collection_section','');
			// 	//$(this).wrap('<div id=\"labelSection'+secNum+'\"><h4></h4></div>');
			// 	$(this).prepend('<span id=\"displaySectionInner'+secNum+'\" class=\"glyphicon glyphicon-resize-small fd_section_accordion_button_cl\"></span>');
			// 	$('div[id$=\"form_collectionSection'+secNum+'\"]').parent().wrapAll('<div id=\"divSection'+secNum+'\" />');
			// });

			$('span[id^=\"displaySectionInner\"]').on('click', function(){
				var secNum = $(this).attr('id').replace('displaySectionInner','');
				if( $('#divSection'+secNum).is(':hidden') ){
					$('#divSection'+secNum).show('blind');
					$(this).attr('class', $(this).attr('class').replace('full','small') );
				}
				else{
					$('#divSection'+secNum).hide('blind');
					$(this).attr('class', $(this).attr('class').replace('small','full') );
				}
			});
		";
	}

    public function saveDataToDB( $paramsArray = array(), $mainIdForGroup = array() ){
        /*var_dump('<br/><br/><b>generatedForm->getData</b><br/>');
        var_dump( $this->generatedForm->getData() );*/

        $formData = $this->generatedForm->getData();

        $auxSection = [];
        foreach ($formData as $key => $value) {
            $auxSection[ substr( $key, 1, strpos( $key , '_') - 1 ) ] = substr( $key, strpos( $key , '_') + 2 );
        }

        //$formData = $requestForm; si se hace con el request
        $connection = $this->container->get('database_connection');

        $insertGroups = $this->getInsertGroupsByForm($this->formulario->getId());
        $groupCollection = array();
        $notDefinedParams = array();
		$firstId = false;

        if( $insertGroups ){
            $connection->beginTransaction();
            try{
                foreach ( $insertGroups as $key => $group ){ //Por cada Grupo de Insercion (Insert)
                    $sqlFields          = [];
                    $sqlValues          = [];
                    $sqlStatement       = "";
                    $multipleInserts    = false;
                    $collectionInserts  = false;
                    $collectionSection  = null;
                    $itemValidations    = [];
                    $skipInsert         = false;
					$pivotItem['data']  = [];
					$pivotItem['field'] = null;

					if( $group->getInsercionFalsa() ){
						if( isset( $mainIdForGroup[$group->getTablaDestino()] ) ){
							//$sqlStatement = "SELECT id".( ( count($sqlFields) ) > 0 ? ', ' : '' ).implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()];
							$sqlStatement = "SELECT * FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()];
							$stm  = $connection->prepare($sqlStatement);
							$stm->execute();
							$result = $stm->fetchAll();
							$groupCollection[$group->getId()] = $result[0];
						}
						else{
							$this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar buscar la data.
									El <b>Id primario</b> para la Tabla <b>'.$group->getTablaDestino().' no </b> ha sido definido.<br/>
									Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.<br/>
									Nota: El Id solicitado, se utiliza dentro Grupo de Insercion Falso.');
							return false;
						}
					}
					else{

	                    $groupSkips = $this->getSkipsByGroup( $group->getId() ); //Obtener las omisiones de insert configurados para grupo

	                    $skipInsert = $this->getSkipEvaluation( $formData, $groupSkips, $auxSection );

	                    $itemsSaveConfig = $this->getItemsByGroup( $group->getId() ); //Obtener los items configurados del grupo de insercion

	                    foreach ($itemsSaveConfig as $key => $itemConfig) { //por cada item configurado en el grupo de insercion

	                        $itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();
	                        //var_dump('<br/><b>'.$itemInputName.'<b/><br/>');
	                        /* Evaluar si se debe Omitir el Insert*/
	                        if($skipInsert)
	                            break;

	                        if( $itemConfig->getIdFormularioSeccionPool()->getIsCollection() == true ){
	                            $collectionInserts = true;
	                            $collectionSection = $itemConfig->getIdFormularioSeccionPool();
	                            break;
	                        }

	                        if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() != 3 ){//Si No es Checkboxes (Multiples Respuestas)
	                            //var_dump('<br/>Normal<br/>');
	                            if( isset( $formData[$itemInputName] ) ){ //Si el valor esta seteado en el formulario
	                                $sqlFields[] = $itemConfig->getCampoDestino();
	                                $sqlValues[$itemConfig->getCampoDestino()] = $this->transformToDb($formData[$itemInputName], $itemConfig->getIdFormItemPool());
	                            }
	                            else{
	                                $sqlFields[] = $itemConfig->getCampoDestino();
	                                $sqlValues[$itemConfig->getCampoDestino()] = 'DEFAULT';
	                            }
	                        }
	                        else{//Es Checkboxes (Multiples Respuestas) --> requiere Multiples Inserts
								$multipleInserts = true;
	                            if( isset( $formData[$itemInputName] ) ){ //Si el valor esta seteado en el formulario
	                                $multipleInserts = true;
									$pivotItem['data'] = $formData[$itemInputName];
									$pivotItem['field'] = $itemConfig->getCampoDestino();
	                            }
	                        }
	                    }

	                    if( ! $skipInsert ){

	                        $paramsConfig = $this->getParamsByGroup( $group->getId() );
	                        if( $paramsConfig ){
	                            foreach ($paramsConfig as $key => $parameter) {
	                                if( isset( $paramsArray[$parameter->getNombre()] ) ){
	                                    $sqlFields[] = $parameter->getCampoDestino();
	                                    $sqlValues[$parameter->getCampoDestino()] = $this->transformToDb($paramsArray[$parameter->getNombre()]);;
	                                }
	                                else{
	                                    $notDefinedParams[] = $parameter->getNombre();
	                                }
	                            }
	                        }

	                        $dependencies = $this->getGroupDependency( $group->getId() ); //Verificar si es dependiente de otro
	                        if( $dependencies ){ //Si el Grupo es dependiente de Otro
	                            foreach ($dependencies as $key => $dependency) {

	                                if ( isset( $groupCollection[$dependency->getIdGrupoInsercionPadre()->getId()] ) ){ //Si no se ha omitido el Insert del Grupo Padre
	                                    $sqlFields[] = $dependency->getCampoDestino();
	                                    $sqlValues[$dependency->getCampoDestino()] = $groupCollection[$dependency->getIdGrupoInsercionPadre()->getId()][$dependency->getCampoOrigen()];
	                                }
	                                else{
	                                    $skipInsert = true;
	                                    break;
	                                }
	                            }
	                        }

	                        if( ! $skipInsert ){

	                            if( count($notDefinedParams) == 0 ){
	                                if( $collectionInserts == true ){// Si es Collection !
	                                    foreach ($formData['collectionSection'.$collectionSection->getId()] as $keyRow => $collectionRow) {

	                                        $collectionSqlFields = [];
	                                        $collectionSqlValues = [];

	                                        foreach ( $itemsSaveConfig as $keyField => $itemConfig) {
	                                            $itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();
	                                            $collectionSqlFields[] = $itemConfig->getCampoDestino();
	                                            $collectionSqlValues[] = $this->transformToDb($collectionRow[$itemInputName], $itemConfig->getIdFormItemPool());
	                                        }

	                                        $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).", ".implode(', ', $collectionSqlFields).")
	                                                         VALUES (".implode(', ', $sqlValues).", ".implode(', ', $collectionSqlValues).") RETURNING *";

	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
											$groupCollection[$group->getId()] = $result[0]; //Guardamos los valores del Grupo de Insercion, en caso de que se utilicen como padre de alguno dependiente
	                                    }
	                                }
	                                elseif( $multipleInserts == false ){//Insert Normal, No Multiples Inserts
	                                    $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).") VALUES (".implode(', ', $sqlValues).") RETURNING *";
	                                    $stm  = $connection->prepare($sqlStatement);
	                                    $stm->execute();
	                                    $result = $stm->fetchAll();//Retorna los valores de la nueva fila insertada realizado por medio de RETURNING *
										$groupCollection[$group->getId()] = $result[0]; //Guardamos los valores del Grupo de Insercion, en caso de que se utilicen como padre de alguno dependiente
	                                    foreach ($result[0] as $column => $value) { //verificar si todos los campos devueltos estan seteados en $sqlValues (Ej. el ID generado)
	                                        if( ! isset($sqlValues[$column]) ){
	                                            $sqlValues[$column] = $value;
	                                        }
	                                    }
										if( ! $firstId )
											$firstId = $result[0]['id'];
	                                }
	                                else{
	                                    //$sqlFields[] = $itemConfig->getCampoDestino();
	                                    $sqlFields[] = $pivotItem['field'];
	                                    //foreach ($formData[$itemInputName] as $input => $data)
	                                    foreach ($pivotItem['data'] as $input => $data) {
	                                        //$sqlValues[$itemConfig->getCampoDestino()] = $data;
	                                        $sqlValues[$pivotItem['field']] = $data;
	                                        $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).") VALUES (".implode(', ', $sqlValues).") RETURNING *;";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();//Retorna los valores de la nueva fila insertada realizado por medio de RETURNING *
											/*Guarda el ultimo Id generado, esto sirve para los multiple checkboxes de una sola respuesta */
											$groupCollection[$group->getId()] = $result[0]; //Guardamos los valores del Grupo de Insercion, en caso de que se utilicen como padre de alguno dependiente
	                                    }


	                                    foreach ($result[0] as $column => $value) { //verificar si todos los campos devueltos estan seteados en $sqlValues (Ej. el ID generado)
	                                        if( ! isset($sqlValues[$column]) ){
	                                            $sqlValues[$column] = $value;
	                                        }
	                                    }
	                                    //$sqlValues[$itemConfig->getCampoDestino()] = $formData[$itemInputName];
	                                    $sqlValues[$pivotItem['field']] = $pivotItem;
	                                }

	                                //$groupCollection[$group->getId()] = $sqlValues; //Guardamos los valores del Grupo de Insercion, en caso de que se utilicen como padre de alguno dependiente
	                                //$groupCollection[$group->getId()] = $result[0]; //Guardamos los valores del Grupo de Insercion, en caso de que se utilicen como padre de alguno dependiente
	                            }
	                            else{
	                                $connection->rollback();
	                                $list = '<ul>';
	                                foreach ($notDefinedParams as $key => $notDefined) {
	                                    $list = $list.'<li>'.$notDefined.'</li>';
	                                }
	                                $list = $list.'</ul>';
	                                $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar guardar los datos.
	                                    Los siguientes <b>parametros no</b> han sido definidos:<br/>'.$list.'
	                                    Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.');
	                                return false;
	                            }
	                        }
	                    }
					}
                }
                $connection->commit();
                return $firstId;
            }catch (\Exception $e) {
                $connection->rollback();
                $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar guardar los datos.
                    Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.'.$e);
                return false;
                //throw $e;
            }
        }
        else{
            $this->get('session')->getFlashBag()->add('warning', 'El Formulario actual no posee <b>Configuración de Guardado</b>.');
            return false;
        }

    }

    public function getSkipEvaluation($formData, $skips, $auxSection){

        foreach ( $skips as $key => $skip ) {
            $typeId = $skip->getIdValidacionCampo()->getId();
            $itemType = $skip->getIdFormItemPool()->getIdFormItem()->getTipoOrigen();
            $objectType = $skip->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId();
            $itemInputName = 'i'.$skip->getIdFormItemPool()->getId().'_s'.$auxSection[ $skip->getIdFormItemPool()->getId() ];

            if( $typeId == 1 ){         // Igual a
                if( isset( $formData[$itemInputName] ) ){ //Ver si es de tipo Catalogo y luego si es checkboxes!!!!!!!!!!!!!!
                    if($itemType == 1){
                        if($objectType == 3){ //Checkboxes
                            $compareArray = explode(',', $skip->getValorComparacion() );
                            foreach ($formData[$itemInputName] as $key => $value) {
                                if( in_array( $value, $compareArray ) )
                                    return true;
                            }
                        }
                        else{
                            if( in_array( $formData[$itemInputName], explode(',', $skip->getValorComparacion() ) ) )
                                return true;
                        }
                    }
                    else{
                        if( $formData[$itemInputName] == ( $skip->getValorComparacion() == 'null' ? null : ( $skip->getValorComparacion() == 'true' ? true : ( $skip->getValorComparacion() == 'false' ? false : ( is_numeric($skip->getValorComparacion()) ? (float)$skip->getValorComparacion() : $skip->getValorComparacion() ) ) ) ) )
                            return true;
                    }
                }
                else{
                    if( null == ( $skip->getValorComparacion() == 'null' ? null : $skip->getValorComparacion() ) )
                        return true;
                }
            }
            elseif ( $typeId == 2 ){    // Diferente de
                if( isset( $formData[$itemInputName] ) ){//Ver si es de tipo Catalogo y luego si es checkboxes!!!!!!!!!!!!!!
                    if($itemType == 1){
                        if($objectType == 3){ //Checkboxes
                            $compareArray = explode(',', $skip->getValorComparacion() );
                            foreach ($formData[$itemInputName] as $key => $value) {
                                if( ! in_array( $value, $compareArray ) )
                                    return true;
                            }
                        }
                        else{
                            if( ! in_array( $formData[$itemInputName], explode(',', $skip->getValorComparacion() ) ) )
                                return true;
                        }
                    }
                    else{
                        if( $formData[$itemInputName] != ( $skip->getValorComparacion() == 'null' ? null : ( $skip->getValorComparacion() == 'true' ? true : ( $skip->getValorComparacion() == 'false' ? false : ( is_numeric($skip->getValorComparacion()) ? (float)$skip->getValorComparacion() : $skip->getValorComparacion() ) ) ) ) )
                            return true;
                    }
                }
                else{
                    if( null != ( $skip->getValorComparacion() == 'null' ? null : $skip->getValorComparacion() ) )
                        return true;
                }
            }
            elseif( $typeId == 3 ){     // No Nulo
                if( isset( $formData[$itemInputName] ) )
                    if( $itemType == 1 ){
                        if( $objectType == 3 )
                            if( count( $formData[$itemInputName] ) > 0 )
                                return true;
                        else
                            return true;
                    }
                    else
                        return true;
            }
            elseif( $typeId == 4 ){     // Mayor que 0
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] > 0 )
                        return true;
            }
            elseif( $typeId == 5 ) {    // Rango
                if( isset( $formData[$itemInputName] ) ){
                    $rangeValues = explode(',', $skip->getValorComparacion() );
                    if( $formData[$itemInputName] > (float)$rangeValues[0] &&  $formData[$itemInputName] < (float)$rangeValues[1] )
                        return true;
                }
            }
            elseif ( $typeId == 6 ){    // Mayor que
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] > (float)$skip->getValorComparacion() )
                        return true;
            }
            elseif ( $typeId == 7 ){    // Menor que
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] < (float)$skip->getValorComparacion() )
                        return true;
            }
            elseif ( $typeId == 8 ){    // Mayor o igual que
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] >= (float)$skip->getValorComparacion() )
                        return true;
            }
            elseif ( $typeId == 9 ){    // Menor o igual que
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] <= (float)$skip->getValorComparacion() )
                        return true;
            }
            /* --- No utilizados aun para este tipo de validacion ---
            elseif ( $typeId == 10 ) {  // Longitud Mayor que

            }
            elseif ( $typeId == 11 ){   // Longitud Menor que

            }
            elseif ( $typeId == 12 ){   // Fecha Valida

            }
            elseif ( $typeId == 13 ){   // Regex Match True

            }
            elseif ( $typeId == 14 ){   // Regex Match True

            }*/
            elseif ( $typeId == 15 ) { // Checked
                if( isset( $formData[$itemInputName] ) )
                    if ( $formData[$itemInputName] )
                        return true;
            }
            elseif ( $typeId == 16 ) { // Null
                if( ! isset( $formData[$itemInputName] ) )
                    return true;
                else
                    if( $itemType == 1 ){
                        if( $objectType == 3 )
                            if( count( $formData[$itemInputName] ) <= 0 )
                                return true;
                    }
                    else
                        if( $formData[$itemInputName] == null )
                            return true;



            }
        }
        return false;
    }

    /*** Busca y Retorna el Catalogo asociado al Item ***/
    public function getItemCatalogo($idFormItem) {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT ic.id
                FROM ApplicationCoreBundle:FrmFormItemCatalogo ic
                WHERE ic.idFormItem = ".$idFormItem."";

        $result = $em->createQuery($dql)->getArrayResult();

        $FrmFormItemCatalogo = $this->findObject('FrmFormItemCatalogo', $result[0]["id"]);

        return $FrmFormItemCatalogo;
    }

    /*** Retorna los registros habilitados de un catalogo segun el campo "habilitados"
    	 Si asString es true : Retorna un string con el formato id1,id2,...,idn
    	 Si asString es false: Retorna un Array con el Id y Desc de cada opcion ***/
    public function getEnabledRegs($ItemCatalogo, $asString = false){

        $em = $this->getDoctrine()->getManager();
        $regString = null;

        $dql = "SELECT r.idRegistro
                FROM ApplicationCoreBundle:FrmItemCatalogoReg r
                WHERE r.idFormItemCatalogo = ".$ItemCatalogo->getId()."";

        $regs = $em->createQuery($dql)->getArrayResult();
        if($regs != null){
            $ids = array();
            foreach ($regs as $row) {
                $ids[]=$row["idRegistro"];
            }
            $regString = implode(',', $ids);
        }

        if($asString){
            return $regString;
        }
        else{

            $sql = "SELECT c.".$ItemCatalogo->getIdCatalogo()->getIdCampo()->getNombre()." as id,
                           c.".$ItemCatalogo->getIdCatalogo()->getIdCampoDescripcion()->getNombre()." as desc".
                    " FROM ".$ItemCatalogo->getIdCatalogo()->getIdCampo()->getIdTabla()->getNombre()." c".
                    " WHERE c.id in (".$regString.")";
            $sql = "SELECT c.".$ItemCatalogo->getIdCatalogo()->getIdCampo()->getNombre()." as id,
						   c.".$ItemCatalogo->getIdCatalogo()->getIdCampoDescripcion()->getNombre()." as desc".
					" FROM ".$ItemCatalogo->getIdCatalogo()->getIdCampo()->getIdTabla()->getNombre()." c".
					" INNER JOIN frm_item_catalogo_reg er
					  ON c.id = er.id_registro".
					" WHERE c.id in (".$regString.")
					  AND er.id_form_item_catalogo = ".$ItemCatalogo->getId()."
					  ORDER BY er.orden";

            $stm  = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();


            return $result;
        }
    }

    /*** Busca y Retorna las validaciones asociadas al Item ***/
    public function getItemValidations($idFormItem) {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT v
                FROM ApplicationCoreBundle:FrmValidacionCampoFormItem v
                WHERE v.idFormItem = ".$idFormItem."";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function getInsertGroupsByForm($idForm){ //Retorna los Grupos de Insercion de un Formulario
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT g
                FROM ApplicationCoreBundle:FrmGrupoInsercion g
                WHERE g.idFormulario = ".$idForm."
                ORDER BY g.id ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function getItemsByGroup($idGroup){ //Retorna la configuracion de Items de un Grupo de Insercion
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT si
                FROM ApplicationCoreBundle:FrmFormSeccionItem si
                WHERE si.idGrupoInsercion = ".$idGroup."
                ORDER BY si.id ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function getParamsByGroup($idGroup){
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT p
                FROM ApplicationCoreBundle:FrmInsercionParametro p
                WHERE p.idGrupoInsercion = ".$idGroup."
                ORDER BY p.id ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function getGroupDependency($idGroup){ //Retorna las dependencias de un grupo si es dependiente de otros
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT d
                FROM ApplicationCoreBundle:FrmInsercionDependencia d
                WHERE d.idGrupoInsercionDependiente = ".$idGroup."
                ORDER BY d.id ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function getSkipsByGroup($idGroup){ //Retorna la configuracion de Omisiones de un Grupo de Insercion
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT o
                FROM ApplicationCoreBundle:FrmInsercionOmision o
                WHERE o.idGrupoInsercion = ".$idGroup."
                ORDER BY o.id ASC";

        $result = $em->createQuery($dql)->getResult();

        return $result;
    }

    public function transformToDb($data, $formItemPool = null){
        /*var_dump('<br/>Data: ');
        var_dump($data);
        var_dump('<br/>Type: '.gettype($data).'<br/>');*/
        $type = gettype($data);
		$codType = $formItemPool ? $formItemPool->getIdFormItem()->getIdTipoObjeto()->getCodigo() : null;

        if( $type == "string" && ( $codType == 'date' || $codType == 'birthday') ){ //Se realiza de esta forma para los cambios realizados en date y birthday
            if( $data=='' )
				return "NULL";
			else
				return "'".$data."'";
        }
		elseif( $type == "string" ){
			return "'".$data."'";
		}
        elseif(is_a($data,'DateTime')) { //Es Fecha
            return "'".$data->format('Y-m-d H:i:s')."'";
        }
        elseif( $type == "boolean"){
            if($data == true)
                return "TRUE";
            else
                return "FALSE";
        }
        elseif ( $type == "NULL") {
            return "NULL";
        }
        else
            return $data;
    }

    public function getFormSavedData($formulario, $mainIdForGroup = array(), $transform = true ){
        /*** Inicializar el Formulario ***/
        $this->formulario = $formulario;

        //$mainIdUsed = false;
        $insertGroups = $this->getInsertGroupsByForm($this->formulario->getId());
        $connection = $this->container->get('database_connection');
        $sections = array();
        $itemsCollection = array();
        $sectionsCollection = array();
        $groupResult = [];

        foreach( $insertGroups as $key => $group ) {

            $sqlFields    = [];
            $sqlValues    = [];
            $sqlStatement = "";
            $sqlDepFields = [];
            $sqlDepValues = [];
            $auxMatch     = [];
            $isCollection = false;
            $isMultiple   = false;
			$multipleChange = false;
            $sqlAux       = '';
            $skipSelect   = false;

			if( $group->getInsercionFalsa() ){
				if( isset( $mainIdForGroup[$group->getTablaDestino()] ) ){
					//$sqlStatement = "SELECT id".( ( count($sqlFields) ) > 0 ? ', ' : '' ).implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()];
					$sqlStatement = "SELECT * FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()].( $group->getAuxFilterSelect() != null ? ' '.$group->getAuxFilterSelect() : '' );
					$stm  = $connection->prepare($sqlStatement);
					$stm->execute();
					$result = $stm->fetchAll();
				}
				else{
					$this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar buscar la data.
							El <b>Id primario</b> para la Tabla <b>'.$group->getTablaDestino().' no </b> ha sido definido.<br/>
							Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.<br/>
							Nota: El Id solicitado, se utiliza dentro Grupo de Insercion Falso.');
					return false;
				}
			}
			else{

	            $dependencies = $this->getGroupDependency( $group->getId() );

	            $itemsSaveConfig = $this->getItemsByGroup( $group->getId() ) ;

	            foreach( $itemsSaveConfig as $key => $itemConfig ) {
	                //$itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();
	                $sqlFields[] = $itemConfig->getCampoDestino();

	                $sections[$itemConfig->getIdFormularioSeccionPool()->getId()]['id'] = $itemConfig->getIdFormularioSeccionPool()->getId();
	                $sections[$itemConfig->getIdFormularioSeccionPool()->getId()]['name'] = $itemConfig->getIdFormularioSeccionPool()->getIdSeccionPool()->getIdSeccion()->getNombre();
	                $sections[$itemConfig->getIdFormularioSeccionPool()->getId()]['isCollection'] = $itemConfig->getIdFormularioSeccionPool()->getIsCollection();

	                $isCollection = $itemConfig->getIdFormularioSeccionPool()->getIsCollection();
					$isMultiple = ($itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 3) ? true : false;
					if($isMultiple){
						$multipleChange = true;
					}

	                $auxMatch[$itemConfig->getCampoDestino()] = array('section' => $itemConfig->getIdFormularioSeccionPool()->getId(),
	                                                                  'item'    => $itemConfig->getIdFormItemPool()->getId()
	                                                                 );

	                $itemsCollection[$itemConfig->getIdFormItemPool()->getId()] = $itemConfig->getIdFormItemPool();
	                $sectionsCollection[$itemConfig->getIdFormularioSeccionPool()->getId()] = $itemConfig->getIdFormularioSeccionPool();

	                if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 3 || ($itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 2 && $isCollection) ){//Para checkboxes (creo que aqui seria para 2, 3 y 4)
	                    $itemCatalog = $this->getItemCatalogo($itemConfig->getIdFormItemPool()->getIdFormItem()->getId());
	                    $sqlAux = $sqlAux.' AND '.$itemConfig->getCampoDestino().' IN ('.$this->getEnabledRegs($itemCatalog , true).')';
											if( ! $this->hasNotNullConstraint( $itemConfig->getIdFormItemPool()->getIdFormItem() ) ) //En los Collection, si algun campo queda null, ya no se toma en cuenta en los registros del select por que no cumple el IN, por eso se ha agregadp la siguiente linea
												$sqlAux = $sqlAux.' OR '.$itemConfig->getCampoDestino().' is NULL';
	                }

	                /* Para que todos los items salgan en el show debe ser similar a esto.... Verificar luego
	                if( $isCollection == false && $isMultiple == false){
	                    $sections[ $itemConfig->getIdFormularioSeccionPool()->getId() ]['items'][ 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId() ] = array('name'  => $itemConfig->getIdFormItemPool()->getIdFormItem()->getNombreDescriptivo(),
	                                                                  'value' => null
	                                                                 );
	                }*/

	            }

				if($multipleChange){ //Si alguno de los Items del grupo es Checkboxes (multipleChange es true)
					if( count( $itemsSaveConfig ) > 1 ){ //Si ademas del Item de Tipo Checkboxes existen otros configurados
						$isMultiple = false;
					}
					else{
						$isMultiple = true;
					}
				}

	            if( ! ( count( $dependencies ) > 0 ) ){
	                if( isset( $mainIdForGroup[$group->getTablaDestino()] ) ){
	                    $sqlStatement = "SELECT id".( ( count($sqlFields) ) > 0 ? ', ' : '' ).implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()].( $group->getAuxFilterSelect() != null ? ' '.$group->getAuxFilterSelect() : '' );
	                }
	                else{
	                    $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar buscar la data.
	                            El <b>Id primario</b> para la Tabla <b>'.$group->getTablaDestino().' no </b> ha sido definido.<br/>
	                            Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.');
	                    return false;
	                }
	            }
	            else{
	                foreach ($dependencies as $key => $dependency ) {
	                    if( isset( $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0] ) ){
	                        $sqlDepFields[] = $dependency->getCampoDestino();
	                        $sqlDepValues[] = $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0][$dependency->getCampoOrigen()];
	                    }
	                    else{
	                        $skipSelect = true;
	                        $result = array();
	                        break;//sale del for
	                    }
	                }
	                if( ! $skipSelect ){
	                    $sqlStatement = "SELECT id".( ( count($sqlFields) ) > 0 ? ', ' : '' ).implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE";
	                    foreach ($sqlDepFields as $key => $field) {
	                        $sqlStatement .= " ".$field." = ".$sqlDepValues[$key];
	                        if(isset($sqlDepValues[$key+1]))
	                            $sqlStatement .= " AND";
	                    }
	                    // if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 3 ){
	                    //     $sqlStatement = $sqlStatement.$sqlAux;
	                    // }
						$sqlStatement = $sqlStatement.$sqlAux;
						$sqlStatement = $sqlStatement.( $group->getAuxFilterSelect() != null ? ' '.$group->getAuxFilterSelect() : '' );
	                }
	            }
	            //var_dump('<br/><br/><br/><b>-------------------------------------------Select del Grupo: '.$group->getId().'----------------------------<b/><br/>'.$sqlStatement);
	            if( ! $skipSelect ){
	                $stm  = $connection->prepare($sqlStatement);
	                $stm->execute();
	                $result = $stm->fetchAll();
	            }

	            //var_dump('<br/><b> Resultado <b/><br/>');
	            //var_dump($result);
				if( $isCollection == false && $isMultiple == false && $multipleChange == true && $transform == false ){ //Significa que el Grupo de Insercion tiene un Item de Checkboxes, pero incluye mas items configurados que son de otro tipo. Esto solo es necesario en Edicion (transform = false)
					foreach ($result as $row) {
						foreach ($row as $field => $value) {
							if($field != 'id'){
								$secId  = $auxMatch[$field]['section'];
								$itemId = $auxMatch[$field]['item'];
								if($itemsCollection[$itemId]->getIdFormItem()->getIdTipoObjeto()->getId() == 3){
									/*$sections[ $secId ]['items'][ $itemId ]['multiple'][ $row['id'] ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
																											'value' => $value
																											);*/
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple'][ 'name' ] = $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo();
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['value'][ 'id'.$row['id'] ] = ($transform ? $this->transformToShow( $value, $itemsCollection[$itemId] ) : $value);
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['hideTitle'] = ($itemsCollection[$itemId]->getIdFormItem()->getInscripcion() == 1 ? true : false);
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['itemObject'] = $itemsCollection[$itemId];
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['level'] = $this->getItemLevel($itemsCollection[$itemId]);
								}else{
									$secId  = $auxMatch[$field]['section'];
									$itemId = $auxMatch[$field]['item'];
									$sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
																		'value' => ($transform ? $this->transformToShow( $value, $itemsCollection[$itemId] ) : $value),
																		'hideTitle' => ($itemsCollection[$itemId]->getIdFormItem()->getInscripcion() == 1 ? true : false),
																		'itemObject' => $itemsCollection[$itemId],
																		'order' => $itemsCollection[$itemId]->getOrden(),
																		'level' => $this->getItemLevel($itemsCollection[$itemId])
																		);
								}
							}
						}
					}
				}
	            elseif( $isCollection == false && $isMultiple == false ){
	                foreach ($result as $row) {
	                    foreach ($row as $field => $value) {
	                        if($field != 'id'){
	                            $secId  = $auxMatch[$field]['section'];
	                            $itemId = $auxMatch[$field]['item'];
	                            $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
	                                                                  'value' => ($transform ? $this->transformToShow( $value, $itemsCollection[$itemId] ) : $value),
																	  'hideTitle' => ($itemsCollection[$itemId]->getIdFormItem()->getInscripcion() == 1 ? true : false),
																	  'itemObject' => $itemsCollection[$itemId],
																	  'order' => $itemsCollection[$itemId]->getOrden(),
																	  'level' => $this->getItemLevel($itemsCollection[$itemId])
	                                                                 );
	                        }
	                    }
	                }
	            }
	            else{
	                foreach ($result as $row) {
	                    foreach ($row as $field => $value) {
	                        if($field != 'id'){
	                            $secId  = $auxMatch[$field]['section'];
	                            $itemId = $auxMatch[$field]['item'];
	                            if($sections[$secId]['isCollection']){
	                                /*$sections[ $secId ]['items']['collection'][ $row['id'] ][ $itemId ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
	                                                                                                            'value' => $value
	                                                                                                           );*/
	                                $sections[ $secId ]['collection'][ 'id'.$row['id'] ][ 'i'.$itemId.'_s'.$secId ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
	                                                                                                            'value' => ($transform ? $this->transformToShow( $value, $itemsCollection[$itemId] ) : $value),
	                                                                                                            'hideTitle' => ($itemsCollection[$itemId]->getIdFormItem()->getInscripcion() == 1 ? true : false),
																												//'itemObject' => $itemsCollection[$itemId]
	                                                                                                           );
	                            }
	                            else{
	                                /*$sections[ $secId ]['items'][ $itemId ]['multiple'][ $row['id'] ] = array('name'  => $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo(),
	                                                                                                          'value' => $value
	                                                                                                         );*/
	                                $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple'][ 'name' ] = $itemsCollection[$itemId]->getIdFormItem()->getNombreDescriptivo();
	                                $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['value'][ 'id'.$row['id'] ] = ($transform ? $this->transformToShow( $value, $itemsCollection[$itemId] ) : $value);
	                                $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['hideTitle'] = ($itemsCollection[$itemId]->getIdFormItem()->getInscripcion() == 1 ? true : false);
	                                $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['itemObject'] = $itemsCollection[$itemId];
	                                $sections[ $secId ]['items'][ 'i'.$itemId.'_s'.$secId ]['multiple']['level'] = $this->getItemLevel($itemsCollection[$itemId]);
	                            }
	                        }
	                    }
	                }
	            }
			}

            $groupResult[$group->getId()] = $result;
        }

		//$order = getOrderStructure($sectionsCollection);

        // echo '<pre>';
		// print_r($sections);
		// echo '</pre>';
		// exit();
        return $sections;
    }

    public function transformToShow( $value, $formItemPool ){
        $origin = $formItemPool->getIdFormItem()->getTipoOrigen();
        $type = $formItemPool->getIdFormItem()->getIdTipoObjeto()->getCodigo();
        if( ! $value ){
			if( $type == 'checkbox' ){
				if($value === null)
					return '--';
				else
					return 'No';
			}
			else
            	return $value;
        }
        elseif( $origin == 1 ){
            $itemCatalogo = $this->getItemCatalogo( $formItemPool->getIdFormItem()->getId() );
            return $this->getRegDescriptor( $value, $itemCatalogo );
        }
        elseif( $type == 'date' || $type == 'birthday' ){
            $date = new \DateTime($value);
            return $date->format('d-m-Y');
        }
        elseif( $type == 'time' ){
            $date = new \DateTime($value);
            return $date->format('H:i');
        }
        elseif( $type == 'checkbox' ){
            return ( $value == true ? 'Si' : 'No' );
        }
        else
            return $value;
    }

    public function getRegDescriptor($value, $itemCatalogo){

        $sql = "SELECT c.".$itemCatalogo->getIdCatalogo()->getIdCampo()->getNombre()." as id,
                c.".$itemCatalogo->getIdCatalogo()->getIdCampoDescripcion()->getNombre()." as desc".
                " FROM ".$itemCatalogo->getIdCatalogo()->getIdCampo()->getIdTabla()->getNombre()." c".
                " WHERE c.id = ".$value."";

        $stm  = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]['desc'];
    }

    public function setFormData($mainIdForGroup = array()){
        $savedData = $this->getFormSavedData( $this->formulario, $mainIdForGroup, false );
		//var_dump($savedData);
        foreach ($savedData as $section) {
            if($section['isCollection']){
                $dataArray = [];
				if( isset( $section['collection'] ) ){
	                foreach ($section['collection'] as $key => $row) {
	                    foreach ($row as $item => $data) {
	                        $dataArray[$key][$item] = $this->transformToEdit( $data['value'], null, $this->formBuilder->get('collectionSection'.$section['id'])->getOption('type')->embedFormBuilder->get($item)->getType()->getName() );
	                    }
	                }
				}

                $this->formBuilder->get('collectionSection'.$section['id'])->setData($dataArray)->setDataLocked(true);
            }
            else{
                if( isset( $section['items'] ) ){
                    foreach ($section['items'] as $item => $data) {
                        if(isset($data['multiple'])){
                            $this->formBuilder->get($item)->setData( $data['multiple']['value'] )->setDataLocked(true);
                            //En este momento se ejecuta el FormEvents::POST_SET_DATA
                        }
                        else{
                            $this->formBuilder->get($item)->setData( $this->transformToEdit( $data['value'], $item ) )->setDataLocked(true);
                            //En este momento se ejecuta el FormEvents::POST_SET_DATA
                        }

                    }
                }
            }
        }

        return $this->formBuilder;
    }

    public function transformToEdit( $value, $item, $type = null ){

        if($type == null)
            $type = $this->formBuilder->get($item)->getType()->getName();

        if( ! $value ){
            return $value;
        }
        /*elseif( $type == 'date' || $type == 'birthday' ){ // Se ha comentado de esta forma ya que en la configuracion de campos de tipo fecha se tiene que:
            $date = new \DateTime($value);				    // $options['format'] = 'dd/MM/yyyy'; $options['input']  = "string";
            return $date;					                // Por lo cual ya no necesita un Date sino un string en formato Y-m-d (que ya lo trae de postgres)
        }*/													// ya que dd/MM/yyyy es solo para presentacion al usuario. Se podria hacer tambien retornando $date->format('Y-m-d')
		elseif( $type == 'time'){
			$date = new \DateTime($value);
			return $date;
		}
        /*elseif( $type == 'checkbox' ){
            return $value == 'Si' ? true : false;
        }*/
        /*elseif( $type == 'choice')
            return (int)$value;*/
        else
            return $value;
    }

    public function updateDataToDB( $paramsArray = array(), $mainIdForGroup = array() ){
        /*var_dump('<br/><br/><b>generatedForm->getData</b><br/>');
        var_dump( $this->generatedForm->getData() );*/

        $formData = $this->generatedForm->getData();

        $auxSection = [];
        foreach ($formData as $key => $value) {
            $auxSection[ substr( $key, 1, strpos( $key , '_') - 1 ) ] = substr( $key, strpos( $key , '_') + 2 );
        }

        $connection = $this->container->get('database_connection');

        $insertGroups = $this->getInsertGroupsByForm($this->formulario->getId());
        $groupCollection = array();
        $notDefinedParams = array();

        if( $insertGroups ){
            $connection->beginTransaction();
            try{
                foreach ( $insertGroups as $key => $group ){ //Por cada Grupo de Insercion (Insert)
                    $sqlFields         = [];
                    $sqlValues         = [];
                    $sqlStatement      = "";
                    $sqlDepFields      = [];
                    $sqlDepValues      = [];
                    $multipleInserts   = false;
                    $collectionInserts = false;
                    $collectionSection = null;
                    $sqlAux            = '';
                    $skipUpdate        = false;
					$result            = null;

					if( $group->getInsercionFalsa() ){
						if( isset( $mainIdForGroup[$group->getTablaDestino()] ) ){
							//$sqlStatement = "SELECT id".( ( count($sqlFields) ) > 0 ? ', ' : '' ).implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()];
							$sqlStatement = "SELECT * FROM ".$group->getTablaDestino()." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()].( $group->getAuxFilterSelect() != null ? ' '.$group->getAuxFilterSelect() : '' );
							$stm  = $connection->prepare($sqlStatement);
							$stm->execute();
							$result = $stm->fetchAll();
							$groupResult[$group->getId()] = $result;
						}
						else{
							$this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar buscar la data.
									El <b>Id primario</b> para la Tabla <b>'.$group->getTablaDestino().' no </b> ha sido definido.<br/>
									Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.<br/>
									Nota: El Id solicitado, se utiliza dentro Grupo de Insercion Falso.');
							return false;
						}
					}
					else{

	                    $groupSkips = $this->getSkipsByGroup( $group->getId() ); //Obtener las omisiones de insert configurados para grupo

	                    $skipUpdate = $this->getSkipEvaluation( $formData, $groupSkips, $auxSection );

	                    $itemsSaveConfig = $this->getItemsByGroup( $group->getId() ); //Obtener los items configurados del grupo de insercion

	                    foreach ($itemsSaveConfig as $key => $itemConfig) { //por cada item configurado en el grupo de insercion
	                        if( $itemConfig->getIdFormularioSeccionPool()->getIsCollection() == true ){
	                            $collectionInserts = true;
	                            $collectionSection = $itemConfig->getIdFormularioSeccionPool();
	                            break;
	                        }

	                        $itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();

	                        if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() != 3 ){//Si No es Checkboxes (Multiples Respuestas)
	                            if( isset( $formData[$itemInputName] ) ){ //Si el valor esta seteado en el formulario
	                                $sqlFields[] = $itemConfig->getCampoDestino();
	                                $sqlValues[$itemConfig->getCampoDestino()] = $this->transformToDb($formData[$itemInputName], $itemConfig->getIdFormItemPool());
	                            }
	                            else{
	                                $sqlFields[] = $itemConfig->getCampoDestino();
	                                $sqlValues[$itemConfig->getCampoDestino()] = 'DEFAULT';
	                            }

	                            if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 2 || $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 4  ){//Para Selects y Radio buttons
	                                $itemCatalog = $this->getItemCatalogo($itemConfig->getIdFormItemPool()->getIdFormItem()->getId());
	                                $sqlAux = $sqlAux.' AND '.$itemConfig->getCampoDestino().' IN ('.$this->getEnabledRegs($itemCatalog , true).')';
	                            }
	                        }
	                        else{//Es Checkboxes (Multiples Respuestas) --> requiere Multiples Inserts
								// El sqlAux para Checkboxes lo hago despues porque puede que sea necesario o no lo sea.
								// $itemCatalog = $this->getItemCatalogo($itemConfig->getIdFormItemPool()->getIdFormItem()->getId());
								// $sqlAux = $sqlAux.' AND '.$itemConfig->getCampoDestino().' IN ('.$this->getEnabledRegs($itemCatalog , true).')';
								$multipleInserts = true;
	                            if( isset( $formData[$itemInputName] ) ){ //Si el valor esta seteado en el formulario
	                                $multipleInserts = true;
									$pivotItem['data'] = $formData[$itemInputName];
									$pivotItem['field'] = $itemConfig->getCampoDestino();
									$pivotItem['inputName'] = $itemInputName;
	                            }
	                        }
	                    }

	                    $paramsConfig = $this->getParamsByGroup( $group->getId() );
	                    if( $paramsConfig ){
	                        foreach ($paramsConfig as $key => $parameter) {
	                            if( isset( $paramsArray[$parameter->getNombre()] ) ){
	                                $sqlFields[] = $parameter->getCampoDestino();
	                                $sqlValues[$parameter->getCampoDestino()] = $this->transformToDb($paramsArray[$parameter->getNombre()]);;
	                            }
	                            else{//No es necesario actualizar todos los parametros (verificar)
	                                //$notDefinedParams[] = $parameter->getNombre();
	                            }
	                        }
	                    }

	                    $dependencies = $this->getGroupDependency( $group->getId() ); //Verificar si es dependiente de otro
	                    if( $dependencies ){ //Si el Grupo es dependiente de Otro
	                        foreach ($dependencies as $key => $dependency) {
	                            if( isset( $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0] ) ){
	                                $sqlFields[] = $dependency->getCampoDestino();
	                                $sqlValues[$dependency->getCampoDestino()] = $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0][$dependency->getCampoOrigen()];
	                            }
	                            else{
	                                $skipUpdate = true;
	                                $result = array();
	                                break;
	                            }
	                        }
	                    }

	                    if( ! $skipUpdate ){
	                        if( count($notDefinedParams) == 0 ){
	                            if( $collectionInserts == true ){// Si es Collection

	                                /* Eliminar las filas que ya no estan en el Collection, y que si lo estaban */
	                                if($this->formBuilder->get('collectionSection'.$collectionSection->getId())->getData())
	                                foreach ($this->formBuilder->get('collectionSection'.$collectionSection->getId())->getData() as $keyRow => $collectionRow) {
	                                    if( ! (isset( $formData['collectionSection'.$collectionSection->getId()][$keyRow] ) ) ){
	                                        $sqlStatement = "DELETE FROM ".$group->getTablaDestino()." WHERE id = ".str_replace( 'id', '', $keyRow).";";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
	                                    }
	                                    else{
	                                        /* Actualizar los que no han sido eliminados pero siguen ahi */
	                                        $collectionSqlFields = [];
	                                        $collectionSqlValues = [];

	                                        foreach ( $itemsSaveConfig as $keyField => $itemConfig) {
	                                            $itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();
	                                            $collectionSqlFields[] = $itemConfig->getCampoDestino();
	                                            $collectionSqlValues[$itemConfig->getCampoDestino()] = $this->transformToDb($formData['collectionSection'.$collectionSection->getId()][$keyRow][$itemInputName], $itemConfig->getIdFormItemPool());
	                                        }

	                                        $sqlStatement = "UPDATE ".$group->getTablaDestino()." SET ".$this->fieldValueUpdateString( $sqlFields, $sqlValues ).", ".$this->fieldValueUpdateString( $collectionSqlFields, $collectionSqlValues )." WHERE id = ".str_replace( 'id', '', $keyRow)." RETURNING *;";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
	                                    }
	                                }

	                                /* Agregar las filas que estan en el Collection, y que no lo estaban */
	                                foreach ($formData['collectionSection'.$collectionSection->getId()] as $keyRow => $collectionRow) {
	                                    if( ! (isset( $this->formBuilder->get('collectionSection'.$collectionSection->getId())->getData()[$keyRow] ) ) ){

	                                        $collectionSqlFields = [];
	                                        $collectionSqlValues = [];

	                                        foreach ( $itemsSaveConfig as $keyField => $itemConfig) {
	                                            $itemInputName = 'i'.$itemConfig->getIdFormItemPool()->getId().'_s'.$itemConfig->getIdFormularioSeccionPool()->getId();
	                                            $collectionSqlFields[] = $itemConfig->getCampoDestino();
	                                            $collectionSqlValues[] = $this->transformToDb($collectionRow[$itemInputName], $itemConfig->getIdFormItemPool());
	                                        }

	                                        $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).", ".implode(', ', $collectionSqlFields).")
	                                                         VALUES (".implode(', ', $sqlValues).", ".implode(', ', $collectionSqlValues).") RETURNING *";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
	                                    }
	                                }

	                            }
	                            elseif( $multipleInserts == false ){//Update Normal, No Multiples Updates
	                                if( ! ( count( $dependencies ) > 0 ) ){
	                                    if( isset( $mainIdForGroup[$group->getTablaDestino()] ) ){
	                                        $sqlStatement = "UPDATE ".$group->getTablaDestino()." SET ".$this->fieldValueUpdateString( $sqlFields, $sqlValues )." WHERE id = ".$mainIdForGroup[$group->getTablaDestino()].( $group->getAuxFilterUpdate() != null ? ' '.$group->getAuxFilterUpdate() : '' )." RETURNING *;";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();

	                                        if( ! ( count( $result ) > 0 ) ){ //Si no devulve rows, es porque ninguna fila fue afectada, por tanto se debe hacer la insercion
	                                            $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).") VALUES (".implode(', ', $sqlValues).") RETURNING *";
	                                            $stm  = $connection->prepare($sqlStatement);
	                                            $stm->execute();
	                                            $result = $stm->fetchAll();//Retorna los valores de la nueva fila insertada realizado por medio de RETURNING *

	                                        }

	                                        $groupResult[$group->getId()] = $result;
	                                    }
	                                    else{
	                                        $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar actualizar los datos.
	                                                El <b>Id primario</b> para la Tabla <b>'.$group->getTablaDestino().' no </b> ha sido definido.<br/>
	                                                Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.');
	                                        return false;
	                                    }
	                                }
	                                else{
	                                    foreach ($dependencies as $key => $dependency ) {
	                                        $sqlDepFields[] = $dependency->getCampoDestino();
	                                        $sqlDepValues[] = $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0][$dependency->getCampoOrigen()];
	                                    }
	                                    $sqlStatement = "UPDATE ".$group->getTablaDestino()." SET ".$this->fieldValueUpdateString( $sqlFields, $sqlValues )." WHERE";
	                                    foreach ($sqlDepFields as $key => $field) {
	                                        $sqlStatement .= " ".$field." = ".$sqlDepValues[$key];
	                                        if(isset($sqlDepValues[$key+1]))
	                                            $sqlStatement .= " AND";
	                                    }
	                                    if( $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 2 || $itemConfig->getIdFormItemPool()->getIdFormItem()->getIdTipoObjeto()->getId() == 4 ){
	                                        $sqlStatement = $sqlStatement.$sqlAux;
	                                    }//Este if creo q no va

	                                    $sqlStatement .= ( $group->getAuxFilterUpdate() != null ? ' '.$group->getAuxFilterUpdate() : '' )." RETURNING *;";

	                                    $stm  = $connection->prepare($sqlStatement);
	                                    $stm->execute();
	                                    $result = $stm->fetchAll();

	                                    if( ! ( count( $result ) > 0 ) ){ //Si no devulve rows, es porque ninguna fila fue afectada, por tanto se debe hacer la insercion

	                                        $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).") VALUES (".implode(', ', $sqlValues).") RETURNING *";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();//Retorna los valores de la nueva fila insertada realizado por medio de RETURNING *
	                                    }

	                                    $groupResult[$group->getId()] = $result;
	                                }

	                            }
	                            else{//Multiples Inserts (Checkboxes)
	                                //$sqlFields[] = $itemConfig->getCampoDestino();
									$sqlFields[] = $pivotItem['field'];
	                                $resultChange = false;
									//$updateKeys = [];
	                                //$sqlAux = '';
									//if($pivotItem['inputName']=='i407_s140'){
	                                // var_dump('<b>'.$pivotItem['inputName'].': </b><br/>');
	                                // var_dump($this->formBuilder->get($pivotItem['inputName'])->getData());
	                                // var_dump('<br/><br/>');
	                                // var_dump($pivotItem['data']);
	                                // var_dump('<br/><br/>');}
	                                /* Eliminar las opciones que ya no estan marcadas en los checkboxes, y que si lo estaban */
	                                //if($this->formBuilder->get($itemInputName)->getData())
	                                if($this->formBuilder->get($pivotItem['inputName'])->getData())
	                                //foreach ($this->formBuilder->get($itemInputName)->getData() as $key => $value) {
	                                foreach ($this->formBuilder->get($pivotItem['inputName'])->getData() as $key => $value) {
	                                    //if( ! (isset( $formData[$itemInputName][$key] ) ) ){
	                                    if( ! (isset( $pivotItem['data'][$key] ) ) ){
	                                        /*var_dump('<br/>************ CAMBIO 1 ******************<br/>');*/
	                                        /* Este DELETE no depende del id propio del registro, sino de los demas valores:
	                                            $sqlStatement = "DELETE FROM ".$group->getTablaDestino()." WHERE";
	                                            foreach ($sqlDepFields as $key => $field) {
	                                                $sqlStatement .= " ".$field." = ".$sqlDepValues[$key];
	                                                if(isset($sqlDepValues[$key+1]))
	                                                    $sqlStatement .= " AND";
	                                            }
	                                            $sqlStatement .= " AND ".$itemConfig->getCampoDestino()." = ".$value;*/
	                                        /* En este caso Eliminaremos segun Id */
	                                        $sqlStatement = "DELETE FROM ".$group->getTablaDestino()." WHERE id = ".str_replace( 'id', '', $key).";";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
	                                    }
										else{
											//$updateKeys[] = $key;
											if( count( $itemsSaveConfig ) > 1 ){
												$sqlValues[ $pivotItem['field'] ] = $pivotItem['data'][$key];
												$sqlStatement = "UPDATE ".$group->getTablaDestino()." SET ".$this->fieldValueUpdateString( $sqlFields, $sqlValues )." WHERE id = ".str_replace( 'id', '', $key)." RETURNING *;";
												$stm  = $connection->prepare($sqlStatement);
												$stm->execute();
												$result = $stm->fetchAll();
												$resultChange = true;
											}
										}
	                                }

									// if( count($updateKeys) > 0 && count( $itemsSaveConfig ) > 1 )
									// foreach($updateKeys as $key){
									// 	$sqlValues[ $pivotItem['field'] ] = $pivotItem['data'][$key];
									// 	$sqlStatement = "UPDATE ".$group->getTablaDestino()." SET ".$this->fieldValueUpdateString( $sqlFields, $sqlValues )." WHERE id = ".str_replace( 'id', '', $key)." RETURNING *;";
									// 	if($pivotItem['inputName']=='i407_s140') var_dump('<br/>SQL: '.$sqlStatement.'<br/>');
									// 	$stm  = $connection->prepare($sqlStatement);
									// 	$stm->execute();
									// 	$result = $stm->fetchAll();
									// 	$resultChange = true;
									// }

	                                /* Agregar las opciones que estan marcadas en los checkboxes, y que no lo estaban */
	                                //foreach ($formData[$itemInputName] as $key => $value) {
	                                foreach ($pivotItem['data'] as $key => $value) {
	                                    //if( ! (isset( $this->formBuilder->get($itemInputName)->getData()[$key] ) ) ){
	                                    if( ! (isset( $this->formBuilder->get($pivotItem['inputName'])->getData()[$key] ) ) ){
	                                        /*var_dump('<br/>************ CAMBIO 2 ******************<br/>');*/
	                                        //$sqlValues[$itemConfig->getCampoDestino()] = $value;
	                                        $sqlValues[ $pivotItem['field'] ] = $value;
	                                        $sqlStatement = "INSERT INTO ".$group->getTablaDestino()." (".implode(', ', $sqlFields).")
	                                                         VALUES (".implode(', ', $sqlValues).") RETURNING *;";
	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();
	                                        $resultChange = true;
	                                    }
	                                }

	                                if($resultChange == false){
	                                    if($this->hasGroupDependencies($group->getId())){ //Determina si el grupo posee dependientes
	                                        foreach ($dependencies as $key => $dependency ) {
	                                            $sqlDepFields[] = $dependency->getCampoDestino();
	                                            $sqlDepValues[] = $groupResult[$dependency->getIdGrupoInsercionPadre()->getId()][0][$dependency->getCampoOrigen()];
	                                        }
	                                        $sqlStatement = "SELECT id, ".implode(', ', $sqlFields)." FROM ".$group->getTablaDestino()." WHERE";
	                                        foreach ($sqlDepFields as $key => $field) {
	                                            $sqlStatement .= " ".$field." = ".$sqlDepValues[$key];
	                                            if(isset($sqlDepValues[$key+1]))
	                                                $sqlStatement .= " AND";
	                                        }

	                                        $itemCatalog = $this->getItemCatalogo($itemConfig->getIdFormItemPool()->getIdFormItem()->getId());
	                                        $sqlAux = $sqlAux.' AND '.$itemConfig->getCampoDestino().' IN ('.$this->getEnabledRegs($itemCatalog , true).')';

	                                        $sqlStatement = $sqlStatement.$sqlAux.( $group->getAuxFilterSelect() != null ? ' '.$group->getAuxFilterSelect() : '' );

	                                        $stm  = $connection->prepare($sqlStatement);
	                                        $stm->execute();
	                                        $result = $stm->fetchAll();

	                                    }
	                                }
	                                $groupResult[$group->getId()] = $result;
	                            }
	                        }
	                        else{
	                            $connection->rollback();
	                            $list = '<ul>';
	                            foreach ($notDefinedParams as $key => $notDefined) {
	                                $list = $list.'<li>'.$notDefined.'</li>';
	                            }
	                            $list = $list.'</ul>';
	                            $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar guardar los datos.
	                                Los siguientes <b>parametros no</b> han sido definidos:<br/>'.$list.'
	                                Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.');
	                            return false;

	                        }
	                    }//Fin If skipUpdate = false
					}
                }
                $connection->commit();
                return true;
            }catch (\Exception $e) {
                $connection->rollback();
                $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Se ha producido un <b>error</b> al intentar actualizar los datos.
                    Si el problema persiste, consulte con el <b>Administrador</b> o verifique la <b>Configuración de Guardado</b> del Formulario.'.$e);
                return false;
                //throw $e;
            }
        }
        else{
            $this->get('session')->getFlashBag()->add('warning', 'El Formulario actual no posee <b>Configuración de Guardado</b>.');
            return false;
        }
    }

    public function fieldValueUpdateString( $sqlFields, $sqlValues ){
        $asignations = [];
        foreach ($sqlFields as $key => $field) {
            $asignations[] = $field.' = '.$sqlValues[$field];
        }
        return implode(', ', $asignations);
    }

	public function getOrderStructure(){
		$orderStructure = array();
		$gralSections = $this->getFormGeneralSections( $this->formulario->getId() );

		foreach ($gralSections as $key => $section) { //Por cada Seccion (FrmFormularioSeccionPool)

			$this->setSectionItems($section, $formBuilder); //Agregar los Items y SubItems de la Seccion Actual
			$orderStructure[ $section->getId() ] = array( 'id'    => $section->getId(),
														  'order' => $section->getOrden(),
														  'items' => $getItemsOrder( $section )
														);

			$subSections[  $section->getId() ] = $this->getChildSections( $section->getId() ); //Se buscan Secciones dependientes de la Seccion Actual

			if($subSections[ $section->getId() ] != null) //Si tiene Secciones Dependientes, se agregan al Form Builder
				$this->setSubSections($sectionsCollection, $sectionsChilds, $section->getId(), $formBuilder);

		}

	}

    public function hasGroupDependencies($groupId) { //Determina si un grupo posee dependientes

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT d.id
                FROM ApplicationCoreBundle:FrmInsercionDependencia d
                WHERE d.idGrupoInsercionPadre = :idGroup";

        $result = $em->createQuery($dql)
                ->setParameters(array(':idGroup'=>$groupId))
                ->getArrayResult();

        if(count($result) > 0)
            return true;
        else
            return false;
    }

	public function getItemLevel($item, $level = 0){
		if ( $item->getIdPadre() ){
			$level++;
			return $this->getItemLevel($item->getIdPadre(), $level);
		}
		else{
			$level++;
			return $level;
		}

	}

    private function findObject($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository('ApplicationCoreBundle:'.$entity)->findOneById($id);
        return $foundObject;
    }

}

/* Sintaxis Alternativa de una sola sentencia para agregar elementos al formBuilder, la cual estandariza la Sintaxis
   independientemente si se quiere o no agregar un DataTransformer, Ya que DefaultDataTransformer (ver Metodo getDataTransformer)
   no realiza ninguna conversion. Pero se quito para no afectar el rendimiento. */
/*
    $formBuilder->add(
                $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                      $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                      $options
                                    )->addViewTransformer($this->getDataTransformer($subItem))
            );

    //Para el PRE::SUBMIT
    $event->getForm()->add(
                            $formBuilder->create('i'.$subItem->getId().'_s'.$section->getId(),
                                                  $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo() == 'date' ? 'date' : $subItem->getIdFormItem()->getIdTipoObjeto()->getCodigo(),
                                                  $options
                                                )->addViewTransformer($this->getDataTransformer($subItem))->getForm()
                        );

*/
