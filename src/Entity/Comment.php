<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entity\Post;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
     /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $comennt;
   /**
     * Many comentarios have One usuario.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $user;
   /**
     * Many Comments have One Post.
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
     */
    private $post;
    // add your own fields
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $autor;
    function setAutor(User $user) {
        $this->user = $user;
    }
     function getUser():User {
        return $this->user;
    }

    
    function getId() {
        return $this->id;
    }

    function getComennt() {
        return $this->comennt;
    }
    function getPost() {
        return $this->post;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setComennt($comennt) {
        $this->comennt = $comennt;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPost($post) {
        $this->post = $post;
    }



}
