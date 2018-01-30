<?php

    if(isset($_GET['pays']))
    {
        $pays = $_GET['pays'];
    }
    elseif(isset($_COOKIE['pays']))
    {
        $pays = $_COOKIE['pays']; // $_COOKIE est une superglobale
    }
    else
    {
        $pays = 'fr';
    }
?>
<!DOCTYPE html>
<html lang="<?= $pays ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <ul>
        <li><a href="?pays=fr">France</a></li>
        <li><a href="?pays=en">Angleterre/US</a></li>
        <li><a href="?pays=es">Espagne</a></li>
        <li><a href="?pays=it">Italie</a></li>
    </ul>
    <?php
    
    $un_an = 365 * 24 * 3600 ;
    setcookie("pays",$pays,time() + $un_an);

    switch($pays)
    {
        case 'fr':
        echo "<p>Bonjour, vous visitez actuellement le site en français</p>";
        break;

        case 'en';
        echo "<p>Hello, you are currently visiting the site in english</p>";
        break;

        case 'es';
        echo "<p>Hola, en este momento, esta visitando el sitio en español</p>";
        break;

        case'it';
        echo "<p>Ciao, si sta attualmente visitando il sito en italiano</p>";
        break;

    }
    var_dump($_COOKIE);
    ?>
 
    
</body>
</html>