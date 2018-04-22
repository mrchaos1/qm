<?php

namespace BlogBundle\Admin;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelHiddenType;
use Sonata\AdminBundle\Form\Type\AdminType;

use BlogBundle\Entity\Post;
use BlogBundle\Entity\PostTranslation;
use BlogBundle\Entity\Language;

use Sonata\FormatterBundle\Form\Type\FormatterType;


#use BlogBundle\Entity\Post;

#use BlogBundle\Entity\PostTranslation;

class PostTranslationAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
      $formMapper->add('language', EntityType::class, array
      (
          'class'         => Language::class,
          'choice_label'  => 'title',
      ));
      $formMapper->add('title', TextType::class);
      $formMapper->add('text', SimpleFormatterType::class, ['format' => 'richhtml', 'ckeditor_context'  => 'default']);
      $formMapper->add('shortText', SimpleFormatterType::class, ['format' => 'richhtml']);


      //
      // $formMapper->add('text', SimpleFormatterType::class, array
      // (
      //     'config'            => ['extraPlugins' => 'embed'],
      //   #  'title'             => '',
      //     'format'            => 'richhtml',
      //   #  "extra_l"                  => "",
      //     'ckeditor_plugins'  =>
      //     [
      //         'embed' =>
      //         [
      //           'path'      => "/assets/js/ckeditor_plugins/videoembed/",
      //           'filename'  => "plugin.js"
      //         ]
      //     ],
      //     'allow_extra_fields' => ['embed'],
      //     #'ckeditor_context'  => 'default',
      //     'ckeditor_toolbar_icons' => array
      //     (
      //         array(
      //                   'Bold', 'Italic', 'Underline', 'FontSize', 'Format', 'TextColor', 'BGColor',
      //             '-',  'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
      //             '-',  'Undo', 'Redo',
      //             '-',  'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
      //             '-',  'Blockquote',
      //             '-',  'Image', 'Link', 'Unlink', 'Table'),
      //         array('Maximize', 'Source'),
      //         array('Iframe', 'Print', 'embed'),
      //       #  array('h1', 'h2', 'h3'),
      //
      //
      //
      //     )
      // ));
      #dump($formMapper); die;
      // $formMapper->add('text', CKEditorType::class, array
      // (
      //   'config' => array
      //   (
      //     'uiColor'   => '#cccccc',
      //   ),
      //   'required'  => false,
      // ));

      $formMapper->add('metaTitle', TextType::class, ['required' => false]);
      $formMapper->add('metaDescription', TextareaType::class, ['required' => false]);
      $formMapper->add('metaKeywords', TextareaType::class, ['required' => false]);
      #$formMapper->add('post', ModelHiddenType::class);
      #$formMapper->add('datetimeAdded', DateTimeType::class);

    #  dump($_POST);

    #  dump($formMapper); die;


      // $formMapper->add('post', AdminType::class, [],
      // [
      //     #'admin_code'  =>  'sonata.admin.post'
      // ]);

      // $formMapper
      //   ->add( 'image1' ,  AdminType :: class ,  [],
      //   [
      //       'admin_code'  =>  'sonata.admin.imageSpecial'
      //   ]);


      #$formMapper
      #$formMapper->add('post', HiddenType::class);
      #$formMapper->add('post', ModelListType::class);


      // #$formMapper->add('text', TextareaType::class);

      // #$formMapper->add('datetimeAdded', DateTimeType::class);
      // $formMapper->add('sortOrder', TextType::class, ['required'  => false]);
      // $formMapper->add('enableComments', CheckboxType::class, ['required'  => false]);
      // $formMapper->add('published', CheckboxType::class, ['required'  => false]);


  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
      $datagridMapper->add('id');
      $datagridMapper->add('title');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
      #$listMapper->addIdentifier('title');
      $listMapper->addIdentifier('id');
      $listMapper->addIdentifier('title');
    #  $listMapper->addIdentifier('sortOrder');
      #$listMapper->addIdentifier('datetimeAdded');
  }
}
