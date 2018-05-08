<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\api;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of PostController
 *
 * @author linux
 */
class PostController {
    //put your code here
    private function serialize(Post $post){
    	return array(
        	'username'=>$post->getUsername(),
        	'email'=>$post->getEmail(),
        	'passw'=>$post->getPassword()
    	); 
	}
   public function deletePost($id = null){
        dump("dentro");
            if($id)
            {
                
                $em = $this->getDoctrine()->getEntityManager();
                $post = $em->getRepository(Post::class)->findOneBy(['id'=>$id]);
                $em->remove($post);
                $em->flush();
            //return new JsonResponse($this->serialize($user));
                $response = new Response(json_encode("se ha borrado"), 200); 
                return $response;
            }else{
                $response = new Response(json_encode("no se borrado"), 666); 
                return $response;
            }
            
    }
}
