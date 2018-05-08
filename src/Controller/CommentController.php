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
        //var_dump(count($this->getUser()));die('#######################################');
        //var_dump($post);
        $comment->setAutor($this->getUser());
        $post->addComment($comment);  
        if ($form->isSubmitted() && $form->isValid()) {
                $posts=  $em->getRepository(Post::class)->findAll();
                $post= $form->getData();
                $comment = $form->getData();
        	$em->persist($comment);
        	$em->flush();
        	return $this->redirectToRoute('blog');
    	}
        return $this->render('home/openPost.html.twig',array(
           'post'=>$posts,
            'form' => $form->createView()
       ));
   	 
        
    }
    /**
     * Cargar home
     *
     * @Route("/allComments{id}/", name="allComments")
     * 
     */
//    function allComents($id){
//        var_dump($id);
//         $em = $this->getDoctrine()->getManager();
//          //$comments= $this->getDoctrine()->getRepository(Comment::class)->find(array('posts_id'=>$id));
//         //$comments=  $em->getRepository(Comment::class)->findAll();
//         $connection=$em->getConnection();
//         $statement=$connection->prepare("SELECT * from comment where posts_id = :id");
//         $statement->bindValue('id',$id);
//         $statement->execute();
//         $results=$statement->fetchAll();
//         $post = $em->getRepository(Post::class)->findOneBy(array('id'=>$id));
//        return $this->render('home/allComents.html.twig',array(
//           'coments'=>$results,
//            'post'=>$post
//        ));
//    }
   
}
