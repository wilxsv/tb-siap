<?php
namespace Application\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmbedFormType extends AbstractType
{
    public $embedFormBuilder = null;
    public $autoInitialize = false;

    public function __construct($baseFormBuilder = null, $autoini = false) {
        $this->embedFormBuilder = $baseFormBuilder;
        $this->autoInitialize = $autoini;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $elements = $this->embedFormBuilder->all();
        foreach ($elements as $key => $elem){
            if($this->autoInitialize)
                $builder->add( $elem, null, array('auto_initialize'=>false) );
            else
                $builder->add( $elem, null, array() );
        }
        //$builder->add( $this->embedForm, null, array() ); Esta notacion genera otro form dentro del form principal
    }

    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TaskBundle\Entity\Tag',
        ));
    }*/

    public function getName()
    {
        return 'new';
    }
}