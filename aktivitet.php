<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "berzanapp");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

$aktivitet = "";

if (isset($_GET["aktivitets_id"])) {
    $sql = "SELECT * FROM aktiviteter WHERE id=" . $_GET["aktivitets_id"] . "";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $aktiviteter = $stmt->fetchAll();



    $aktivitet .= "<h1>" . $aktiviteter[0]["titel"] . "</h1>" . '<br>';
    $aktivitet .= "<h3>Information:</h3>";
    $aktivitet .= "<p>" . $aktiviteter[0]["inlägg"] . "</p>" . '<br>';
    $aktivitet .= "<h3>Plats:</h3>";
    $aktivitet .= $aktiviteter[0]["plats"] . '<br>';
    $aktivitet .= "<h3>Tid:</h3>";
    $aktivitet .= substr($aktiviteter[0]["datum"], 11, 5) . "-";
    $aktivitet .= substr($aktiviteter[0]["tid"], 0, 2) . ":" . substr($aktiviteter[0]["tid"], 2, 2) . "<br><br>";
    $aktivitet .= "Skapad av " . $aktiviteter[0]["person"];
    $aktivitet .= "<form method='GET'>";
    $aktivitet .= "<input type='hidden' name='id' value='" . $_GET["aktivitets_id"] . "'>";
    $aktivitet .= "<input type='submit' name='delete' value='Ta bort'>";
    $aktivitet .= "</form>";
    $aktivitet .= "<form method='GET'>";
    $aktivitet .= "<input type='hidden' name='id' value='" . $_GET["aktivitets_id"] . "'>";
    $aktivitet .= "<input type='submit' name='edit' value='redigera'>";
    $aktivitet .= "</form>";
}

if (isset($_GET["delete"])) {
    $sql = "DELETE FROM `aktiviteter` WHERE id='" . $_GET["id"] . "'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    header("Location:kalender.php");
    exit();
}
if (isset($_GET["edit"])) {
    $sql = "SELECT * FROM aktiviteter WHERE id='" . $_GET["id"] . "'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $aktiviteter = $stmt->fetchAll();

    echo "<form method='GET'>";
    echo '<p>Titel</p>';
    echo "<input type='text' name='titel' value='" . $aktiviteter[0]["titel"] . "'>";
    echo '<br>';
    echo '<p>Inlägg</p>';
    echo "<input type='text' name='inlägg' value='" . $aktiviteter[0]["inlägg"] . "'>";
    echo '<br>';
    echo '<p>Plats</p>';
    echo "<input type='text' name='plats' value='" . $aktiviteter[0]["plats"] . "'>";
    echo '<br>';
    echo '<p>Datum</p>';
    echo "<select name='år'>";
    echo "<option value='2015'>2015</option>";
    echo "<option value='2016'>2016</option>";
    echo "<option value='2017'>2017</option>";
    echo "<option value='2018'>2018</option>";
    echo "<option value='2019'>2019</option>";
    echo "<option value='2020'>2020</option>";
    echo "</select>";
    echo "<select name='månad'>";
    echo "<option value='01'>Januari</option>";
    echo "<option value='02'>Februari</option>";
    echo "<option value='03'>Mars</option>";
    echo "<option value='04'>April</option>";
    echo "<option value='05'>Maj</option>";
    echo "<option value='06'>Juni</option>";
    echo "<option value='07'>Juli</option>";
    echo "<option value='08'>Augusti</option>";
    echo "<option value='09'>September</option>";
    echo "<option value='10'>Oktober</option>";
    echo "<option value='11'>November</option>";
    echo "<option value='12'>December</option>";
    echo "</select>";
    echo "<select name='dag'>";
    for ($i = 1; $i < 32; $i++) {
        if (strlen($i) == 1) {
            $i = 0 . $i;
        }
        echo "<option value='$i'>$i</option>";
    }
    echo "</select>";
    echo '<br>';
    echo '<p>Start-tid (tt:mm)</p>';
    echo "<input type='number' name='timmestart' value='" . substr($aktiviteter[0]["datum"], 11, 2) . "'>";
    echo ':';
    echo "<input type='number' name='minutstart' value='" . substr($aktiviteter[0]["datum"], 14, 2) . "'>";
    echo '<br>';
    echo '<p>Slut-tid (tt:mm)</p>';
    echo "<input type='number' name='timmeslut' value='" . substr($aktiviteter[0]["tid"], 0, 2) . "'>";
    echo ':';
    echo "<input type='number' name='minutslut' value='" . substr($aktiviteter[0]["tid"], 2, 2) . "'>";
    echo "<input type='hidden' name='id' value='" . $_GET["id"] . "'>";
    echo "<input type='submit' name='Redigera_post' value='Kör'>";
    echo "</form>";
}

if (isset($_GET['Redigera_post'])) {
    $tmp_titel = filter_input(INPUT_GET, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_info = filter_input(INPUT_GET, 'inlägg', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_plats = filter_input(INPUT_GET, 'plats', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_year = filter_input(INPUT_GET, 'år', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_month = filter_input(INPUT_GET, 'månad', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_day = filter_input(INPUT_GET, 'dag', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_timme = filter_input(INPUT_GET, 'timmestart', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_minut = filter_input(INPUT_GET, 'minutstart', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_anv = filter_input(INPUT_GET, 'användare', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_timmeslut = filter_input(INPUT_GET, 'timmeslut', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_minutslut = filter_input(INPUT_GET, 'minutslut', FILTER_SANITIZE_SPECIAL_CHARS);
    $tid_slut = $tmp_timmeslut . $tmp_minutslut;
    $datum = $tmp_year . "-" . $tmp_month . "-" . $tmp_day . " " . $tmp_timme . ":" . $tmp_minut . ":00";


    $sql = "UPDATE aktiviteter SET titel=:titel, inlägg=:info, plats=:plats, datum=:datum, tid=:tid WHERE id=" . $_GET["id"] . "";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":titel", $tmp_titel);
    $stmt->bindParam(":info", $tmp_info);
    $stmt->bindParam(":datum", $datum);
    $stmt->bindParam(":tid", $tid_slut);
    $stmt->bindParam(":plats", $tmp_plats);
    $stmt->execute();
    header("Location:kalender.php");
    exit();
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
        echo $aktivitet;
        ?>
    </body>
</html>
