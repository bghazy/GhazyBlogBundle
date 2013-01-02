<?php

namespace Ghazy\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('token')
            ->add('is_activated')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ghazy\BlogBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'ghazy_blogbundle_posttype';
    }
}
