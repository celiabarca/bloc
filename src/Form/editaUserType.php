<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Form;
   use Symfony\Component\Form\AbstractType;
   use Symfony\Component\Form\FormBuilderInterface;
   use Symfony\Component\Form\Extension\Core\Type\TextType;
   use Symfony\Component\Form\Extension\Core\Type\EmailType;
   //use Symfony\Component\Form\Extension\Core\Type\PasswordType;
   use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  // use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
   use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of editaUserType
 *
 * @author linux
 */
class editaUserType extends AbstractType{
   public function buildForm(FormBuilderInterface $builder, array $options) {
  	 
        	$builder
                	->add('username', TextType::class,[
                    	'label'=>'Username',
                    	'required'=>'required',
                    	'attr'=>[
                        	'class'=>'form-control',
                    	]
                	])
                	->add('email', EmailType::class,[
                    	'label'=>'Email',
                    	'required'=>'required',
                    	'attr'=>[
                        	'class'=>'form-control'
                    	]
                	])
                        ->add('isActived', TextType::class,[
                    	'label'=>'Activado',
                    	'required'=>'required',
                    	'attr'=>[
                        	'class'=>'form-control'
                    	]
                	])
                        ->add('role', TextType::class,[
                    	'label'=>'ROL',
                    	'required'=>'required',
                    	'attr'=>[
                        	'class'=>'form-control'
                    	]
                	])
                	->add('editarUsers', SubmitType::class,
                        	['label'=>'Editar',
                            	'attr'=>[
                            	'class'=>'form-submit btn btn-success'
                    	]]);
      	 
   	}
   	public function configureOptions(OptionsResolver $resolver)
    	{
        	$resolver->setDefaults([
            	'data_class' =>'App\Entity\User',
        	]);
    	}
    
}
