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
//use \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use App\Entity\Post;

class PostsController extends Controller{
    /**
     * Cargar home
     *
     * @Route("/blog", name="blog")
     * 
     */
    function blog(Post $post){
        /*$title= $post->getTitle();
        $contenido = $post->getCont();
        $user = $post ->getUser()->getUsername();
        $data = $post ->getCreateDate();*/
        
        return $this->render('home/blog.html.twig'/*,[
           /*'title'=>$title,
           'contenido'=>$contenido,
           'user'=>$user,
           'fecha' => $data, 
            'post'=>$post
       ]*/);
    }
    /**
     * Cargar crear post
     *
     * @Route("/createPost", name="createPost")
     * 
     */
    //request contiene los valores del formulario
    function CreatePost(Request $request){
        $post = New Post();
        $user = $this->getUser();
        var_dump($post);
        
        //creamos el formulario
        $form = $this->createForm(CreatePostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            //$post->setAutor();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('createPost');
        }
        return $this->render('home/createPost.html.twig', array(
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
}