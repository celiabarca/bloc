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
     * Many post have One usuario.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createDate;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modifyDate;
    /**
     * One post has Many comments.
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;
   
    function __construct() {
       $this ->comments=new ArrayCollection;
       $this -> createDate = new \DateTime('now');
      
    }
    function setId($id) {
        $this->id = $id;
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

    function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    function setModifyDate($modifyDate) {
        $this->modifyDate = $modifyDate;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getCont() {
        return $this->cont;
    }

    function getUser() {
        return $this->user;
    }

    function getCreateDate() {
        return $this->createDate;
    }

    function getModifyDate() {
        return $this->modifyDate;
    }
    function setAutor(User $user){
        return $this->user;
    }


}
