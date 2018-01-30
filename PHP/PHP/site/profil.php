<?php

require_once('assets/init.php');

if(!estConnecte())
{
    header('location:connexion.php');
    exit;
}

$contenu .= '<h2>Bonjour '.ucfirst($_SESSION['membre']['pseudo']).'</h2>';

if($_SESSION['membre']['statut'] == 1 )
{
    $contenu.= '<p>Vous êtes connecté en tant qu\'administrateur</p>';

    $contenu .= '<div><h3>Vos informations de profil</h3>
        <p>Email : '.$_SESSION['membre']['email'].'</p>
        <p>Nom, Prénom : '.$_SESSION['membre']['nom'].', '.$_SESSION['membre']['prenom'].'</p></div>';
}
require_once('assets/header.php');
echo $contenu;
require_once('assets/footer.php');