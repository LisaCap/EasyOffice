<?php

namespace App\Form;

/* src/Form/SalleType.php */

//recupérer les options pour construire les formulaire !
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

//gerer les affichages de données par type, selon le besoin
use Symfony\Component\Form\Extension\Core\Type\TextType; //input
use Symfony\Component\Form\Extension\Core\Type\DateType; //Date
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //nombre

use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //equipement

use Symfony\Bridge\Doctrine\Form\Type\EntityType; //entity pour les clés etrangeres

use Symfony\Component\Form\Extension\Core\Type\SubmitType; //btn submit

//validateurs pour les données
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;

//Pour l'idCategorieSalle , pour recuperer la liste deroulante avec les libéllés
use App\Entity\CategorieSalle;

//table Salle dans la BDD
use App\Entity\Salle;

//table Salle dans la BDD
use App\Entity\Indisponible;

//table Salle dans la BDD
use App\Entity\Equipement;


class SalleType extends AbstractType
{
    //création d'un formulaire qui sera appelé dans un controleur
    //function hérité de la classe abstraite, et donc obligation de la remplir
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('nomSalle', TextType::class,
                      array('label' => 'Nom', 'required' => false))
            
                ->add('cpSalle', IntegerType::class,
                      array('label' => 'Code postal', 'required' => false))
            
                ->add('villeSalle', TextType::class,
                      array('label' => 'Ville', 'required' => false))
            
                ->add('date', DateType::class,
                      array('constraints' => array(new NotBlank()),
                            'label' => 'Date', 'required' => false))
            
                ->add('idCategorieSalle', EntityType::class,
                      array('class' => CategorieSalle::class,
                            'choice_label' => 'libelleCategorieSalle',
                            'expanded' => false,
                            'multiple' => false),
                      array('required' => false, 'label' => 'Catégorie'))
            
                ->add('surfaceSalle', IntegerType::class,
                      array('label' => 'Surface', 'required' => false))
            
                ->add('nbrPieceSalle', IntegerType::class,
                      array('label' => 'Nombre de pièce', 'required' => false))
            
                ->add('capaciteSalle', IntegerType::class,
                      array('label' => 'Capacité', 'required' => false))
            
                ->add('prixMaxSalle', IntegerType::class,
                      array('label' => 'Prix max', 'required' => false))
            
                ->add('prixMinSalle', IntegerType::class,
                      array('label' => 'Prix min', 'required' => false))
            
                ->add('equipement', EntityType::class,
                      array('class' => Equipement::class,
                            'choice_label' => 'libelleEquipement',
                            'expanded' => true,
                            'multiple' => true),
                      array('label' => 'Equipement', 'required' => false))
                
                //creer deux champs input qui fait tout les controle et le cryptage
                ->add('Save', SubmitType::class,
                      array('label' =>'Rechercher',
                            'attr' => ['class' => 'btn btn-info']));
                
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Salle::class));
        //rattachement à la classe Salle
    }
    
    
}