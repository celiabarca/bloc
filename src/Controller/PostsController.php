<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use \App\Form\CreatePostType;
//use \App\Form\CreatePostType2;
use App\Entity\Comment;

//use Symfony\Component\HttpFoundation\Session\Session;

//use \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use App\Entity\Post;

class PostsController extends Controller{
    /**
     * Cargar home
     *
     * @Route("/blog", name="blog")
     * 
     */
    function blog(){

        $em = $this->getDoctrine()->getManager();
        $posts=  $em->getRepository(Post::class)->findAll();
        
        
        if (!$posts) {
            throw $this->createNotFoundException('No Tienes ningun post');
        }
        return $this->render('home/blog.html.twig',array(
           'post'=>$posts
       ));
    }
    /**
     * Cargar crear post
     *
     * @Route("/createPost", name="createPost")
     * 
     */
    //request contiene los valores del formulario
    function CreatePost(Request $request){
        $post = new Post();
        $user = $this->getUser();
        
        //creamos el formulario
        $form = $this->createForm(CreatePostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $post=$form->getData();
            $post->setAutor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('blog');
        }
        return $this->render('home/createPost.html.twig', array(
            'user'=> $user,
            'form' => $form->createView()
    	));   
        
    }
     /**
     * Cargar crear post
     *
     * @Route("/createPost", name="btncreate")
     * 
     */
    function btncreate(){
        return $this->render('home/createPost.html.twig');   
    }
    /**
     * Cargar crear post
     *
     * @Route("/adminPosts/", name="adminPosts")
     * 
     */
    function adminPost(){
         $em = $this->getDoctrine()->getManager();
        $posts=  $em->getRepository(Post::class)->findAll();
        if (!$posts) {
            throw $this->createNotFoundException('No Tienes ningun Posts');
        }
        return $this->render('admin/adminPost.html.twig',array(
           'posts'=>$posts
       ));
    }
    /**
     * Cargar crear post
     *
     * @Route("/editarPost/{id}", name="editarPost")
     * 
     */
    function editarPost(Request $request, $id){
       $em = $this->getDoctrine()->getManager();
       $post = $em->getRepository(Post::class)->findOneBy(array('id'=>$id)); 
       $form = $this->createForm(\App\Form\editarPostType::class, $post);
       $form->handleRequest($request);
       $posts=  $em->getRepository(Post::class)->findAll();
       if ($form->isSubmitted() && $form->isValid()) {
            $post= $form->getData();
            $post->setModifyDate(new \DateTime());
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($post);
                //aplicamos los cambios
        	$entityManager->flush();
       	 
                //redirigimos a la pantalla que queramos
        	return $this->render('admin/adminPost.html.twig',array(
           'posts'=>$posts
       ));
    	}
         return $this->render('admin/editarPost.html.twig',array(
            'form'=>$form->createView()
             
       ));
       
    }
    /**
     * Cargar crear post
     *
     * @Route("/deletePost/{id}", name="deletePost")
     * 
     */
    function deletePost($id){
     $em = $this->getDoctrine()->getEntityManager();
    $post = $em->getRepository(Post::class)->findOneBy(array('id'=>$id));
    $em->remove($post);
    $em->flush();
    $posts=  $em->getRepository(Post::class)->findAll();
   return $this->render('admin/adminPost.html.twig',array(
           'posts'=>$posts
       )); 
    }
    /**
     * Cargar crear post
     *
     * @Route("/openPost/{id}", name="openPost")
     * 
     */
     function openPost($id){
         $em = $this->getDoctrine()->getEntityManager();
         $comment = new Comment();
         $form = $this->createForm(\App\Form\CommentsType::class, $comment);
         
         //$comments= $em->getRepository(Comment::class)->findAll(       );
         $post = $em->getRepository(Post::class)->findOneBy(array('id'=>$id));
         //var_dump($post);
         
         
         return $this->render('home/openPost.html.twig',array(
           'post'=>$post,
           'form' => $form->createView()
         )); 
      }
     
    
}