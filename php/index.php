<?php Header("Content-Type: text/html; charset=iso-8859-1");?>
<html>
 <head>
  <title>PHP-Test</title>
 </head>
 <body>

 <?php
$pdo = new PDO('mysql:host=db;dbname=firmendb;charset=latin1', 'springuser', 'ThePassword');

$stmt = $pdo->prepare("SELECT name FROM company LIMIT 50");
$stmt->execute();

$test = $stmt->fetchAll();

var_dump($test);

 echo '<p>Hallo Welt mit dbsdfsdf</p>'; ?>
 </body>
</html>