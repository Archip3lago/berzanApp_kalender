<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "berzanapp");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

if(isset($_GET["aktivitets_id"])){
    $sql = "SELECT * FROM aktiviteter WHERE id=".$_GET["aktivitets_id"]."";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $aktiviteter = $stmt->fetchAll();
    
    echo "<h1>" . $aktiviteter[0]["titel"] . "</h1>" . '<br>';
    echo "<h3>Information:</h3>"; 
    echo "<p>" . $aktiviteter[0]["inlägg"] . "</p>" . '<br>';
    echo "<h3>Plats:</h3>";
    echo $aktiviteter[0]["plats"] . '<br>';
    echo "<h3>Tid:</h3>";
    echo substr($aktiviteter[0]["datum"], 11, 5) . "-";
    echo substr($aktiviteter[0]["tid"], 0, 2) . ":" . substr($aktiviteter[0]["tid"], 2, 2) . "<br><br>";
    echo "Skapad av " . $aktiviteter[0]["person"];
}


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
