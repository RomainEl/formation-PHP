<?php
	 require_once('admin/init.php');

	 if ( $_POST)
	 {
		 
		 if (!empty($_POST['email']) 
			  && !empty($_POST['objet'])
			  && !empty ($_POST['msg'])
		 )
		 {
			 $email = htmlspecialchars($_POST['email']);	
			 $objet = htmlspecialchars($_POST['objet'],ENT_QUOTES);
			 $msg = htmlspecialchars($_POST['msg'],ENT_QUOTES);
	 
			 $req = $base->prepare("INSERT INTO messages VALUES (NULL,:email,:objet,:msg,NOW())");
			 $req->execute(array('email' => $email,
								 'objet' => $objet,
								 'msg' => $msg));
		 }
	 
	 }
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- métadonnées -->
		<meta charset="utf-8">
		<title>Mon titre</title>
		<meta name="description" content="ma description">
		<meta name="keywords" content="mots clés, clefs">
		<!-- fichiers css -->
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
	</head>
	<body>
		
		<!-- Présentation / Réalisations / Parcours / Contact -->
		<header>
			<div class="conteneur ligne">
				<div class="block40">
					<h1>
						<a href="index.html">Romain ELIE</a>
					</h1>
				</div>
				<div class="block60 ligne">
					<nav class="ligne">
						<a href="#link1">Présentation</a>
						<a href="#link2">Réalisations</a>
						<a href="#link3">Parcours</a>
						<a href="#link4">Contact</a>
					</nav>
				</div>
			</div>
		</header>
		<section id="section1" "couleur1">
			<div id="link1"></div>
			<div class="conteneur ligne" >
				<div class="block70">
					<h2>Qui suis-je ?</h2>
					<p>
						<img class="imageronde" src="images/avatar.png" alt="mon avatar">
						Vous êtes à la recherche d'un développeur pour gérer vos projets web ?<br>
						Je peux renforcer votre équipe, autant sur la partie graphique que sur le développement.
						<br>
						<br>
						Seriez vous prêt à me donner ma chance ?
					</p>
				</div>
				<div class="block30">
					<h2>Compétences</h2>
					<ul>
						<?php
						$competences = $base->query("SELECT * FROM competences");

						while($competence =$competences->fetch(PDO::FETCH_ASSOC))
						{
							echo '<li>
									<h3>'.$competence['titre'].'</h3>
									<div class="jauge_fond">
										<div class="jauge_couleur" style="background:'.$competence['couleur'].' ; width:'.$competence['pourcentage'].'%;">
											
										</div>
									</div>
								</li>';
						} 
						?>
					</ul>
				</div>
				<div class="block100 ligne">
					<h2>Mes langages favoris</h2>
					<?php

					$langages= $base->query("SELECT * FROM langages");

					while($langage = $langages->fetch(PDO::FETCH_ASSOC))
					{
						echo'<div class="block25">
								<img src="'.$langage['image'].'" alt="'.$langage['alt'].'">
							</div>';
					}
					?>
				</div>
			</div>
		</section>
		<section id="section2" class="couleur2">
			<div id="link2"></div>
			<div class="conteneur ligne">
				<h2>Réalisations</h2>
				<?php
					$realisations = $base->query("SELECT * FROM realisations");

					while($realisation = $realisations->fetch(PDO::FETCH_ASSOC)){
						echo'<div class="block33">
								<figure>
									<img src="'.$realisation['image'].'" alt="'.$realisation['alt'].'">
									<figcaption>
										<h3>
											<a href="">'.$realisation['legende'].'</a>
										</h3>
									</figcaption>
								</figure>
							</div>';
					}
            ?>
			</div>
		</section>
		<section id="section3" class="couleur3">
			<div id="link3"></div>
			<div class="conteneur ligne">
				<div class="block66">
					<h2>Expériences</h2>
					<?php
					$experiences = $base->query("SELECT * FROM experiences ORDER BY date_debut DESC");

					while($experience= $experiences->fetch(PDO::FETCH_ASSOC))
					{
						//Si annee_deb est un DateTime en SQL
						$date_formatee=new DateTime($experience['date_debut']);
						$date_debut= $date_formatee->format('d/m/Y');
						echo'<table>
								<tr>
									<td class="year" rowspan="2">'.$experience['date_debut'].'
										<p>'.$experience['date_fin'].'</p>
									</td>
									<td class="job">'.$experience['job'].'</td>
								</tr>
								<tr>
									<td class="job_desc">'.$experience['job_desc'].'</td>
								</tr>
							</table>';
					}
					?>
				</div>
				<div class="block33 couleur1">
					<h2>Formation</h2>
					<?php
					$formations = $base->query("SELECT * FROM formations ORDER BY date_debut DESC");

					while($formation= $formations->fetch(PDO::FETCH_ASSOC))
					{
						echo'<table>
								<tr>
									<td class="year" rowspan="2">'.$formation['date_debut'].'
										<p>'.$formation['date_fin'].'</p>
									</td>
									<td class="job">'.$formation['intitule'].'</td>
								</tr>
								<tr>
									<td class="job_desc">'.$formation['resume'].'</td>
								</tr>
							</table>';
					}
					
					?>
				</div>
			</div>
		</section>
		<?php
		/*if ($_POST){
			$expediteur   = 'From: '.$_POST['email'];
			$destinataire = 'elie_romain@hotmail.com';
			$sujet        = $_POST['objet'];
			$message      = $_POST['zonedetexte'];

			mail($destinataire,$sujet,$message,$expediteur);
		}*/
		?>
		<section id="section4" class="couleur4">
			<div id="link4"></div>
			<div class="conteneur ligne">
				<div class="block50">
					<h2>Cordonnées</h2> 
					
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2622.7445858283354!2d2.3078980010432653!3d48.90120462919008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f094133c7ff%3A0x69403f6d0e6543cf!2s17bis+Rue+Morice%2C+92110+Clichy!5e0!3m2!1sfr!2sfr!4v1513093577498" width="80%" height="250px" frameborder="0" style="border:0" allowfullscreen></iframe>
					
					
				</div>
				<div class="block50">
					<h2>Contactez-moi</h2>
					<form method="post" action="" enctype="multipart/form-data">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" placeholder="Entrez votre email" required> 
						<label for="objet">objet</label>
						<input type="text" name="objet" id="objet" placeholder="Votre objet ici"required>
						<label for="msg"></label>
						<textarea id="msg" name="msg" placeholder="Votre message ici"required></textarea>
						<input type="submit" name="envoyer" value="Envoyer">						
					</form>
				</div>
			</div>
		</section>
		<footer>
			<div class="conteneur">Bas de page</div>
		</footer>
	</body>
</html>