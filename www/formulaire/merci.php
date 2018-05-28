<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="../css/bootstrap">
<?php


// Base de donnée
require 'connection.php';
$conn    = Connect();

$prenom    = $conn->real_escape_string($_POST['prenom']);
$name    = $conn->real_escape_string($_POST['nom']);
$email   = $conn->real_escape_string($_POST['email']);
$subj    = $conn->real_escape_string($_POST['subj']);
$message = $conn->real_escape_string($_POST['message']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	 die('<div class="container" style="margin-top: 20px;font-size: 20px;">
			<div class="alert alert-danger">
				Votre mail est incorrect.<br> Vous allez &ecirc;tre redirig&eacute; vers le formulaire de contact dans 15 secondes ou <a href="../contact">cliquez ici</a> pour le faire plus rapidement.
			</div>
		</div>'.$conn->error);
	header("refresh:15;url=../contact");
}

$query   = "INSERT into Innovutt (nom,prenom,email,subj,message) VALUES('" . $name . "','" . $prenom . "','" . $email . "','" . $subj . "','" . $message . "')";
$success = $conn->query($query);
 
if (!$success) {
    die('<div class="alert alert-danger">Impossible d\'ouvir la base de donnée</div>'.$conn->error);
 
}
 
$conn->close();
 
//Mail 
$to = "innovutt@utt.fr";
$subject = "Formulaire de contact";
$mes = " Name: " . $name . "\r\n Prenom : " . $prenom . "\r\n Email: " . $email . "\r\n Sujet: " . $subj . "\r\n Message: \r\n " . $message ;
 
$from = "Innovutt";
$headers = "From:" . $from . "\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n"; 
 
if(@mail($to,$subject,$mes,$headers))
{
  header('Location: succes.php');
 
}else{
  header('Location: echec.php');
}
 
 
 

 
?>