<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
     /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $username;
    /**
     * 
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passw;
    /**
     *@var \DateTime
     *@ORM\Column(name="lastLogin", type="datetime")
     */
    private $lastLogin;
    /**
     * @ORM\Column(type="string", length=15)
     */
    private $role;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActived;
    /**
     * One user has Many posts.
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;
    /**
     * One user has Many comments.
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;
    
    
            
    function __construct() {
        $this->posts=new ArrayCollection;
        $this ->comments= new ArrayCollection;
        $this-> lastLogin=new \DateTime('now');
        
    }
    function getPassw() {
        return $this->passw;
    }

    function getRole() {
        return $this->role;
    }

    function getComments() {
        return $this->comments;
    }

    function getPost() {
        return $this->post;
    }

    function setComments($comments) {
        $this->comments = $comments;
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
     return $this->passw;   
    }
    public function getRoles()
    {
        return array('ROLE_USER','ROLE_ADMIN');
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->username; 
    }
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getLastLogin() {
        return $this->lastLogin;
    }

    function getIsActived() {
        return $this->isActived;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassw($passw) {
        $this->passw = $passw;
    }

    function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setIsActived($isActived) {
        $this->isActived = $isActived;
    }

    function setPost($post) {
        $this->post = $post;
    }


}
