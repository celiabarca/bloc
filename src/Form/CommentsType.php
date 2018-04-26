<?php
namespace App\Form;
   use Symfony\Component\Form\AbstractType;
   use Symfony\Component\Form\FormBuilderInterface;
   use Symfony\Component\Form\Extension\Core\Type\TextType;
   use Symfony\Component\Form\Extension\Core\Type\EmailType;
   use Symfony\Component\Form\Extension\Core\Type\PasswordType;
   use Symfony\Component\Form\Extension\Core\Type\SubmitType;
   use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
   use Symfony\Component\OptionsResolver\OptionsResolver;
   use \Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentsType extends AbstractType{
    
   	public function buildForm(FormBuilderInterface $builder, array $options) {
  	 
        $builder ->add('comennt', TextareaType::class)           
                 ->add('comments', SubmitType::class,
                   	['label'=>'Editar',
                       	'attr'=>[
                       	'class'=>'form-submit btn btn-success'
               	]])
                ;
                
      	 
   	}
   	public function configureOptions(OptionsResolver $resolver)
    	{
        	$resolver->setDefaults([
            	'data_class' =>'App\Entity\Comment',
        	]);
    	}
  	 
   }
