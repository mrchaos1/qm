<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use \Application\Sonata\MediaBundle\Entity\Media;
#use Application\Sonata\MediaBundle\Entity\Media;
#use Sonata\MediaBundle\Entity;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="sort_order", type="integer")
     */
    private $sortOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_added", type="datetime")
     */
    private $datetimeAdded;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    protected $media;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postsTranslations = new \Doctrine\Common\Collections\ArrayCollection();
      #  $this->media = new ArrayCollection();
    }






    /**
     * @param Media $media
     */
    public function setMedia(Media $media)
    {
        $this->media = $media;

    }

    /**
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }


    /**
     * @ORM\OneToMany(targetEntity="PostTranslation", mappedBy="post", cascade={"all"})
     */
    private $postsTranslations;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     *
     * @return Post
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * Set datetimeAdded
     *
     * @param \DateTime $datetimeAdded
     *
     * @return Post
     */
    public function setDatetimeAdded($datetimeAdded)
    {
        $this->datetimeAdded = $datetimeAdded;
        return $this;
    }

    /**
     * Get datetimeAdded
     *
     * @return \DateTime
     */
    public function getDatetimeAdded()
    {
        return $this->datetimeAdded;
    }

    /**
     * Add postsTranslation
     *
     * @param \BlogBundle\Entity\PostTranslation $postsTranslation
     *
     * @return Post
     */
    public function addPostsTranslation(\BlogBundle\Entity\PostTranslation $postsTranslation)
    {
      #
        $postsTranslation->setPost($this);
        $this->postsTranslations[] = $postsTranslation;
        return $this;
    }

    /**
     * Remove postsTranslation
     *
     * @param \BlogBundle\Entity\PostTranslation $postsTranslation
     */
    public function removePostsTranslation(\BlogBundle\Entity\PostTranslation $postsTranslation)
    {
        $this->postsTranslations->removeElement($postsTranslation);
    }

    /**
     * Get postsTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostsTranslations()
    {
        return $this->postsTranslations;
    }
}
