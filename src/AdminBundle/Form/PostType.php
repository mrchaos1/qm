<?php

// src/AppBundle/Form/Type/TaskType.php
namespace AdminBundle\Form;

use BlogBundle\Entity\Post;
use BlogBundle\Entity\PostTranslation;

use AdminBundle\Form\PostTranslationType;;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('slug');
        $builder->add('sortOrder');

        $builder->add('postTranslations', CollectionType::class, array
        (
            'entry_type'      => PostTranslationType::class,
            'entry_options'   => array('label' => false),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array
        (
            'data_class' => Post::class,
        ));
    }
}
