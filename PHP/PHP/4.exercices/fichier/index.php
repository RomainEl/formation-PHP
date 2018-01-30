<?php

$nom_fichier = 'fichier.txt';

$fichier = file($nom_fichier);

foreach($fichier as $ligne){
    echo $ligne.'<br>';
}

echo '<br>';
$nom_fichier2 = 'fichier.csv';
$fichier2 = file($nom_fichier2);

foreach ($fichier2 as $ligne)
{
    $infos_ligne = explode(';',$ligne);
    foreach ($infos_ligne as $info)
    {
        echo $info.'<br>';
    }
    echo'<hr>';
}