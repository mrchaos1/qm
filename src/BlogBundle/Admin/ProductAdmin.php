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
      $formMapper->add('title', TextType::class, [ 'required' => false ]);
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
      $datagridMapper->add('slug');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
      $listMapper->add('_action_1', 'actions', array
      (
          'header_style'  => 'width: 50px',
          'actions'       => array
          (
              'edit'    => [],
          )
      ));
      $listMapper->addIdentifier('id', 'text', ['header_style' => 'width: 25px',]);
      $listMapper->addIdentifier('slug');
      $listMapper->add('postTranslations', null,
      [
          'template'              => '@Blog/Admin/postTranslations.twig.html',
          'type'                  => 'text',
          'associated_property'   => 'title',
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
      $listMapper->addIdentifier('datatimeAdded', 'text');
  }





}
