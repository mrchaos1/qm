<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\RedirectResponse;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


use BlogBundle\Entity\Post;
use BlogBundle\Entity\PostTranslation;
use Doctrine\Common\Collections\ArrayCollection;
use AdminBundle\Form\PostTranslationType;

use AdminBundle\Form\PostType;



class AdminController extends Controller
{
    public function indexAction()
    {


        return $this->render('@Admin/index.html.twig');
    }


    public function postEditorAction(Request $request, $postId = false)
    {
        $em = $this->getDoctrine()->getManager();

        if($postId > 0)
        {
            $post =
              $em->getRepository(Post::class)
              ->createQueryBuilder('p')
              ->addSelect('pt')
              ->leftJoin("p.postTranslations", 'pt')
              ->andWhere("p.id = :id")
              ->setParameter('id', $postId)
            #  ->setMaxResults(1)
              ->getQuery()
              ->getSingleResult();
        }
        else
        {
            $post = new Post();
            $post->addPostTranslation(new PostTranslation());
        }

        $form = $this->createForm(PostType::class, $post);
        #$form = $formBuilder->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $em->flush();
            return new RedirectResponse($this->generateUrl('admin_post_editor', ['postId' => $postId]));
        }


        return $this->render('@Admin/postEditor.html.twig',
        [
            'form' => $form->createView()
        ]);
    }


    function postsListAction()
    {
        $posts =
          $em->getRepository(Post::class)
          ->createQueryBuilder('p')
          ->addSelect('pt')
          ->leftJoin("p.postTranslations", 'pt')
          ->andWhere("p.id = :id")
          ->setParameter('id', $postId)
          ->getQuery()
          ->getSingleResult();




    }
















}
