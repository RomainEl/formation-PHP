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
						<li>
							<h3>Sourire le matin</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background: #87c6bf; width:60%">
								
								</div>
							</div>
						</li>
						<li>
							<h3>Faire le café</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background: #ffd1ae; width: 15%"
								</div>
							</div>
						</li>
						<li>
							<h3>Rentrer tard du travail</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background: #a6e59d; width: 45%"
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="block100 ligne">
					<h2>Mes langages favoris</h2>
					<div class="block25">
						<img src="images/html.jpg" alt="html">
					</div>
					<div class="block25">
						<img src="images/css.jpg" alt="css">
					</div>
					<div class="block25">
						<img src="images/php.jpg" alt="php"></div>
					<div class="block25">
						<img src="images/mysql.jpg" alt="mysql"></div>
				</div>
			</div>
		</section>
		<section id="section2" class="couleur2">
			<div id="link2"></div>
			<div class="conteneur ligne">
				<h2>Réalisations</h2>
				<div class="block33">
				<figure>
				<img src="images/image1.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div>
				<div class="block33">
				<figure>
				<img src="images/image2.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div>
				<div class="block33">
				<figure>
				<img src="images/image3.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div>
				<div class="block33">
				<figure>
				<img src="images/image4.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div><div class="block33">
				<figure>
				<img src="images/image5.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div><div class="block33">
				<figure>
				<img src="images/image6.jpg" alt="réalisation 1">
				<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
				</figcaption>
				</figure>
				</div>
			</div>
		</section>
		<section id="section3" class="couleur3">
			<div id="link3"></div>
			<div class="conteneur ligne">
				<div class="block66">
					<h2>Expériences</h2>
					<table>
						<tr>
							<td class="year" rowspan="2">2010
								<p>2008</p>
							</td>
							<td class="job">Developpeur intégrateur web.</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail dans cette entreprise.</td>
						</tr>
					</table>
					<table>
						<tr>
							<td class="year" rowspan="2">2010
								<p>2008</p>
							</td>
							<td class="job">Developpeur intégrateur web.</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail dans cette entreprise.</td>
						</tr>
					</table>
				</div>
				<div class="block33 couleur1">
					<h2>Formation</h2>
					<table>
						<tr>
							<td class="year" rowspan="2">2017
								<p></p>
							</td>
							<td class="job">Webforce3</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail dans cette entreprise.</td>
						</tr>
					</table>
				</div>
			</div>
		</section>
		<?php
		var_dump($_POST);
		if ($_POST){
			$expediteur   = 'From: '.$_POST['email'];
			$destinataire = 'elie_romain@hotmail.com';
			$sujet        = $_POST['objet'];
			$message      = $_POST['zonedetexte'];

			mail($destinataire,$sujet,$message,$expediteur);
		}
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
						<label for="monemail">Email</label>
						<input type="email" name="email" id="monemail" placeholder="Entrez votre email" required> 
						<label for="monobjet">objet</label>
						<input type="text" name="objet" id="monobjet" placeholder="Votre objet ici"required>
						<label for="mazonedetexte"></label>
						<textarea id="mazonedetexte" name="zonedetexte" placeholder="Votre message ici"required></textarea>
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