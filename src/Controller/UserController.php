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
        //establece el rol del cliente
    	$user->setRole('ROLE_USER');
        //activamos cliente
    	$user->setIsActived(true);
   	 
    	//creamos el formulario se llama RegisterType y lo metemos en una variable
    	$form = $this->createForm(RegisterType::class, $user);
   	//metaemos las respuestas del formulario
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
            //encriptamos la contrasenya
        	$password=$passwordEncoder->encodePassword($user, $user->getPassw());
                //metemos la contraseña encriptada machacando la que no esta enctriptada
        	$user->setPassw($password);
                //metemos los datos en la bbdd 
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($user);
                //aplicamos los cambios
        	$entityManager->flush();
       	 
                //redirigimos a la pantalla que queramos
        	return $this->redirectToRoute('createPost');
    	}
    	//emviamos el formulario al twig
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
    /**
     * Cargar crear post
     *
     * @Route("/adminusers", name="adminUsers")
     * 
     */
    function adminUsers(){
        $em = $this->getDoctrine()->getManager();
        $users=  $em->getRepository(User::class)->findAll();
        if (!$users) {
            throw $this->createNotFoundException('No Tienes ningun Usuario');
        }
        return $this->render('admin/adminUsers.html.twig',array(
           'users'=>$users
       ));
        
    }
    /**
     * Cargar crear post
     *
     * @Route("/editarUser/{id}", name="editarUser")
     * 
     */
    function editarUser(Request $request, $id){
        //$id=$request->query->get("id");
        //var_dump($id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(array('id'=>$id));
//        var_dump(count($user);
        $form = $this->createForm(\App\Form\editaUserType::class, $user);
        $form->handleRequest($request);
        $users=  $em->getRepository(User::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $user= $form->getData();
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($user);
                //aplicamos los cambios
        	$entityManager->flush();
       	 
                //redirigimos a la pantalla que queramos
        	return $this->render('admin/adminUsers.html.twig',array(
           'users'=>$users
       ));
    	}
         return $this->render('admin/editarUser.html.twig',array(
            'form'=>$form->createView()
             
       ));
    }
    /**
     * Cargar crear post
     *
     * @Route("/deleteUser/{id}", name="deleteUser")
     * 
     */
    function deleteUser($id){
    $em = $this->getDoctrine()->getEntityManager();
    $user = $em->getRepository(User::class)->findOneBy(array('id'=>$id));
    $em->remove($user);
    $em->flush();
    $users=  $em->getRepository(User::class)->findAll();
    return $this->render('admin/adminUsers.html.twig',array(
           'users'=>$users
       ));
    }
    
    
    
    

    
    
}
