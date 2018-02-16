<?php

function estConnecte(){
    // la présence de l'index membre dans la superglobale $_SESSION indique que le membre est connecté
    if (isset($_SESSION['membre']))
    {
        return true;
    }
    else{
        return false;
    }
}

function estConnecteEtAdmin(){
    // si il est connecté ET que son statut vaut 1 c'est qu'il s'agit d'un admin
    if(estConnecte() && $_SESSION['membre']['statut'] == 1)
    {
        return true;
    }
    else{
        return false;
    }
}

function executeRequete($sql, $params=array())
{
    if(!empty($params))
    {
        foreach($params as $indice => $param)
        {
            $params[$indice] = htmlspecialchars($param,ENT_QUOTES);
        }
    }
    global $pdo;
    $r = $pdo->prepare($sql);
    $r->execute($params);

    if(!empty($r->errorInfo()[2])){
        die('<p>Erreur recontrée pendant la requête.Message: '.$r->errorInfo()[2].'</p>');
    }
    return $r; // on retourne l'objet issu de la requête à l'endroit où la fonction a été appelée
}
//--------------------------------------------------------------------------------------------------------
// Fonctions liées au panier

function creationPanier()
{
    //si le panier n'existe pas on le créé vide
    if(!isset($_SESSION['panier']))
    {
        $_SESSION['panier']= array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}

function ajouterProduitDansPanier($id_produit,$quantite,$prix)
{
    creationPanier();

    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);

    if($position_produit === false)
    {
        $_SESSION['panier']['id_produit'][]=$id_produit;
        $_SESSION['panier']['quantite'][]=$quantite;
        $_SESSION['panier']['prix'][]=$prix;
    }
    else{
        $_SESSION['panier']['quantite'][$position_produit] += $quantite;
    }
}


function nbArticlesPanier(){
    $nb ='';
    if(isset($_SESSION['panier']['id_produit']))
    {
        $nb= array_sum($_SESSION['panier']['quantite']);
        if($nb != 0)
        {
            $nb = '<span class="badge">'.$nb.'</span> ('.montantTotal().' €)';
        }
        else
        {
            $nb = '';
        }
    
    } 
    return $nb;
}

function montantTotal()
{
    $total=0;

    for($i=0; $i< count($_SESSION['panier']['id_produit']); $i++)
    {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }
    return $total;
}

function retirerProduitPanier($id_article_a_supp)
{
    // On cherche d'abord la position du produit dans le panier
    $position_produit = array_search($id_article_a_supp,$_SESSION['panier']['id_produit']);
    
    if($position_produit !== false)
    {
        //si on a trouvé le produit(la fonction n'a pas renvoyé exactement un booleen FALSE)
        array_splice($_SESSION['panier']['id_produit'],$position_produit,1);
        array_splice($_SESSION['panier']['quantite'],$position_produit,1);
        array_splice($_SESSION['panier']['prix'],$position_produit,1);

        //aray_splice efface et remplace une portion de tableau à partir de l'indice et sur 1 indice(1 ligne)
    }
}