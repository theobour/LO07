<meta charset="utf-8">
<link rel="stylesheet" href="../css/bootstrap.css">
<?php
	echo '	<div class="container" style="margin-top: 20px;font-size: 20px;">
		<div class="alert alert-success">
			Nous allons tenter de vous r&eacute;pondre dans les plus bref d&eacute;lais. <br><br> Vous allez &ecirc;tre redirig&eacute; vers la page d\'accueil dans 15 secondes ou <a href="../index">cliquez ici</a> pour le faire plus rapidement.
		</div>
	</div>';
	header("refresh:15;url=../index");

?>