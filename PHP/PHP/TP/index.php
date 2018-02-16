<?php
    require_once('admin/init.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programmation TF2</title>
    <link rel="stylesheet" href="<?= ROOT_SITE.'assets/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?= ROOT_SITE.'assets/css/style.css'?>">
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TF2</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                </ul>
    </header>

    <main>
        <div class="row">
            <div class="col-sm-12">
                <h2>Votre programmation</h2>
                <ul class="list-group">
                    <?php
                        $programmes= $base->query("SELECT * FROM programmation");

                        while($programme= $programmes->fetch(PDO::FETCH_ASSOC))
                        {
                            echo'<li class="list-group">
                                    <div class="container">
                                        <div class="col-md-8">
                                            <h3>'.$programme['nom'].'</h3>
                                            <h4>'.$programme['date_debut'].'-'.$programme['date_fin'].'</h4>
                                            <p>'.$programme['genre'].':'.$programme['description'].'</p>
                                            <p>'.$programme['public'].'</p>
                                        </div>
                                        <div class="col-md-4">
                                            <img class="img-responsive" src="'.$programme['image'].'">
                                        </div>
                                    </div>
                                 </li>
                                 <hr>';
                        }

                    ?>
                </ul>

    </main>

    <footer>
    <footer>
        <div>&copy Copyright TF2-Tous droits réservés</div>
   </footer>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>