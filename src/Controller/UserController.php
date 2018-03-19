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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
/**
 * Description of UserController
 *
 * @author linux
 */
class UserController extends Controller{
    private $sesion;
    function __construct() {
        $this->sesion = new Session();
    }
    /**
     * @Route("/register", name = "register")
     *      
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        //establishing default role and putting it active
    	$user->setRole('ROLE_USER');
    	$user->setIsActived(true);
   	 
    	//creating the form
    	$form = $this->createForm(RegisterType::class, $user);
   	 
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
        	// encoding password, first we get password in plaintext and then
	// we encode it.
        	$password=$passwordEncoder->encodePassword($user, $user->getPassw());
        	$user->setPassw($password);
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($user);
        	$entityManager->flush();
       	 
        	return $this->redirectToRoute('home');
    	}
    	//rendering form
    	return $this->render('user/regForm.html.twig', array(
        	'form' => $form->createView(),
            'passw'=>$user->getPassw()
    	));        
    }

    //put your code here
    public function login(Request $request, AuthenticationUtils $authUtils){
       $error = $authUtils->getLastAuthenticationError();
       $lastUsername = $authUtils->getLastUsername();
       
       return $this->render('user/login.html.twig', [
           'error'=>$error,
           'last_username'=>$lastUsername
           
           
       ]); 
    }
    public function logout(){
        $this->redirectToRoute("logout");
    }

    
    
}
