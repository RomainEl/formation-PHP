<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Teko" rel="stylesheet">
</head>
<body>
    <?php
    /* ESPACE DE DIALOGUE
    
    01.[x] Modélisation et création (base dialogue/table commentaire)
    02.[x] Connexion à la base
    03.[x] Créer un formulaire HTML pour l'ajout d'un message(pseudo/message)
    04.[x] Récupération et affichage des messages déjà saisis
    05.[x] Requete d'enregistrement(INSERT)
    06.[x] Confirmation à l'internaute (via $_POST)
    07.[x] Attaque : Injection SQL + XSS
    08.[x] Etude et Moyens pour contrer les attaques
    09.[x] Ordonner et mettre les derniers messages en tête de liste
    10.[x] Afficher le nombre de messages
    11.[] Améliorer le visuel (css)
    12.[x] Tests
    */

    $db = new PDO('mysql:host=localhost;dbname=dialogue',
    'root',
    '',
    array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));

    if($_POST)
    {
        if(!empty ($_POST['pseudo']) && !empty($_POST['message']))
        {
            $_POST['message'] = addslashes($_POST['message']);

            /*
            strip_tags() permet de supprimer toutes les balises html
            
            $_POST['message'] = strip_tags($_POST['message']);
            */
            /* 
            htmlspecialchars() permet de rendre inoffensicves les balises html            
            */
            $_POST['message'] = htmlspecialchars($_POST['message']);
            $sql="INSERT INTO commentaire VALUES(NULL,'$_POST[pseudo]','$_POST[message]',NOW())";
            if ($db->query($sql))
            {
                echo '<p class="info">Message enregistré</p>';
            }
        }
    }

 
    ?>

    <form method="post" action="">
        <fieldset>
            <legend>Formulaire</legend>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
            <br>
            <label for="message">Message</label><br>
            <textarea name="message" id="message" cols="40" rows="5"></textarea>
            <br>
            <input type="submit" value="Poster">
        </fieldset>
    </form>
    <?php
        $resul = $db->query("SELECT *, DATE_FORMAT(date_enregistrement,'%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement,'%H:%i:%s')
         AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");
        echo "<fieldset><legend>".$resul->rowCount()." Messages</legend>";
            while($commentaire = $resul->fetch(PDO::FETCH_ASSOC))
                {
                    echo'<div class="message">
                            <div class="titre">Par : '.$commentaire['pseudo'].', le
                            '.$commentaire['datefr'].' à '.$commentaire['heurefr'].'</div>
                            <div class="contenu">'.$commentaire['message'].'</div>
                        </div>';
                }
        echo "</fieldset>";
    ?>
</body>
</html>