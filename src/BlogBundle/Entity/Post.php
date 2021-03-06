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
     * @ORM\Column(name="sort_order", type="integer", nullable=true)
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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    protected $thumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_popular", type="boolean", nullable=true)
     */
    protected $isPopular;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postTranslations = new \Doctrine\Common\Collections\ArrayCollection();
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
    private $postTranslations;

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
     * Add postTranslation
     *
     * @param \BlogBundle\Entity\PostTranslation $postTranslation
     *
     * @return Post
     */
    public function addPostTranslation(\BlogBundle\Entity\PostTranslation $postTranslation)
    {
        # Add post to post tranlations
        $postTranslation->setPost($this);
        $this->postTranslations[] = $postTranslation;
        return $this;
    }

    /**
     * Remove postTranslation
     *
     * @param \BlogBundle\Entity\PostTranslation $postTranslation
     */
    public function removePostTranslation(\BlogBundle\Entity\PostTranslation $postTranslation)
    {
        $this->postTranslations->removeElement($postTranslation);
    }

    /**
     * Get postTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostTranslations()
    {
        return $this->postTranslations;
    }

    /**
     * Set thumbnail
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $thumbnail
     *
     * @return Post
     */
    public function setThumbnail(\Application\Sonata\MediaBundle\Entity\Media $thumbnail = null)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set category
     *
     * @param \BlogBundle\Entity\Category $category
     *
     * @return Post
     */
    public function setCategory(\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isPopular
     *
     * @param boolean $isPopular
     *
     * @return Post
     */
    public function setIsPopular($isPopular)
    {
        $this->isPopular = $isPopular;

        return $this;
    }

    /**
     * Get isPopular
     *
     * @return boolean
     */
    public function getIsPopular()
    {
        return $this->isPopular;
    }
}
