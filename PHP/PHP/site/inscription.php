<?php

require_once('assets/init.php');

$inscription= false; // inscription pas faite, je m'en sers pour afficher le formulaire

if($_POST){
    //Je poste mon formulaire d'inscription

    //controles sur les champs
    $champs_vides = 0;
    foreach ($_POST as $indice => $valeur)
    {
        if(empty($valeur))
        {
            $champs_vides++;
        }
    }
        if($champs_vides > 0)
        {
            $contenu .= '<div class="alert alert-danger">Il y a '.$champs_vides.' information(s) manquante(s)</div>';
        }
    

    //vérifier qu'une chaine contient des caractères autorisés
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]{3,15}$#',$_POST['pseudo']);
    $verif_codepostal= preg_match('#[0-9]{5}$#',$_POST['code_postal']);
    //expression régulière
    /*
        -je délimite l'expression par le symbole # debut et fin
        - ^ signifie "commence par tout ce qui suit"
        - $ signifie "finit par tout ce qui précède"
        - [] pour délimiter les intervalles (ici de a à z, de A à Z, de 0 à 9, et on ajoute ".","_" ou "-")
        - le + pour dire que la chaine peut faire de 1 à n caractères
            + équivalent de {1,}
            ? équivalent de {0,1}
            * équivalent de {0,}
            {5} 5 précisément
            {3,15} de 3 à 15 caractères
    */
    if (!$verif_caractere){
        $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir 3 à 15 caractères (lettres de a à Z, chiffres de 0 à 9, _.-)</div>';
    }
    if (!$verif_codepostal){
        $contenu .= '<div class="alert alert-danger">Le code postal n\'est pas correct</div>';
    }

    if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
        $contenu .= '<div class= alert alert-danger">De quel genre etes vous donc?</div>';
    }


    //Astuce de controle d'email avec filter_var
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
        $contenu .= '<div class="alert alert-danger">Adresse mail invalide</div>';
    }

    //si tout va bien
    //je controle que le pseudo n'existe pas déjà dans la table
    //sinon j'invite l'internaute à changer de pseudo

    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array('pseudo' => $_POST['pseudo']));
    if($membre -> rowCount() > 0)
    {
        $contenu .= '<div class= alert alert-danger">Ce pseudonyme est déjà pris. Merci d\'en choisir un autre</div>';
    }

    //si tout va bien 
    //j'insère le nouveau membre dans la table membre (avec statut = 0)
    //je mets $inscription à true
    if(empty($contenu))
    {
        executeRequete("INSERT INTO membre VALUES (NULL,:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse,0)",
         array( 'pseudo' => $_POST['pseudo'],
                'mdp' => MD5($_POST['mdp']),
                'nom' => $_POST['nom'],
                'prenom'=> $_POST['prenom'],
                'email'=> $_POST['email'],
                'civilite'=> $_POST['civilite'],
                'ville'=> $_POST['ville'],
                'code_postal'=> $_POST['code_postal'],
                'adresse'=> $_POST['adresse'],
                    ));
        $contenu .= '<div class="alert alert-success">Vous êtes incrit à notre site. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
        $inscription = true;
    }
}

require_once('assets/header.php');
echo $contenu;
if(!$inscription) :
?>
<!--formulaire d'inscription-->
<!-- champs : pseudo,mdp,nom,prenom,mail,civilite,ville,code_postal,adresse -->
<h2 id="titre-form">Formulaire d'inscripton</h2>
<form  novalidate class="form-horizontal" method="post" action="">
<div class="form-group">
        <label for="pseudo" class="col-sm-1 col-sm-offset-3">Pseudo</label>
        <div class="col-sm-6">
            <input type="text"  class ="form-control" name="pseudo" id="pseudo" placeholder="Saisissez votre pseudo"  value="<?= $_POST['pseudo'] ?? '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="mdp" class="col-sm-1 col-sm-offset-3">Mot de passe</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="***"  value="<?= $_POST['mdp'] ?? '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="prenom" class="col-sm-1 col-sm-offset-3">Prénom</label>
        <div class="col-sm-6">
            <input type="text"  class ="form-control" name="prenom" id="prenom" placeholder="Saisissez votre prénom"  value="<?= $_POST['prenom'] ?? '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="nom" class="col-sm-1 col-sm-offset-3">Nom</label>
        <div class="col-sm-6">
            <input type="text"  class ="form-control" name="nom" id="nom" placeholder="Saisissez votre nom"  value="<?= $_POST['nom'] ?? '' ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="email" class="col-sm-1 col-sm-offset-3">Email</label>
        <div class="col-sm-6">
            <input type="email"  class ="form-control" name="email" id="email" placeholder="Saisissez votre email"  value="<?= $_POST['email'] ?? '' ?>">
        </div>
    </div>
   
        <div class="form-group">
            <label for="civilite" class="col-sm-1 col-sm-offset-3">Civilité</label>
            <div class="col-sm-6">
               Monsieur<input type="radio"  id="civilite" name="civilite" value="m" <?=((isset($_POST['civilite']) 
               && $_POST['civilite'] == 'm')) || !isset($_POST['civilite']) ? 'checked' : ''?>>
                Madame<input type="radio"  id="civilite" name="civilite" value="f" <?=((isset($_POST['civilite']) 
               && $_POST['civilite'] == 'f')) ? 'checked' : ''?>>
            </div>
        </div>

    <div class="form-group">
        <label for="ville" class="col-sm-1 col-sm-offset-3">Ville</label>
        <div class="col-sm-6">
            <input type="text"  class ="form-control" name="ville" id="ville" placeholder="Saisissez votre ville" value="<?= $_POST['ville'] ?? '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="code_postal" class="col-sm-1 col-sm-offset-3">Code Postal</label>
        <div class="col-sm-6">
            <input type="text"  class ="form-control" name="code_postal" id="code_postal" placeholder="Saisissez votre code postal" value="<?= $_POST['code_postal'] ?? '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="adresse" class="col-sm-1 col-sm-offset-3">Adresse</label>
        <div class="col-sm-6">       
            <textarea name="adresse" rows="5" cols="45" id="adresse" value="<? $_POST['adresse'] ?? '' ?>"></textarea>
        </div>
    </div>
    <div class="col-sm-offset-6">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>
<?php
endif;

require_once('assets/footer.php');