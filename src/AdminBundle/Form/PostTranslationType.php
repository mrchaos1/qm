<?php

namespace AdminBundle\Form;

use BlogBundle\Entity\PostTranslation;
use BlogBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PostTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array
        (
            'data_class' => PostTranslation::class,
        ));
    }






}
