<?php
namespace Application\CoreBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HelpMessageTypeExtension extends AbstractTypeExtension
{
	/* getExtendedType method is used to indicate the name of the form type that will be extended by your extension.
     * To allow every FormType be extended by this extensions, it return field the base FormType. */

    public function getExtendedType()
    {
        return 'form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('help', $options['help']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help'] = $form->getConfig()->getAttribute('help');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'help' => null,
        ));
    }

    /* public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('help'));
    }*/
}