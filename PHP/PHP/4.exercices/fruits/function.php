<?php

    // exercice
    /**
     * Sachant que l'on recoit du maraicher les prix suivants:
     * -cerises 5,76 €/kg
     * -bananes 1,09 €/kg
     * -pommes 1,61 € /kg
     * -peches 3,23 €/kg
     * 
     * ecrire la fonction calcul() qui renvoie la phrase:
     * les <nom des fruits> coutent <resultat du calcul> € pour <poids> kg
     * Requis : utiliser un switch
    */

    function calcul($fruit,$poids)
    {
        switch($fruit)
        {
            case 'cerises' : $prix = 5.76;
            break;

            case 'bananes' : $prix = 1.09;
            break;

            case 'peches' : $prix = 3.23;
            break;

            case 'pommes' : $prix = 1.61;
            break;

            default: echo "fruit inexistant";
        }
        
        $resultat_calcul = $poids * $prix;

        return "Les $fruit coutent $resultat_calcul € pour $poids kg<br>";
    }

?>