<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turfu Boutik</title>
    <!-- liens CSS -->
    <link rel="stylesheet" href="<?= RACINE_SITE.'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= RACINE_SITE.'assets/css/style.css' ?>">
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" data-target="#monmenu">
                        <span class="sr-only">Naviguer</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= RACINE_SITE ?>">Turfu Boutik</a>
                </div>
                <div class="collapse navbar-collapse" id="monmenu">
                    <ul class="nav navbar-nav">
                            <?php

                                if(estConnecteEtAdmin()){
                                    echo'<li><a href="'.RACINE_SITE.'admin/gestion_boutique.php">Gestion Boutique</a></li>';
                                    echo'<li><a href="'.RACINE_SITE.'admin/gestion_membre.php">Gestion Membres</a></li>';
                                    echo'<li><a href="'.RACINE_SITE.'admin/gestion_commandes.php">Gestion Commandes</a></li>';
                                }
                                if(estConnecte()){
                                    echo'<li><a href="'.RACINE_SITE.'profil.php">Mon Compte</a></li>';
                                    echo'<li><a href="'.RACINE_SITE.'connexion.php?action=deconnexion">Se déconnnecter</a></li>';

                                }
                                else{
                                    echo'<li><a href="'.RACINE_SITE.'inscription.php">Inscription</a></li>';
                                    echo'<li><a href="'.RACINE_SITE.'connexion.php">Connexion</a></li>';
                                }
                                echo '<li><a href="'.RACINE_SITE.'panier.php">Panier '.nbArticlesPanier().'</a></li>'; 
                            
                            ?>
                        </ul>
                    </div>
                
            </div>
        </nav>
    </header>
    <div class="container main">

    