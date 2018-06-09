<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'nounou' && $_POST['envoi'] !== '') {
    ///////
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        /* calendar */
        table.calendar		{ border-left:1px solid #999; }
        tr.calendar-row	{  }
        td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
        td.calendar-day:hover	{ background:#eceff5; }
        td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
        td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
        div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
        /* shared */
        td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
    </style>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<a id="btn-logout" class="btn btn-danger" href="../generique-file/deconnexion.php">Déco</a>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post" action="../generique-file/ajout-horaire.php">
                <div class="row">
                    <div class="col-8">
                        <label>Date de départ : (ex : 8/6/2018)</label>
                        <input type="text" name="date" class="form-control">
                    </div>
                    <div class="col-8">
                        <label>Heure : (ex: 11:00)</label>
                        <input type="text" name="heure" class="form-control">
                    </div>
                    <div class="col-8">
                        <input type="submit" name="envoi" class="btn btn-primary" value="Envoyer">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <span id="calendrier1"></span>
        </div>
    </div>
</div>


<script>
    function test () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("calendrier2").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "creation-planning.php?year=2018&month=5&type=week", true);
        xhttp.send();
    }
    addEventListener('load', function () {
        let today = new Date();
        let month = today.getMonth() + 1;
        let year = today.getFullYear();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("calendrier1").innerHTML = this.responseText;
            }
        };
        console.log(month);
        console.log(year);
        console.log(today);
        xhttp.open("GET", "creation-planning-semaine.php", true);
        xhttp.send();
    });
</script>
</body>
</html>