<?php

require_once('assets/init.php');

//traitements
if (isset($_POST['ajout_panier']))
{
    $resul=executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit",array('id_produit'=> $_POST['id_produit']));

    if($resul->rowCount() > 0)
    {
        $produit=$resul->fetch(PDO::FETCH_ASSOC);
        //Fonction d'ajout au panier
        ajouterProduitDansPanier($produit['id_produit'],$_POST['quantite'],$produit['prix']);
        //retour à la fiche produit avec la prise en compte de la mise au panier
        header('location:fiche_produit.php?statut_produit=ajoute&id_produit='.$_POST['id_produit']);
    }
    else{
        header('location:fiche_produit.php?id_produit='.$_POST['id_produit']);
    }
}
/*
echo "<pre>";
var_dump($_SESSION['panier']);
echo "</pre>";
*/
//Action vider le panier
if(isset($_GET['action']) && $_GET['action']=='vider')
{
    unset($_SESSION['panier']);
}

//Action de suppression individuelle d'article
if (isset($_GET['action'])&& $_GET['action']=='supprimer_article' && isset($_GET['id_produit']))
{
    retirerProduitPanier($_GET['id_produit']);
}

//Action de valider le panier
if (isset($_POST['valider']))
{
    $id_membre = $_SESSION['membre']['id_membre'];// on récupère l'id du membre
    $montant_total=montantTotal();//on stocke le montant total
    // 1. Insérer la commande en BDD
    executeRequete("INSERT INTO commande (id_membre,montant,date_enregistrement) VALUES (:id_membre,:montant,NOW())",array(
        'id_membre'=>$id_membre,
        'montant' => $montant_total));
    
    //Pour insérer les détails de la commande je récupère son id
    $id_commande = $pdo ->lastInsertId();

    for($i=0;$i<count($_SESSION['panier']['id_produit']);$i++)
    {
        $id_produit = $_SESSION['panier']['id_produit'][$i];
        $quantite = $_SESSION['panier']['quantite'][$i];
        $prix = $_SESSION['panier']['prix'][$i];

        executeRequete("INSERT INTO details_commande(id_commande,id_produit,quantite,prix) VALUES (:id_commande,:id_produit,:quantite,:prix)",array(
                                        'id_commande'=> $id_commande,
                                        'id_produit' => $id_produit,
                                        'quantite'   => $quantite,
                                        'prix'       => $prix));

    // On décrémente le stock
    executeRequete("UPDATE  produit SET stock = stock - :quantite 
    WHERE id_produit=:id_produit",array(
                                    'quantite'=>$quantite,
                                    'id_produit'=>$id_produit));
    }
    //Après les insertions on vide le panier
    unset($_SESSION['panier']);

    $contenu .= '<div class="alert alert-success">Merci pour votre commande. Votre numéro de suivi est le '.$id_commande.'</div>';

    //Envoi éventuel de mail
    ini_set('SMTP','smtp.bouygtel.fr');
    ini_set('sendmail_from','admin@turfuboutik.fr');
    $to = $_SESSION['membre']['email'];
    $object = 'Confirmation de commande';
    $message= 'Merci pour votre commande. Votre numéro de suivi est le '.$id_commande;

    mail($to,$object,$message);
}

//affichage
$contenu.='<h2>Voici votre panier</h2>';

if(empty ($_SESSION['panier']['id_produit']))
{
    $contenu .= '<p>Votre panier est vide :( </p>';
}
else{
    $contenu .='<table class="table table-striped>
                    <tr class="info">
                        <th>Titre</th>
                        <th>Identifiant</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Action</th>
                    </tr>';
    for($i=0; $i< count($_SESSION['panier']['id_produit']);$i++)
    {
        $id_produit = $_SESSION['panier']['id_produit'][$i];
        $resul= executeRequete("SELECT titre FROM produit WHERE id_produit=:id_produit",
                array('id_produit'=>$id_produit));
                $infos = $resul->fetch(PDO::FETCH_ASSOC);
                $titre = $infos['titre'];

        $contenu .='<tr>
                        <td><a href="fiche_produit.php?id_produit='.$id_produit.'">'.$titre.'</a></td>
                        <td>'.$id_produit.'</td>
                        <td>'.$_SESSION['panier']['quantite'][$i].' ex.</td>
                        <td>'.$_SESSION['panier']['prix'][$i].'</td>
                        <td><a href="?action=supprimer_article&id_produit='.$id_produit.'">Supprimer l\'article</a></td>
                    </tr>';
    }
    $contenu.= '<tr class="info">
                    <td colspan="3">Table</td>
                    <td colspan="2">'.montantTotal().' € </td>
                </tr>';
            
    // Si l'internaute est connecté (donc inscrit) on affiche le bouton valider sinon on l'invite à s'inscrire
    if(estConnecte())
    {
        $contenu .='<form method="post" action="">
                        <tr class="text-center">
                            <td colspan="5">
                                <input type="submit" name="valider" value="Valider le panier" class="btn btn-primary">
                            </td>
                        </tr>
                    </form>';
    }
    else{
        $contenu .='<tr class="text-center">
                        <td colspan="5">
                            <p>Veuillez vous <a href="inscription.php">inscrire</a>
                            ou vous <a href="connexion.php">connecter</a> afin de valider votre panier.</p>
                        </td>
                    </tr>';
    }            
    //ajout du lien vider le panier
    $contenu .='<tr class="text-center">
                    <td colspan="5">
                        <a href="?action=vider">Vider le panier</a>
                    </td>
                </tr>';
    
    $contenu .= '</table>';
}

require_once('assets/header.php');

echo $contenu;

require_once('assets/footer.php');

?>