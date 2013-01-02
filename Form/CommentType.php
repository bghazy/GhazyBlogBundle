<?php

namespace Ghazy\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	    ->add('email')
            ->add('body', null, array('label' => 'Comment'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ghazy\BlogBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'ghazy_blogbundle_commenttype';
    }
}
