<?php

namespace BlogBundle\Admin;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use Doctrine\Common\Collections\ArrayCollection;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;


use BlogBundle\Entity\Post;
use BlogBundle\Entity\PostTranslation;
use BlogBundle\Entity\Language;
use BlogBundle\Entity\Category;

use BlogBundle\Form\PostTranslationType;

class PostAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
      $container    = $this->getConfigurationPool()->getContainer();
      $em           = $container->get('doctrine.orm.entity_manager');
      $languages    = $em->getRepository(Language::class)->findAll();

      foreach($languages as $language)
      {

      }


      $subject = $formMapper->getAdmin()->getSubject();
      if($subject->getPostTranslations()->count() > 0)
      {

      }
      # If is new
      else
      {
          $translation = new PostTranslation();
          $subject->addPostTranslation($translation);
      }

      # Set datetime created
      if(!$subject->getDatetimeAdded())
      {
          $subject->setDatetimeAdded(new \DateTime());
      }

      $formMapper->add('thumbnail', 'sonata_type_model_list', ['required' => false ], array('orphanRemoval' => true, 'link_parameters' => array('context' => 'default')));

      $categories = $em->getRepository(Category::class)->findAll();


      # Create form
      $formMapper->add('slug', TextType::class);
      $formMapper->add('category', ChoiceType::class,
      [
          'required'      => false,
          'choices'       => $categories,
          'choice_label'  => 'title',
          #'empty_data'    => 'Select the category',
          'placeholder'    => 'Select the category',
          #'choice_name'     => '22222',

      ]);


      // $formMapper->add('category', 'sonata_type_model',
      // [
      //     'required' => false,
      //     'property' => 'title'
      // ]);
      $formMapper->add('isPopular', CheckboxType::class, [ 'required' => false ]);
      $formMapper->add('postTranslations', 'sonata_type_collection',
      [
          'by_reference'  => false,
          'type_options'  =>
          [
            'btn_add'         => false,
            'delete'          => false,
            'delete_options'  =>
              [
                  # You may otherwise choose to put the field but hide it
                  'type'         => HiddenType::class,
                  # In that case, you need to fill in the options as well
                  'type_options' =>
                  [
                      'mapped'   => false,
                      'required' => true,
                  ]
              ]
          ]
      ],
      [
        'edit' => 'inline',
        'inline' => 'standard',
        'limit' => 1
      ]);
      $formMapper->add('sortOrder', TextType::class, [ 'required' => false ]);

  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
      $datagridMapper->add('slug');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
      $listMapper->addIdentifier('id', 'text', ['header_style' => 'width: 25px',]);
      $listMapper->addIdentifier('slug');
      $listMapper->add('postTranslations', null,
      [
          'type' => 'text',
          'associated_property' => 'title',
          'identifier'          => false,
      ]);
      $listMapper->addIdentifier('sortOrder', 'text', ['header_style' => 'width: 25px',]);
      $listMapper->add('_action', 'actions', array
      (
          'header_style'  => 'width: 200px',
          'actions'       => array
          (
              'show'    => [],
              'edit'    => [],
              'delete'  => []
          )
      ));
      $listMapper->addIdentifier('datatimeAdded', 'date');
  }





}
