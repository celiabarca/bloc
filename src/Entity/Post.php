<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\User;
use App\Entity\Comment;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cont;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tag;
    /**
     * Many post have One usuario.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable = true)
     */
    private $user;
    /**
     *@var \DateTime
     *@ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;
    /**
     *@var \DateTime
     *@ORM\Column(name="modifyDate", type="datetime", nullable=true)
     */
    private $modifyDate;
    /**
     * One post has Many comments.
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"persist"})
     */
    private $comments;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autor;
//    public function __toString() {
//        return $this -> post;
//    }
    
    function setComments($comments) {
        $this->comments = $comments;
    }

    function setAutor(User $user) {
        $this->user = $user;
    }

//    function getAutor() {
//        return $this->autor;
//    }
   
    function __construct() {
       $this ->comments=new ArrayCollection;
       $this -> createDate = new \DateTime();
      
    }
    function setId($id) {
        $this->id = $id;
    }
    function sesTag($tag) {
        $this->tag = $tag;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setCont($cont) {
        $this->cont = $cont;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setCreateDate() {
        $this->createDate = $createDate;
    }

    function setModifyDate($modifyDate) {
        $this->modifyDate = $modifyDate;
    }

    function getId() {
        return $this->id;
    }
     function getTag() {
        return $this->tag;
    }

    function getTitle() {
        return $this->title;
    }

    function getCont() {
        return $this->cont;
    }

    function getUser():User {
        return $this->user;
    }

    function getCreateDate() {
        return $this->createDate;
    }

    function getModifyDate() {
        return $this->modifyDate;
    }
    function getComments() {
        return $this->comments;
    }
    function addComment(Comment $comment){
        $comment->setPost($this);
        if (!$this->comments->contains($comment)){
            $this->comments->add($comment);
        }
    }
    




}
