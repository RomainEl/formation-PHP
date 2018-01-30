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

echo "<pre>";
var_dump($_SESSION['panier']);
echo "</pre>";

//affichage

require_once('assets/header.php');

echo $contenu;

require_once('assets/footer.php');

?>