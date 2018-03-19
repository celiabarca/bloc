<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author linux
 */
class HomeController extends Controller {
    //put your code here
    /**
     * Cargar home
     *
     * @Route("/", name="home")
     * 
     */
    function home(){
        return $this->render('home/home.html.twig');
    }
}
