<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Form\PostTranslationType;
use BlogBundle\Entity\Post;
use \Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts =
          $em->getRepository(Post::class)
          ->createQueryBuilder('p')
          ->leftJoin("p.thumbnail", 'th')
          ->addSelect('pt')

          ->addSelect('th')
          ->join("p.postTranslations", 'pt')
          ->orderBy('p.sortOrder', 'ASC')
          ->orderBy('p.id', 'DESC')
          ->getQuery()
          ->getResult();

        $popularPosts =
          $em->getRepository(Post::class)
          ->createQueryBuilder('p')
          ->leftJoin("p.thumbnail", 'th')
          ->addSelect('pt')
          ->addSelect('th')
          ->addSelect('c')

          ->join("p.postTranslations", 'pt')
          ->leftJoin("p.category", 'c')
          ->orderBy('p.id', 'ASC')
          ->andWhere('p.isPopular = 1')
          ->getQuery()
          ->getResult();

        $form = '';

        return $this->render('@Blog/QMTheme/mainPage.twig.html',
        [
          'form'              => $form,
          'posts'             => $posts,
          'popularPosts'      => $popularPosts,

        ]);
    }

    # Posts list
    public function postsAction(Request $request, $categorySlug = false)
    {
        $em           = $this->getDoctrine()->getManager();
        $postsQuery   = $em->getRepository(Post::class)->getPosts(false, $categorySlug);
        $paginator    = $this->get('knp_paginator');
        $limit        = 10;

        $pagination   = $paginator->paginate
        (
            $postsQuery,
            $request->query->getInt('page', 1),
            $limit
        );

        return $this->render('@Blog/QMTheme/posts.twig.html',
        [
          'posts'             => $pagination->getItems(),
          'pagination'        => $pagination,
          'popularPosts'      => []
        ]);

    }
	
	
	public function sideBar()
	{
		$em     = $this->getDoctrine()->getManager();
		$popularPosts =
          $em->getRepository(Post::class)
          ->createQueryBuilder('p')
          ->leftJoin("p.thumbnail", 'th')
          ->addSelect('pt')
          ->addSelect('th')
          ->addSelect('c')

          ->join("p.postTranslations", 'pt')
          ->leftJoin("p.category", 'c')
          ->orderBy('p.id', 'ASC')
          ->andWhere('p.isPopular = 1')
          ->getQuery()
          ->getResult();


		return $this->render('@Blog/QMTheme/sideBar.twig.html', ['popularPosts' => $popularPosts]);

	}
	

    # Display post
    public function postAction($postSlug)
    {
      $em = $this->getDoctrine()->getManager();
      $post =
        $em->getRepository(Post::class)
        ->createQueryBuilder('p')
        ->addSelect('pt')
      #  ->addSelect('th')
        ->join("p.postTranslations", 'pt')
        #->leftJoin("p.thumbnail", 'th')
        ->andWhere("p.slug = :slug")
        ->setParameter('slug', $postSlug)
        ->setMaxResults(1)
        ->getQuery()
        ->getSingleResult();
      return $this->render('@Blog/QMTheme/post.twig.html', ['post' => $post]);
    }

    # Articles view
    public function articlesAction()
    {
        die('22222222222');
    }


}
