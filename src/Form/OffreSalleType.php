<?php

namespace App\Form;

/* src/Form/TestType.php */

use App\Entity\Salle;
//table Salle dans la BDD

//recupérer les options pour construire les formulaire !
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

//gerer les affichages de données par type, selon le besoin
use Symfony\Component\Form\Extension\Core\Type\TextType; //input
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // textarea pour la description
use Symfony\Component\Form\Extension\Core\Type\FileType; // photo de profil
use Symfony\Component\Form\Extension\Core\Type\DateType; //Date
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //nombre
use Symfony\Component\Form\Extension\Core\Type\EmailType; //email
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //civilité

use Symfony\Bridge\Doctrine\Form\Type\EntityType; //entity pour les clés etrangeres

use Symfony\Component\Form\Extension\Core\Type\RepeatedType; //saisir deux fois le mot de passe, et gestion des valeurs identiques
use Symfony\Component\Form\Extension\Core\Type\PasswordType; // password
use Symfony\Component\Form\Extension\Core\Type\SubmitType; //btn submit

//validateurs pour les données
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;

//objet qui correspond a la table Membre pour rercuperer l'id
//Enfin à voir pour recuperer l'id via la session plutot....
//IDEM pour l'idCategorieSalle
use App\Entity\Membre;

//Pour l'idCategorieSalle , pour recuperer la liste deroulante avec les libéllés
use App\Entity\CategorieSalle;

//Pour l'Equipement (avec creation de table intermediaire par Doctrine), pour recuperer la liste deroulante avec les libéllés des equipements
use App\Entity\Equipement;


class OffreSalleType extends AbstractType
{
    //création d'un formulaire qui sera appelé dans un controleur
    //function hérité de la classe abstraite, et donc obligation de la remplir
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ATTENTION le reference salle va etre généré via le PublicController
        
        $builder->add('nomSalle', TextType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Length(array('min' => 3, 'max' => 255)) 
                                                   ),
                            'label' => 'Nom de la salle'))
            
                ->add('adresseSalle', TextType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Adresse'))
            
                ->add('cpSalle', IntegerType::class,
                      array('constraints' => array(new NotBlank(),
                                                   new Regex(array('pattern' => "/^[0-9]{5}$/"))
                                                  ),
                            'label' => 'Code postal'))
            
                ->add('villeSalle', TextType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Ville'))
                      
                //attention ici c'est une clé etrangere , je ne sais pas bien si ce code marche...
                ->add('idCategorieSalle', EntityType::class,
                      array('class' => CategorieSalle::class,
                            'choice_label' => 'libelleCategorieSalle',
                            'expanded' => false,
                            'multiple' => false),
                      array('constraints' => array(new NotBlank()), 'label' => 'Catégorie'))
            
                ->add('surfaceSalle', IntegerType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Surface (en m²)'))
            
                 ->add('descriptionSalle', TextAreaType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Description'))
            
                ->add('nbrPieceSalle', IntegerType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Nombre de pièce(s)'))
            
                ->add('capaciteSalle', IntegerType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Capacité (nombre de personnes pouvant être accueillies)'))
            
                ->add('prixSalle', IntegerType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Prix (€/Journée)'))
            
                //attention ici c'est une clé etrangere avec un Many to Many , je ne sais pas bien si ce code marche...
                ->add('equipementSalle', EntityType::class,
                      array('class' => Equipement::class,
                            'choice_label' => 'libelleEquipement',
                            'expanded' => true,
                            'multiple' => true),
                      array('constraints' => array(new NotBlank()), 'label' => 'Equipement(s)'))
                
                //creer deux champs input qui fait tout les controle et le cryptage
                ->add('Save', SubmitType::class,
                      array('label' =>'Enregistrer',
                            'attr' => ['class' => 'btn btn-info']));
                
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Salle::class));
        //rattachement à la classe Test qui est liée à ma table Test
    }
    
    
}