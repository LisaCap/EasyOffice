<?php
// src/Service/Calendrier.php
namespace App\Services;

use App\Entity\Indisponible;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class Calendrier
{
    
    public function creationCalendrier($id, $em)
    {
        //on a relié avec le IndisponibleRepository ia le $em, qui est relié au PublicController. Car c'est dans le publicController qu'on passe la variable.
        //$em contien en fait le getDoctrine avec la classe Indisponible
        
        //Pour recuperer les jours indispo et les mettre dans un tableau
        $date_indispo = $em->calendrier_indispo($id);
        $nb_indispo = count($date_indispo);
        $tab_indispo = array();
        for($i = 0; $i < $nb_indispo; $i++)
        {
            $tab_indispo[] = $date_indispo[$i]['jour_indisponible'];
        }
        //ici on retourne un array avec toute les dates indisponibles, qu'on retourne dans le controller, qui fait un render dans le twig
        
        //return $date_indispo;
        
        //maintenant on construit le tableau
        
        //$date_indispo represente le tableau de comparaison
        $calendrier = '';
        //Init en html
        $calendrier.= '<table class="table table-striped">
                            <thead>
                                <tr>
                                    <td scope="col"></td>
                                    <td scope="col">Juillet</td>
                                    <td scope="col"></td>
                                </tr>
                            </thead>
                            
                            <tbody>
                            
                            <tr>
                                 <td scope="row">L</td>
                                 <td scope="row">M</td>
                                 <td scope="row">M</td>
                                 <td scope="row">J</td>
                                 <td scope="row">V</td>
                                 <td scope="row">S</td>
                                 <td scope="row">D</td>
                            </tr>
    <tr>';//Affichage des jours dans le tableau

        $j = 0; //Initialisation des variables
        $i = 1;


        //in_array

        /*$date_indispo[] = "2018-06-28 00:00:00";
        $date_indispo[] = "2018-06-29 00:00:00";
        $date_indispo[] = "2018-06-30 00:00:00"; */
        $mois = 7; //correspond à Juin
        $annee = 2018;
        dump($date_indispo);
        while($j<= date("t",mktime(0,0,0,$mois,1,$annee)) ) //boucle
        {

            $date = $annee . "-";

            if($mois >= 1 && $mois <= 9)
            {
                $date .= "0";

            }

            $date .= $mois . "-";

            if($j >= 1 && $j <= 9)
            {
                $date .= "0";

            }

            $date .= $j . " 00:00:00";

            //$calendrier.= $date;

            $calendrier.= '<td scope="row" ';
            
            //$indispo = tableau array contenant toutes les date d'indisponibilité de la salle 
            if(in_array($date, $tab_indispo))
            {
                $calendrier.= "style='background-color:#882231; color:white'";
            }
            $calendrier.= '>';

            if($j!=0) $calendrier.= $j;

            if($i==date("w",mktime(0,0,0,$mois,$j,$annee))) $j++;

            $calendrier .= '</td>';

            if($i==0) $calendrier.= '</tr>';

            $i++;

            if($i==7) $i=0;
    }
        $calendrier.= '</tbody></table>';
        
        return $calendrier;
        
    }
}
       