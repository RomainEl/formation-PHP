<?php

require_once('init.php');

if(isset($_GET['action']) && $_GET['action']=='deconnecter')
{
    session_destroy();
    header('location:/formation-PHP/PHP//PHP/cv/admin');
    exit();
}

if ( isset($_POST['connexion']) )
{
    // j'ai cliqué sur "me connecter"
    if ( !empty($_POST['login']) && !empty($_POST['pwd']) )
    {
        $resul = $base->prepare("SELECT * FROM users WHERE login=:login AND password=:password");

        $resul->execute( array('login' => $_POST['login'],
                               'password' => SHA1($_POST['pwd'])
                                ));
        if ( $resul->rowCount() == 1 )
        {
           $_SESSION['user'] = $_POST['login'];
        }
        else
        {
            echo "Erreur sur les identifiants";
        }

    }
}




if ( isset($_SESSION['user']) )
{
    // je suis connecté et j'accède à mon BO
    // echo "youpi ! je me suis connecté";

    $tables_a_exclure=" 'users','messages' ";

    $mestables=$base->query("SHOW TABLES WHERE Tables_in_portfolio NOT IN (".$tables_a_exclure.")");
    while ( $matable = $mestables->fetch(PDO::FETCH_ASSOC))
    {
        echo '<a href="?table='.$matable['Tables_in_portfolio'].'">'.ucfirst($matable['Tables_in_portfolio']).'</a> ';
    }
   
    echo '<a href="?table=messages&option=noform">Message</a>';
    echo '<a href="/formation-PHP/PHP/PHP/cv/" target="_blank">Voir le front</a>';
    echo '<a href="?action=deconnecter">Se déconnecter</a>';
    echo "<hr>";

    //------------------SUPPRESSION------------------------

    if(isset($_GET['action']) && $_GET['action']== 'supprimer' && isset($_GET['table']))
    {
        $table = $_GET['table'];
        $colonnes =$base->query("SHOW COLUMNS FROM ".$table." LIKE 'id_%'");
        $colonne= $colonnes->fetch(PDO::FETCH_ASSOC);

        $indice = $colonne['Field'];
        if(isset($_GET[$indice]))
        {
            $del=$base->prepare("DELETE FROM ".$table." WHERE $indice =:indice_a_supp");
            $del->execute(array('indice_a_supp' => $_GET[$indice]));
        }
    }

    


    //-----------------------------------------------------


    //-----------------TRAITEMENT DU POST EN AJOUT OU MODIF

    if(isset($_POST['update']))
    {
        $champs = array();
        $params = array();
       
        
        foreach($_POST as $index => $valeur)
        {
            if ($index !='table' && $index!='update')
            {
                $champs[] = ':'.$index;
                $params[$index]=$valeur;
            }
        }
        $maj =$base->prepare("REPLACE INTO ".$_POST['table']." VALUES (".implode(',',$champs).")");
        $maj->execute($params);
    }






    //---------------------------------------------------
    if ( !empty($_GET['table']) )
    {
        $table_courante=$_GET['table'];

        // Affichage
        // Formulaire

        $affichage='';
        $formulaire='';

        $resul = $base->query("SELECT * FROM ".$table_courante);

        $affichage .='<table><tr>';
        $nbcolonnes=$resul->columnCount();

        //Si on a cliqué sur modifier, on veut  charger les infos de la ligne dans le formulaire
        if (isset($_GET['action']) && $_GET['action']=='modifier')
        {
            $colonnes =$base->query("SHOW COLUMNS FROM ".$table_courante." LIKE 'id_%'");
            $colonne= $colonnes->fetch(PDO::FETCH_ASSOC);
            $indice_courant = $colonne['Field'];
            if(isset($_GET[$indice_courant]))
            {
                $resul2= $base->query("SELECT * FROM ".$table_courante." WHERE ".$indice_courant."=".$_GET[$indice_courant]);
                /*
                    $resul2=$base->prepare("SELECT * FROM ".$table_courante." WHERE ".$indice_courant."=:indice_courant);
                    $resul2->execute(array('indice_courant'=> $_GET['indice_courant']));
                */
                $ligne_courante= $resul2->fetch(PDO::FETCH_ASSOC);
            }
        }


        $formulaire .='<hr>
        <form action="" method="post">
        <input type="hidden" name="table" value="'.$table_courante.'">';

        for( $i=0; $i < $nbcolonnes; $i++)
        {
          
            $info_colonne=$resul->getColumnMeta($i);
            if ( $i == 0 ) { 
                $indice_table =  $info_colonne['name'];
                $formulaire .='<input type="hidden" name="indice" value="'.(
                    (isset($indice_courant) && isset($ligne_courante[$indice_courant])) ? $ligne_courante[$indice_courant] : 0).'">';
             }

            $affichage .='<th>'.$info_colonne['name'].'</th>';
            if ($i != 0 ){
                $formulaire .='<p><label for="'.$info_colonne['name'].'">'.$info_colonne['name'].'</label> ';
                if ( $info_colonne['name'] == 'description')
                {
                    $formulaire .='<textarea name="'.$info_colonne['name'].'" cols="40" rows="5">'.($ligne_courante[$info_colonne['name']] ?? '').'</textarea></p>';
                }
                else
                {
                $formulaire .='<input type="text" id="'.$info_colonne['name'].'" name="'.$info_colonne['name'].'" value="'.($ligne_courante[$info_colonne['name']] ?? '').'"></p>';
                }
            }
        }
        $affichage .='<th colspan="2">Actions</th>';
        $affichage .='</tr>';
        $formulaire .='<input type="submit" name="update" value="Valider">
                      </form>';

        // lignes
        while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC))
        {
            $affichage .="<tr>";
                foreach ( $ligne as $information)
                {
                    $affichage .="<td>".$information."</td>";
                }
                if(!(isset($_GET['option']) && $_GET['option']== 'noform'))
                { 
                    $affichage .='<td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table].'&action=modifier">Modifier</a></td>';
                }     
               
                 $affichage.= '<td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table].'&action=supprimer';
                 
                 if((isset($_GET['option']) && $_GET['option'] == 'noform'))
                 {
                     $affichage .= '&option=noform';
                 }

                 $affichage .= '"onclick="return(confirm(\'Etes vous certain de vouloir supprimer cette ligne?\'))">Supprimer</a></td>';    
            $affichage .="</tr>";
           
        }

        $affichage .="</table>";
        echo $affichage;
        if(!(isset($_GET['option']) && $_GET['option']== 'noform'))
        {
            echo $formulaire;
        }
    }


}
else
{
    // je ne suis pas encore connecté
    // et j'affiche le formulaire de connexion
    ?>
    <form action="" method="POST">

    <label for="login">Login</label>
    <input type="text" name="login" id="login">
    <label for="pwd">Mot de passe</label>
    <input type="password" name="pwd" id="pwd">

    <input type="submit" name="connexion" value="Me connecter">

    </form>
    <?php
}   