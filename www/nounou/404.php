<?php
//header('Status : 404 Not Found');
//header('HTTP/1.0 404 Not Found');
//exit;

$bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
$heure = $_POST['heure'];
$date = $_POST['date'];
$creneau = $heure . ':00 ' . $date;
$insertion = 'INSERT INTO planning (ID, date) VALUES ("test", "' . $creneau .'")';
$bdd->exec($insertion);
?>
<html>
<head>

</head>
<body>
<form method="post">
    <label>Heure début :</label>
    <input type="text" name="heure">:00 //////<label>date DD/MM/AAAA :</label><input type="text" name="date"><br>
    <input type="submit" name="envoi">
</form>
</body>
</html>
