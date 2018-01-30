<?php

/*
exercice: créér un formulaire pour demander le pseudo à l'internaute
quand il valide son pseudo, on garde l'information en session
quand il revient sur la page, on lui indique "Votre pseudo est <pseudo>"
et on n'affiche plus le formulaire
Ne pas enregistrer d'information si le pseudo est vide.
*/
session_start();
if ($_POST && !empty($_POST['pseudo']))
{
    $_SESSION['pseudo']= $_POST['pseudo'];
}
if (isset($_SESSION['pseudo']))
{
    echo "Votre pseudo est ".$_SESSION['pseudo']."<br>";
}
else{
    ?>
    <form method="post" action="">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo" id="pseudo">
        <input type="submit" value="envoi">
    </form>
    <?php
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>Formulaire de connexion</h1>
   
   
</body>
</html>
