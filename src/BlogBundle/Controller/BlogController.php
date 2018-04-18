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
          #->addSelect('pt')
          #->join("p.postsTranslations", 'pt')
          ->orderBy('p.id', 'ASC')
          ->getQuery()
          ->getResult();

        #dump($posts); die;
        $form = '';

        return $this->render('@Blog/QMTheme/mainPage.twig.html',
        [
          'form'      => $form,
          'posts'     => $posts,
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
        ->join("p.postsTranslations", 'pt')
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
