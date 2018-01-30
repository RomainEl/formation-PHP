<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire</h1>
    <pre>
    <?php
    //var_dump($_POST);
    if ( $_POST && empty($_POST['email']))
    {
        echo"Veuillez saisir votre email";
    }

    // implode, explode, extract

    $parametres = implode('#', $_POST); // implode permet de retourner les données d'un tableau sous forme de chaine de caracteres.
    var_dump($parametres);

    $date = '19/01/2018';
    $date_tableau = explode('/', $date);
    var_dump($date_tableau);

    var_dump($_POST);
    extract($_POST);
    echo $prenom;

    
    ?>
    </pre>
    <form method="post" action="">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Saisissez votre prénom" value="<?= $prenom ?? ''; ?>">
        <!--   VERSION PHP 5 : isset($_POST['prenom'])? $_POST['prenom'] :''; -->
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Saisissez votre email" value="<?= $email ?? ''; ?>">
        <!--   VERSION PHP 5 : isset($_POST['email'])? $_POST['email'] :''; -->
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="40" rows="5" placeholder ="Saisissez votre message"><?= $message ?? '' ?></textarea>
        <br>
        <input type="submit" value="Envoyer le message">
    </form>
</body>
</html>