<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use \App\Form\CreatePostType;
use \App\Entity\Comment;
use App\Controller\CommentsType;
use App\Controller\PostsController;
use App\Entity\Post;
class CommentController extends Controller {
    
/*function editarPost(Request $request, $id){
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
       
    }*///put your code here
    /**
     * Cargar home
     *
     * @Route("/comments{id}/", name="comments")
     * 
     */
    function Coments(Request $request, $id){
        
        $comment = new Comment();
        $form = $this->createForm(\App\Form\CommentsType::class, $comment);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository(Post::class)->findOneBy(array('id'=>$id));
        var_dump($this->getUser());die('#######################################');
        
        $comment->setAutor($this->getUser());
        $post->addComment($comment);  
        if ($form->isSubmitted() && $form->isValid()) {
                $posts=  $em->getRepository(Post::class)->findAll();
                $post= $form->getData();
        	$em->persist($comment);
        	$em->flush();
        	return $this->redirectToRoute('blog');
    	}
        return $this->render('home/blog.html.twig',array(
           'post'=>$posts,
            'form' => $form->createView()
       ));
   	 
        
    }
}
