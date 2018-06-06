<html>
<head>
<title>Example of a weekly schedule</title>
<?
//I don't know the author of the Monthcalendar, but ...  Thanks for the Code !! you can find it in http://foros.cristalab.com/formato-de-fecha-en-calendario-t76780
$anoInicial = '1900';
$anoFinal = '2100';
$funcionTratarFecha = 'document.location = "?dia="+dia+"&mes="+mes+"&ano="+ano;';



?>

    <script>
function tratarFecha(dia,mes,ano){
  <?=$funcionTratarFecha?>
}
</script>

<style>
.m1 {
   font-family:MS Sans Serif;
   font-size:8pt
}
a {
   text-decoration:none;
   color:#000000;
}

td {
font-size:0.6em;
}
</style>

</head>

<body>
<?php

//include the WeeklyCalClass and create the object !!
include ("calendarweek.php");

if ($_GET["jour"] && $_GET["mois"] && $_GET["annee"]) {
$dia = $_GET["jour"];
$mes = $_GET["mois"];
$ano = $_GET["annee"];
    $calendar = new EasyWeeklyCalClass ($dia, $mes, $ano);
    echo $calendar->showCalendar ();
} else {
$dia = date ("d");
$mes = date ("n");
$ano = date ("Y");
    $calendar = new EasyWeeklyCalClass ($dia, $mes, $ano);
    echo $calendar->showCalendar ();
}


?>

</body>
</html>