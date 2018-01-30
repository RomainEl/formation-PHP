<?php

require_once('../assets/init.php');

/* 
    créer un tableau html qui liste tous les membres avec leurs infos
    sauf le mdp
    afficher le nombre de membres
*/
    //changestatut
    if(isset($_GET['action']) && $_GET['action'] =='changestatut' && !empty($_GET['id_membre']))
    {
        if($_GET['id_membre'] != $_SESSION['membre']['id_membre'])
        {
            $resul = executeRequete("SELECT statut FROM membre WHERE id_membre=:id_membre", array
            ('id_membre' =>$_GET['id_membre']));
            $membre =$resul->fetch(PDO::FETCH_ASSOC);
            $newStatut =($membre['statut'] == 0) ? 1 : 0;

            executeRequete("UPDATE membre SET statut=:newstatut WHERE id_membre=:id_membre",
            array('id_membre' =>$_GET['id_membre'],
                  'newstatut' =>$newStatut));
            $contenu .='<div class="alert alert-success">Le statut du membre a été modifié</div>';
        }
    }

    //suppression
    if (isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_membre']))
    {
        if ($_GET['id_membre'] != $_SESSION['membre']['id_membre'])
        {
            executeRequete("DELETE FROM membre WHERE id_membre= :id_membre",array('id_membre' => $_GET['id_membre']));
            $contenu .= '<div class="alert alert-success">Le membre a été supprimé</div>';
        }
    }

if (! estConnecteEtAdmin())
{
    header('location:../connexion.php'); //si pas admin je dégage le vilain. Retounre sur la page connexion.
    exit();
}

$nomtable ="membre";

$resul= executeRequete("SELECT * from ".$nomtable);
?>
<!--<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pseudo</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Civilité</th>
      <th scope="col">Email</th>
      <th scope="col">Ville</th>
      <th scope="col">Code Postal</th>
      <th scope="col">Adresse</th>
      <th scope="col">Statut</th>
 
    </tr>
  </thead>
  <tbody> -->
    <?php //while ($value = $resul-> fetch(PDO::FETCH_ASSOC)){?>
       <!-- <tr>  
            <td><?= $value['id_membre'] ?></td>
            <td><?= $value['pseudo'] ?></td>
            <td><?= $value['nom'] ?></td>
            <td><?= $value['prenom'] ?></td>
            <td><?= $value['civilite'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= $value['ville' ]?></td>
            <td><?= $value['code_postal'] ?></td>
            <td><?= $value['adresse'] ?></td>
            <td><?= $value['statut'] ?></td>
        </tr> -->
      <?php// } ?>
 <!-- </tbody>
</table> -->
<?php
//Correction
$contenu .= "<h3>Affichage des membres</h3>";
$contenu .= "<p>Nb de membres = </p>".$resul->rowCount();
$contenu .= "<table class='table table-striped'>";

//les ENTETES
for($i=0;$i<$resul->columnCount();$i++){
    $colonne = $resul->getColumnMeta($i);
    if($colonne['name'] != 'mdp'){
        $contenu .= '<th>'.ucfirst($colonne['name']).'</th>';
    }
}
$contenu .='<th colspan="2">Actions</th>';
$contenu .='</tr>';
//les DONNEES
while($ligne = $resul->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<tr>';
    
    foreach($ligne as $indice => $information){
        if($indice !='mdp'){
            $contenu .='<td class="text-center">'.$information.'</td>';
        }
        
    }
    if ($ligne['id_membre'] != $_SESSION['membre']['id_membre'])
    {
        $type_action =($ligne['statut']==0 ? 'Promouvoir':'Dégrader');
        $contenu .= '<td><a href="?action=changestatut&id_membre='.$ligne['id_membre'].'">'.$type_action.'</a></td>';
        $contenu .= '<td><a href="?action=suppression&id_membre='.$ligne['id_membre'].'" onclick="return(confirm(\'Etes vous certain de vouloir supprimer ce membre: '.$ligne['nom'].' '.$ligne['prenom']. '?\'))">Supprimer</a></td>';
       
    }
    $contenu .= '</tr>';
}
$contenu .="</table>";

require_once('../assets/header.php');
echo $contenu;
require_once('../assets/footer.php');