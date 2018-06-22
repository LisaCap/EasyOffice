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
use App\Entity\Indisponible;


class ReservationType extends AbstractType
{
    //création d'un formulaire qui sera appelé dans un controleur
    //function hérité de la classe abstraite, et donc obligation de la remplir
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ATTENTION on recupere l'idMembre via la session, à mettre dans la table Produit
        //ATTENTION il faut aussi recuperer l'idSalle de la page où on se trouve...par le GET donc à mettre dans le lien dans on clique sur "reserver" quand on est sur "detailSalle"
        
        $builder->add('jourIndisponible', DateType::class,
                      array('constraints' => array(new NotBlank() ),
                            'label' => 'Jour de reservation'))
                
                //creer deux champs input qui fait tout les controle et le cryptage
                ->add('Save', SubmitType::class,
                      array('label' =>'Enregistrer',
                            'attr' => ['class' => 'btn btn-info']));
                
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Indisponible::class));
        //rattachement à la classe Test qui est liée à ma table Test
    }
    
    
}