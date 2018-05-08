<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of user
 *
 * @author linux
 */
class UserController extends Controller {

    //put your code here

    private function serialize(User $user) {
        return array(
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'passw' => $user->getPassword()
        );
    }

    public function listUser($id = null) {
        if ($id) {
            $user = $this->getDoctrine()->getRepository(User::class)
                    ->findOneBy(['id' => $id]);
            return new JsonResponse($this->serialize($user));
        } else {
            $users = $this->getDoctrine()->getRepository(User::class)->findall();
            $data = array('users' => array());
            foreach ($users as $user) {
                $data['users'][] = $this->serialize($user);
            }

            $response = new Response(json_encode($data), 200);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    public function deleteUser($id = null) {
        //dump($id);
        if ($id) {

            $em = $this->getDoctrine()->getEntityManager();
            $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
            $em->remove($user);
            $em->flush();
            //return new JsonResponse($this->serialize($user));
            $response = new Response(json_encode("se ha borrado"), 200);
            return $response;
        } else {
            $response = new Response(json_encode("no se borrado"), 666);
            return $response;
        }
    }
//    public function insertUser($id = null) {
//        
//        
//    }

}
