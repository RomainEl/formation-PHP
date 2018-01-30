<?php

/*
Ce fichier sera inclus dans tous les scripts pour initialiser 
les éléments suivants:

-création/ouverture de session
-connexion à la BDD du site
-définition du chemin du site
-inclusion de ntore fichier de fonctions utilisateur(fonction.php)

*/

//Session
session_start();

//Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=site',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));

//Chemin du site
define('RACINE_SITE','formation-PHP/PHP/PHP/site/');

$contenu='';
$contenu_gauche='';
$contenu_droite='';

//Inclusion fichier de fonctions
require_once('fonction.php');