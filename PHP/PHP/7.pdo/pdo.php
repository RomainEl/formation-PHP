<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"
</head>
<body>
    

<?php

//PDO : Php Data Object

echo "<h2>01 - PDO: Connexion</h2>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',
              'root',
              '',
              array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));
echo "<h2>02 - PDO: Insert,Update,Delete</h2>";
/*
$pdo-> exec("INSERT INTO employes VALUES(NULL,'test3','test3','M','commercial','2018-01-22',500)");
echo 'dernier id ajouté: '.$pdo->lastInsertId();
$dernier_id = $pdo->lastInsertId();

$pdo->exec("UPDATE employes SET salaire=1400 WHERE id_employes=".$dernier_id);
*/

$resul = $pdo->exec("DELETE FROM employes WHERE id_employes BETWEEN '8006' AND '8010'");
echo $resul;// vaut  4 au premier affichage, puis 0 si on rafraichit

//$pdo->exec exécute une requete directe (insert, update, delete)
//si je stocke l'execution dans une variable (ex:resul), il contiendra le nombre de lignes
// affectées par la requête

echo "<h2>03 - PDO: Select</h2>";

$resul = $pdo->query("SELECT * FROM employes WHERE prenom='daniel'");

echo '<pre>';
var_dump($resul);
var_dump(get_class_methods($resul));
echo'</pre>';

$employe_daniel = $resul->fetch(PDO::FETCH_ASSOC);

//var_dump($employe_daniel);

echo 'Bonjour, je suis '.$employe_daniel['prenom'].' '.$employe_daniel['nom'].' du service '.$employe_daniel['service'].'<br>';

/*
$pdo est un objet(1) issu de la classe prédéfinie PDO. Quand on exécute une requête 
de sélection via la méthode query() sur l'objet PDO, on obtient un autre objet(2)
issu de la classe PDOStatement qui a ses propres propriétés et méthodes.

Si on exécute une requête de type INSERT,UPDATE,DELETE avec un query() au lieu de
exec(), on obtient un booleen.
*/
echo'<hr>';

// SELECT avec plusieurs résultats

$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

echo 'Nombre de commerciaux : '.$resul->rowCount().'<br>';

while($contenu = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo $contenu['prenom'].' '.$contenu['nom'].' ('.$contenu['sexe'].') <br>';
}

//SELECT tableau multidimensionnel
$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

$donnees = $resul->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
//var_dump($donnees);
echo"</pre>";

foreach($donnees as $indice1 => $contenu1)
{
    echo"<div class=\"madiv\">";
    foreach($contenu1 as $indice2 => $contenu2)
    {
        echo"$indice2 : $contenu2 <br>";
    }
    echo"</div>";
}

// EXERCICE: Afficher la liste des bases de données dans une liste html

$bdd = new PDO('mysql:host=localhost',
                'root',
                '',
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )); 

  var_dump($bdd);

  $resul = $bdd->query("SHOW DATABASES");

  //$valeur = $resul->fetch(PDO::FETCH_ASSOC);
  //  var_dump($valeur);
  echo '<ul>';
    while ($valeur = $resul->fetch(PDO::FETCH_ASSOC))
    {
        echo '<li>'.$valeur['Database'].'</li>';
    }
  echo '</ul>';

// Version bonus


$resul = $bdd->query("SHOW DATABASES");

//$valeur = $resul->fetch(PDO::FETCH_ASSOC);
//  var_dump($valeur);
echo '<ul>';
  while ($valeur = $resul->fetch(PDO::FETCH_ASSOC))
  {
    $database =  $valeur['Database'];
    echo '<li>'.$database.'<ul>';
        $bdd ->exec("USE `".$database."`");
        $resul2 = $bdd->query("SHOW TABLES");
        while($table =$resul2->fetch(PDO::FETCH_ASSOC))
        {
            //ex: Tables_in_Bibliotheque
            echo"<li>".$table['Tables_in_'.$database]."</li>";
        }
    echo '</ul></li>';
  }
echo '</ul>';

//parcours de table

$pdo->exec('USE bibliotheque');

$nomtable ="abonne";

$resul= $pdo->query("SELECT * from ".$nomtable);

echo "<table><tr>";

// générer les entêtes de colonnes
$nbcolonnes = $resul->columnCount();// columnCount() renvoie le nbre de colonnes
for($i=0; $i < $nbcolonnes; $i++)
{
    $infocolonne = $resul->getColumnMeta($i);
    //getColumnMeta(index) envoie les informations d'une colonne comme son
    //type, son nom et sa longeur. Dans notre ex c'est l'index [name] qui
    //nous intéresse
    echo '<th>'.$infocolonne['name'].'</th>';
}
echo'</tr>';

//parcours des enregistrements
while($ligne = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo'<tr>';
        foreach($ligne as $information){
            echo"<td>$information</td>";
        }
    echo'</tr>';
}
echo'</table>';

echo"<h2>PDO: prepare, bindParam, bindValue, execute</h2>";

$pdo->exec('USE entreprise');
$nom = 'sennard';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom= :nom");
$resul->bindParam(':nom',$nom,PDO::PARAM_STR);//bindParam recoit exclusivement une variable
$resul->execute();

$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);
echo'<br>';

$nom = 'thoyer';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom= :nom");
$resul->bindValue('nom','thoyer',PDO::PARAM_STR);//bindParam recoit une variable ou une chaine de caracteres
$resul->execute();

$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);
?>
</body>
</html>