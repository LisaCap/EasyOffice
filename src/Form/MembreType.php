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
use Symfony\Component\Form\Extension\Core\Type\FileType; // photo de profil
use Symfony\Component\Form\Extension\Core\Type\DateType; //Date
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

//objet qui correspond a la table statuMembre
use App\Entity\StatutMembre;


//on ne met pas le request, on le gerera dans le controller

class MembreType extends AbstractType
{
    //création d'un formulaire qui sera appelé dans un controleur
    //function hérité de la classe abstraite, et donc obligation de la remplir
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenomMembre', TextType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Length(array('min' => 3, 'max' => 20)) 
                                                   ),
                            'label' => 'Prénom'))
            
                ->add('nomMembre', TextType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Length(array('min' => 3, 'max' => 20))
                                                   ),
                            'label' => 'Nom'))
            
                ->add('nomDeSocieteMembre', TextType::class,
                      array('label' => 'Nom de la Société', 'required' => false))
            
                ->add('siretMembre', IntegerType::class,
                      array('label' => 'Numéro Siret de la Société', 'required' => false))
            
                ->add('tvaMembre', TextType::class,
                      array('label' => 'Numéro Tva de la Société', 'required' => false))
            
                ->add('dateDeNaissanceMembre', DateType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Date de Naissance'))
            
                ->add('sexeMembre', ChoiceType::class,
                      array('choices' => array('Femme' => 'f',
                                               'Homme' => 'h'),
                            'expanded' =>true,
                            'multiple' => false),
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Sexe'))
            
                ->add('adresseMembre', TextType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Adresse'))
            
                ->add('cpMembre', IntegerType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Regex(array('pattern' => "/^[1-9]{5}$/"))
                                                  ),
                            'label' => 'Code postal'))
            
                ->add('villeMembre', TextType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Ville'))
            
                ->add('telephoneMembre', TextType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Regex(array('pattern' => "/^(0|\\+33|0033)[1-9][0-9]{8}$/")) 
                                                  ),
                            'label' => 'Téléphone'))
                      
                //attention ici c'est une clé etrangere , je ne sais pas bien si ce code marche...
                ->add('idStatutMembre', EntityType::class,
                      array('class' => StatutMembre::class,
                            'choice_label' => 'libelleStatutMembre',
                            'expanded' => false,
                            'multiple' => false),
                      array('constraints' => array(new NotBlank()), 'label' => 'Statut'))
            
                ->add('emailMembre', EmailType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Email'))
            
                ->add('passwordClient', repeatedType::class,
                      array('type' => PasswordType::class,
                            'first_options' => array('label' =>'Mot de passe'),
                            'second_options' => array('label' =>'Validation du mot de passe')))
            
                //La date d'enregistrement sera enregistrée via le PublicController
            
                //Les infos bancaires sont fictives
                      
                ->add('photoMembre', FileType::class,
                      array('label' => 'Photo de Profil',
                            'required' => false))
                
                //creer deux champs input qui fait tout les controle et le cryptage
                ->add('Save', SubmitType::class,
                      array('label' =>'Enregistrer',
                            'attr' => ['class' => 'btn btn-info']));
                
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Membre::class));
        //rattachement à la classe Test qui est liée à ma table Test
    }
    
    
}