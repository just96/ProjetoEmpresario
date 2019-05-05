<?php
session_start();

if (!isset($_SESSION['Utilizador']) && !isset($_SESSION['id']) ){
  header( "Location:log.php" );
}

if ($_SESSION['role'] == 'admin'){
  header( "Location:../admin/calendar.php" );
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Calendário google-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Calendario">
  <meta name="author" content="Tiago Moura">

  <title>Calendário Google</title>


</head>

<body>
  <?php require('topfooterU.php');?>
  <div class="container" style="
  margin-top: 30px;">
  <iframe src="https://calendar.google.com/calendar/embed?title=Calend%C3%A1rio&amp;height=768&amp;wkst=1&amp;hl=pt_PT&amp;bgcolor=%23336666&amp;src=paulo.moura%40manzonivasconcelos.com&amp;color=%231B887A&amp;src=%23contacts%40group.v.calendar.google.com&amp;color=%2329527A&amp;src=pt.portuguese%23holiday%40group.v.calendar.google.com&amp;color=%230F4B38&amp;ctz=Europe%2FLisbon" style="border-width:0" width="1024" height="768" frameborder="0" scrolling="yes"></iframe>
</div>

</body>

</html>