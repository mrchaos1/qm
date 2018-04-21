<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Form\PostTranslationType;
use BlogBundle\Entity\Post;
use \Application\Sonata\MediaBundle\Entity\Media;

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

        #dump($posts);
        #dump($popularPosts); die;
        $form = '';

        return $this->render('@Blog/QMTheme/mainPage.twig.html',
        [
          'form'              => $form,
          'posts'             => $posts,
          'popularPosts'      => $popularPosts,

        ]);
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
