<?php

namespace Ghazy\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ghazy\BlogBundle\Utils\Blog as Blog;
use Eko\FeedBundle\Item\ItemInterface;
/**
 * Post
 */
class Post implements ItemInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_activated;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;


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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Post
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Post
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;
    
        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
	    if(!$this->getCreatedAt())
		  {
		    $this->created_at = new \DateTime();
		  }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
         $this->updated_at = new \DateTime();
    }
    public function getTitleSlug()
    {
    	return Blog::slugify($this->getTitle());
    }
    public function getBodyTruncuted()
    {
    	$limit = Blog::limit;
    	return Blog::truncate($this->getBody(), $limit);
    }
	public function setTokenValue()
    {
    	if(!$this->getToken())
    	{
    		$this->token = sha1($this->getTitle().rand(11111, 99999));
    	}
    }
    public function __toString()
    {
	return $this->getTitle();
     }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comments
     *
     * @param \Ghazy\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\Ghazy\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Ghazy\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Ghazy\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    public function getFeedItemTitle() {
	return $this->getTitle();
   }
   public function getFeedItemDescription() {
   	$string ='tags: ';
   	foreach ($this->getTags() as $tag)
   	{
   		$string.= ' '.$tag.',';
   	}
	return substr($string, 0, -1);
   }
   public function getFeedItemPubDate() {
	return $this->getCreatedAt();
   }
   public function getFeedItemLink()
   {
	return 'http://www.ghazybenahmed.com/article/'.$this->getTitleSlug().'/'.$this->getId() ;
   }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;


    /**
     * Add tags
     *
     * @param \Ghazy\BlogBundle\Entity\Tag $tags
     * @return Post
     */
    public function addTag(\Ghazy\BlogBundle\Entity\Tag $tags)
    {
    	$tags->addPost($this);
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Ghazy\BlogBundle\Entity\Tag $tags
     */
    public function removeTag(\Ghazy\BlogBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}