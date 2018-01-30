<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bases du PHP</title>
    <link rel='stylesheet' href='assets/styles.css'>
</head>
<body>
    <h2>Bases du PHP</h2>
    <?php
        // Ceci est  un commentaire PHP sur une ligne

        /*
        Ceci est 
        un commentaire PHP
        sur plusieurs 
        lignes
        */

        // echo est une instruction qui nous permet d'effectuer un affichage
        echo '<strong>HELLO WORLD !</strong>';
        
        print 'nous sommes jeudi';

        echo '<hr>';

        echo '<hr><h2>VARIABLES : type, déclaration, affectation</h2>';

        $a = 127; // On affecte la valeur 127 à la variable a
        echo 'a est de type ';
        echo gettype($a); // gettype() est une fonction php qui renvoit le type de la variable entre les parenthèses

        $b = 'Bonjour';
        echo '<br>b est de type ';
        echo gettype($b);

        $c = true;
        echo '<br>c est de type ';
        echo gettype($c);

        echo '<br>a vaut $a';
        echo "<br>a vaut $a"; // entre guillemets les variables sont interprétées

        echo '<br><br><h2>CONCATENATION</h2>';
        echo 'a est de type ' . gettype($a);
        echo '<br>a vaut ' . $a . '<br>' ;

        echo '<input type="text" name="nom">';
        echo 'aujourd\'hui'; // le caractère d'échappement est le backslash '\'
        echo "<br>aujourd'hui<br>";

        $prenom1 = "Jean";
        $prenom1 = "Claire";
        echo $prenom1;
        echo '<br>';
        $prenom2 = "Nicolas";
        $prenom2 .= "Marie"; // le .= permet la concatenation 
        echo $prenom2;

        /**
         * Exercice
         * Mettez votre prénom dans une variable, puis d'afficher Bonjour concaténé à votre prénom
        */    
        
         $prenom= "Romain";
         echo "<br>Bonjour $prenom";// solution 1
         
         echo '<br>Bonjour' .$prenom;// solution 2
         $monprenom = 'Bonjour ';// solution 3
         $monprenom .= 'Romain';

        echo'<br><h2>CONSTANTES ET CONSTANTES MAGIQUES</h2>';

        define('CAPITALE','Paris');// Je définis une constante CAPITALE
        echo CAPITALE.'<br>';
        //define('CAPITALE','Lyon'); On ne peut pas modifier ou reféfinir une constante.

        // exemple de constantes magiques :
        echo __FILE__; // chemin et nom de fichier en cours
        echo'<br>';
        echo __LINE__; // numero de la ligne où on écrit cette instruction
        echo'<br>';

        echo"<h2>OPERATEURS ARITHMETIQUES</h2>";

        $a = 10;
        $b = 2;

        echo $a + $b . '<br>';
        echo $a - $b . '<br>';
        echo $a / $b . '<br>';
        echo $a * $b . '<br>';

        //Opérations + réaffectation
        
        $a += $b; // $a = $a + $b 
        echo $a . '<br>';
        $a -= $b; // $a = $a - $b 
        echo $a . '<br>';
        $a++; // j'incrémente: $a = $a + 1;
        echo $a . '<br>';
        $a += 2; // $a = $a + 2;
        echo $a . '<br>';
        $a--; // je décrémente: $a = $a - 1;
        echo $a . '<br>';

        echo "<h2>STRUCTURES CONDITIONNELLES (IF/ELSE) - OPERATEURS DE COMPARAISON</h2>";

        // isset et empty
        $var1= 0;
        $var2= '';        

        if (empty($var1)) echo '0, vide ou non définie<br>';
        if (isset($var2)) echo 'var2 existe et est définie par rien <br>';
        if (isset($var3)) echo 'var 3 est défini<br>';
        if (isset($var3)) echo 'var 3 vaut soit 0, soit est vide, soit n\'est pas défini<br>';
        
        /*empty vérifie si la variable testée est  : 
            - non définie
            - définie à 0
            - vide
         isset vérifie si la variable est définie (indépendamment de sa valeur)
         ex: empty nous permettra de tester si un champ de formulaire a été laissé vide
        */

        // if, else, elseif
        $a = 10;
        $b = 5;
        $c = 2;
        if ($a > $b) {
            echo "a est supérieur à b";
        }
        else{
            echo "a est inférieur à b";
        }
        // Equivalent
        if ($a > $b) :
            echo "<br>a est supérieur à b";
        else :
            echo "<br>a est inférieur à b";
        endif;

        // Conditions ET &&
        echo "<hr>";
        if ( $a > $b && $b > $c){
            echo "OK pour les 2 conditions";
        }

        // Conditions OU ||
        if ( $a==9 || $b > $c){
            echo "<br>OK pour au moins une des conditions";
        }

        // Conditions OU exclusif XOR
        if ( $a==10 XOR $b==6 ){
            echo "<br>OK pour une des conditions seulement<br>";
        }

        // IF forme contractée
        echo ( $a == 10 ) ? "a est égal à 10<br>" : "a n'est pas égal à 10<br>";

        $var1 = isset($maVar) ? $maVar : 'valeur_par_defaut<br>';
        echo $var1;

        // Ternaire courte PHP 7
        $var2 =  $maVar ?? 'valeur_par_defaut<br>'; // équivalent  $var2 = isset($maVar) ? $maVar : 'valeur_par_defaut'
        echo $var2;

        $var3 = $maVar1 ?? $maVar2 ?? 'valeur_par_defaut'; // avec cette formulation, on affectera à var3 la première des valeurs définies(maVar1 ou maVar2) sinon ce sera la valeur par défaut

        exemple:
        ?>
        
        <input type="text" value="<?= $_POST['email'] ?? '' ?>" name="email"> <!-- php 7 -->
        <input type="text" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email"> <!-- php 5 -->

        <?php

        $a = 1;
        $b = "1";

        if( $a == $b){
            echo "<br>c'est la même chose en valeur";
        }
        if( $a === $b){
            echo "<br>c'est la même chose en valeur et en type";
        }

        /*
          = affectation ex: $a = 5;
          == comparaison en valeur ex: if($a == $b)
          === comparaison en valeur et en type ex: if($a === $b) 
        */

        echo("<br>");
        if( !isset($var4) )
        {
            echo "var4 n'est pas définie";
        }
        $a=5;
        $b=2;
        if( $a != $b)
        {
            echo'<br>a est différent de b';
        }

        echo'<hr>';
        //elseif

        $couleur ='noir';
        if($couleur== 'bleu')
        {
            echo'vous aimez le bleu<br>';
        }
        elseif($couleur== 'rouge')
        {
            echo'vous aimez le rouge<br>';
        }
        elseif($couleur== 'vert')
        {
            echo'vous aimez le vert<br>';
        }
        else
        {
            echo'vous n\'aimez ni le bleu ni le rouge ni le vert<br><br>'; 
        }

        echo'<h2>CONDITIONS SWITCH</h2>';

        switch($couleur){
            case 'bleu': echo'vous aimez le bleu<br>';
            break;

            case 'rouge': echo'vous aimez le rouge<br>';
            break;

            case 'vert': echo'vous aimez le vert<br>';
            break;

            default: echo'vous n\'aimez ni le bleu ni le rouge ni le vert'; 
            break;
        }

        echo'<h2>FONCTIONS PREDEFINIES</h2>';

        echo 'Date : '.date('d/m/Y');
        echo'<br>';
        //mktime(0,0,0,1,1,2018) heure, minute, seconde, mois, jour, année

        echo mktime(0,0,0,12,25,1984);
        echo'<br>';
        echo 'Le 25 décembre 1984 tombait un '.date('l', mktime(0,0,0,12,25,1984));
        echo '<br>';
        echo 'Maintenant : '.date('Y-m-d H:i:s').' et nous sommes en semaine '.date('W');
        echo '<hr>';

        // Traitement de chaines de caractères
        $email = 'prenom@site.fr';
        echo strpos($email,'@');//strpos indique la position du caractère @ dans la chaine $email

        echo'<br>';
        $email2 = 'bonjour';
        echo strpos($email2,'@');
        if(strpos($email2,'@'))
        {
            echo "le signe @ dans la chaine $email2 se trouve à la position ".strpos($email2,'@')."<br>";
        }
        else
        {
            echo "Je n'ai pas trouvé le signe @ dans ton $email2 <br>";
        }

        var_dump(strpos($email2,'@'));
        echo'<hr>';

        $phrase = 'Voici une phrase totalement inutile, qui ne sert à rien.';
        echo strlen($phrase);
        echo'<br>';
        $texte = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu aliquet ipsum. Quisque sit amet scelerisque est. Praesent vitae sem quam. Curabitur facilisis quam quis tellus consequat, et tempor lacus rutrum. Maecenas malesuada odio ut dui interdum, at faucibus erat hendrerit. Quisque venenatis diam in lorem pellentesque, sed efficitur purus faucibus. In sapien dolor, tempor quis metus eu, ultrices condimentum purus. Nulla facilisi. Duis sed tristique velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc elementum ultricies augue quis pellentesque. Proin nec turpis fermentum, iaculis ante vehicula, fringilla massa. Nunc porta accumsan volutpat. Vivamus non cursus nisi. In non ullamcorper felis, non bibendum lacus. Ut id nibh sodales, rhoncus nisi eu, faucibus nulla.';

        // substr extrait une sous-chaine de la chaine $texte, en partant de la position 0 et sur une longueur de 50 caractères.
        echo substr($texte,0,50).'...<a href="">Lire la suite</a>';

        echo"<h2>FONCTIONS UTILISATEUR</h2>";

        function vdm($var){
           echo'<pre>';
           var_dump($var);
           echo'</pre>';
        }

        vdm($texte);

        function separation(){
            return'<hr>';
        }

        echo separation();

        function bonjour($qui){
            return 'Bonjour '.$qui. '!';
        }

        $prenom = 'Chloe';
        echo bonjour($prenom);
        
        echo '<br>';

        function appliqueTva($nombre)
        {
            return $nombre*1.2;
        }
        
        function appliqueTva2($nombre, $taux=1.2)
        {
            return $nombre * $taux;
        }
        echo "10 euros avec tva à 20% font ".appliqueTva(10). " € <br>";
        echo "100 euros avec tva à 20% font ".appliqueTva(100). " € <br>";
        echo "100 euros avec tva à 5,5% font ".appliqueTva2(100,1.055). " € <br>";

        echo appliqueTva2(100).'<br>';
        echo appliqueTva2(100,1.055);
        echo separation();

        function jourSemaine()
        {
            $jour="lundi";
            return $jour;
            echo"allo"; // cette commande se sitant après le return ne sera pas executée
        }

        // echo $jour; ne fonctionne pas car la variable $jour n'est connue que dans la fonction (variable locale)
        $recup = jourSemaine();
        echo $recup;

        $pays = 'France';
        function affichePays()
        {
            global $pays; // Je globalise la variable pays dans la fonction car elle fait partie de l'environnement global
            echo $pays.' '.CAPITALE; // Une constante est d'office globalisée
        }
        affichePays();

        echo'<hr>';
        function facultatif()
        {
            //vdm(func_get_args());
            // func_get_args() est une commande qui créé un tableau associatif avec les arguments fournis à la fonction dans laquelle je l'appelle.
            foreach(func_get_args() as $indice => $element)
            { 
                echo $indice.' -> '.$element.'<br>';
            }
        }

        facultatif();
        facultatif("France","Italie");
        facultatif(1,2,3);

        echo "<hr><h2>STRUCTURES ITERATIVES : BOUCLES</h2>";

        // boucle while
        $i = 0;// situation de départ
        while ($i < 3)// tant que la condition est vraie, je boucle 
        {
            echo "$i -- ";
            $i++;// incrémentation de i;
        }
        echo '<br>';         
        // Exercice : ecrire une boucle while pour compter de 0 a 10 de 2 en 2

        $i=0;
        while($i<=10)
        {
            echo $i.'<br>';
            $i += 2;
        }

        echo'<hr>';
        //boucle for
        for($j=0; $j <= 10; $j++)
        {
            echo $j.'#';
        }
        echo'<hr>';
        ?>
        
        <!-- exercice: Faire un select allant de l'année courante à 1950-->
        <select name="annee">
            <?php
               for($k=date('Y') - 13; $k >= 1950; $k--)
                {
                    echo'<option value="' .$k. '">'.$k.'</option>';
                }
            ?>
        </select>

        <table>
            <tr>
                <td>1</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
        </table>
        <?php
        //Exercice : boucles imbriquées
        // générer un tableau de 15 par 20
        // 15 colonnes, 20 lignes
        ?>
        <hr>
        <table>
            <?php 
            $f=1;
            for ($l=0; $l<20;$l++){
                echo'<tr>';
                    for($m=0;$m<15;$m++){
                        echo '<td>'.$f++.'</td>';
                    }
                echo'</tr>';
            }
           ?>
        </table>
        <?php
        echo "<h2>INCLUSION DE FICHIERS</h2>";

        echo "première fois<br>";
        include('exemple.php');
        echo'<br>';

        echo "deuxième fois<br>";
        include_once('exemple.php'); //Vu qu'il a déjà été inclus il ne s'affiche plus
        echo'<br>';

        echo "troisième fois<br>";
        require('exemple.php');
        echo'<br>';

        echo "quatrième fois<br>";
        require_once('exemple.php');
        echo'<br>';

        echo'<hr>';

        echo'<h2>TABLEAUX DE DONNEES: ARRAY</h2>';
        
        $liste = array('Ruben','Hamid','Moundir', 'Olivier','Romain','Chloe');

        vdm($liste);

        $fruits = array ();
        $fruits[]= 'pomme';
        $fruits[]= 'poire';
        $fruits[]= 'orange';

        vdm($fruits);

        $legumes = array('p'=>'poireau','h' =>'haricot','c' => 'carotte');
        vdm($legumes);

        $legumes[] = 'citrouille';
        $legumes['s'] = 'salade';
        vdm($legumes);

        $legumes['s'] = 'oignon';
        vdm($legumes);

        $legumes[] = 'poivron';
        vdm($legumes);

        $legumes[99]= 'courgette';
        $legumes[]= 'concombre';
        vdm($legumes);

        //boucle foreach

        foreach($legumes as $info){
            echo $info.'<br>';
        }
        echo('<br>');
        foreach($legumes as $indice => $valeur)
        {
            echo "à l'indice $indice je trouve $valeur <br>";
        }
        
        // syntaxe : foreach (nom_tableau_a_parcourir as index => valeur)
        //           foreach (nom_tableau_a_parcourir as valeur)


        // Tableau multidimensionnel

        $superheros = array(
            'Superman' => array (
                'nom' => 'Kent',
                'prenom' => 'Clark',
                'univers'=> 'DC Comics'),
            'Spiderman' => array (
                'nom' => 'Parker',
                'prenom' => 'Peter',
                'univers' => 'Marvel'),
            'Batman' => array (
                'nom' => 'Wayne',
                'prenom' => 'Bruce',
                'univers' => 'DC Comics'),
            'Ironman' => array (
                'nom' => 'Stark',
                'prenom' => 'Tony',
                'univers'=> 'Marvel'),
        );
        //vdm($superheros);
        echo'<hr>';
        echo count ($superheros);
        echo'<br>';
        echo sizeof($superheros);
        // count et size of indiquent tous  deux le nombre d'entrées dans mon tableau.

        echo'<br>';
        echo $superheros ['Batman']['prenom'];
        echo'<br>';
        echo $superheros ['Spiderman']['univers'];
        echo'<br>';
        foreach($superheros as $heros => $valeur)
        {
            echo '<p>'.$heros.'</p>';
            foreach($valeur as $info => $valeur2){
                echo $valeur2;
            }
        }

        echo'<br>';
        $fruits2 = array ('pomme','cerise','orange');

        $nbelements = count($fruits2);

        for( $i=0; $i < $nbelements; $i++)
        {
            echo $fruits2[$i].'-';
        }

        echo'<br>';

        echo'<h2>OBJETS</h2>';

        class Etudiant
        {
            public $prenom = 'Julien';
            public $age    = 25;
            public function pays(){
                return 'France';
            }
        }

        $objet = new Etudiant;
        vdm($objet);

        vdm(get_class_methods($objet));

        echo $objet -> age .'<br>';
        echo $objet ->pays();
        $objet->prenom = 'Jeanne';
        vdm($objet);

        $objet2 = new Etudiant;
        vdm($objet2);

        foreach ($objet2 as $valeur){
            echo $valeur;
        }
        ?>
    <!-- < ?=  est équivalent  à < ?php echo. Une instruction php sur une seule ligne ne nécessite pas de ; à la fin de la ligne-->
    <?= '<br>©Allo quoi'
    ?>
</body>
</html>