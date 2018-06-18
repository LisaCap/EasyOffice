<?php

namespace App\Form;

/* src/Form/TestType.php */

use App\Entity\Membre;
//table Clients dans la BDD

//recupérer les options pour construire les formulaire !
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

//gerer les affichages de données par type, selon le besoin
use Symfony\Component\Form\Extension\Core\Type\TextType; //input et textarea
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //nombre
use Symfony\Component\Form\Extension\Core\Type\EmailType; //email
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //civilité
use Symfony\Component\Form\Extension\Core\Type\RepeatedType; //saisir deux fois le mot de passe, et gestion des valeurs identiques
use Symfony\Component\Form\Extension\Core\Type\PasswordType; // password
use Symfony\Component\Form\Extension\Core\Type\SubmitType; //btn submit

//validateurs pour les données
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;


//on ne met pas le request, on le gerera dans le controller

class MembreType extends AbstractType
{
    //création d'un formulaire qui sera appelé dans un controleur
    //function hérité de la classe abstraite, et donc obligation de la remplir
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('emailMembre', EmailType::class, array('constraints' => array(new NotBlank()), 'label' => 'Email'))
                ->add('prenomMembre', TextType::class, array('constraints' => array(new NotBlank(), new Length(array('min' => 3, 'max' => 20))), 'label' => 'Prénom'))
                ->add('nomMembre', TextType::class, array('constraints' => array(new NotBlank(), new Length(array('min' => 3, 'max' => 20))), 'label' => 'Nom'))
                ->add('adresseMembre', TextType::class, array('constraints' => array(new NotBlank()), 'label' => 'Adresse'))
                ->add('cpMembre', IntegerType::class, array('constraints' => array(new NotBlank()), 'label' => 'Code postal'))
                ->add('villeMembre', TextType::class, array('constraints' => array(new NotBlank()), 'label' => 'Ville'))
                ->add('telMembre', TextType::class,
                      array('constraints' =>
                            array(new Regex(array('pattern' => "/^(0|\\+33|0033)[1-9][0-9]{8}$/")),
                            array(new NotBlank()), 'label' => 'Téléphone'))
                ->add('civiliteClient', ChoiceType::class,
                      array('choices' => array('Femme' => 'f', 'Homme' => 'h'), 'expanded' =>true, 'multiple' => false),
                      array('constraints' => array(new NotBlank()), 'label' => 'Civilité')
                     )
                ->add('newsletterClient', ChoiceType::class,
                      array('choices' => array('Oui' => 'oui', 'Non' => 'non'), 'expanded' =>true, 'multiple' => false),
                      array('constraints' => array(new NotBlank()), 'label' => 'Newsletter')
                     )
                ->add('passwordClient', repeatedType::class, array('type' => PasswordType::class, 'first_options' => array('label' =>'Mot de passe'), 'second_options' => array('label' =>'Validation du mot de passe')))
                //creer deux champs input qui fait tout les controle et le cryptage
                ->add('Save', SubmitType::class, array('label' =>'Enregistrer', 'attr' => ['class' => 'btn btn-info']));
                //Tous les champs sont require par default. Il faut le preciser pas "require" : false si on ne le veux pas
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Clients::class));
        //rattachement à la classe Test qui est liée à ma table Test
    }
    
    
}