<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "berzanapp");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

$aktivitet = "";
$redigera_aktivitet = "";

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

    $redigera_aktivitet .= "<form method='GET'>";
    $redigera_aktivitet .= '<p>Titel</p>';
    $redigera_aktivitet .= "<input type='text' name='titel' value='" . $aktiviteter[0]["titel"] . "'>";
    $redigera_aktivitet .= '<br>';
    $redigera_aktivitet .= '<p>Inlägg</p>';
    $redigera_aktivitet .= "<input type='text' name='inlägg' value='" . $aktiviteter[0]["inlägg"] . "'>";
    $redigera_aktivitet .= '<br>';
    $redigera_aktivitet .= '<p>Plats</p>';
    $redigera_aktivitet .= "<input type='text' name='plats' value='" . $aktiviteter[0]["plats"] . "'>";
    $redigera_aktivitet .= '<br>';
    $redigera_aktivitet .= '<p>Datum</p>';
    $redigera_aktivitet .= "<select name='år'>";
    $redigera_aktivitet .= "<option value='2015'>2015</option>";
    $redigera_aktivitet .= "<option value='2016'>2016</option>";
    $redigera_aktivitet .= "<option value='2017'>2017</option>";
    $redigera_aktivitet .= "<option value='2018'>2018</option>";
    $redigera_aktivitet .= "<option value='2019'>2019</option>";
    $redigera_aktivitet .= "<option value='2020'>2020</option>";
    $redigera_aktivitet .= "</select>";
    $redigera_aktivitet .= "<select name='månad'>";
    $redigera_aktivitet .= "<option value='01'>Januari</option>";
    $redigera_aktivitet .= "<option value='02'>Februari</option>";
    $redigera_aktivitet .= "<option value='03'>Mars</option>";
    $redigera_aktivitet .= "<option value='04'>April</option>";
    $redigera_aktivitet .= "<option value='05'>Maj</option>";
    $redigera_aktivitet .= "<option value='06'>Juni</option>";
    $redigera_aktivitet .= "<option value='07'>Juli</option>";
    $redigera_aktivitet .= "<option value='08'>Augusti</option>";
    $redigera_aktivitet .= "<option value='09'>September</option>";
    $redigera_aktivitet .= "<option value='10'>Oktober</option>";
    $redigera_aktivitet .= "<option value='11'>November</option>";
    $redigera_aktivitet .= "<option value='12'>December</option>";
    $redigera_aktivitet .= "</select>";
    $redigera_aktivitet .= "<select name='dag'>";
    for ($i = 1; $i < 32; $i++) {
        if (strlen($i) == 1) {
            $i = 0 . $i;
        }
        $redigera_aktivitet .= "<option value='$i'>$i</option>";
    }
    $redigera_aktivitet .= "</select>";
    $redigera_aktivitet .= '<br>';
    $redigera_aktivitet .= '<p>Start-tid (tt:mm)</p>';
    $redigera_aktivitet .= "<input type='number' name='timmestart' value='" . substr($aktiviteter[0]["datum"], 11, 2) . "'>";
    $redigera_aktivitet .= ':';
    $redigera_aktivitet .= "<input type='number' name='minutstart' value='" . substr($aktiviteter[0]["datum"], 14, 2) . "'>";
    $redigera_aktivitet .= '<br>';
    $redigera_aktivitet .= '<p>Slut-tid (tt:mm)</p>';
    $redigera_aktivitet .= "<input type='number' name='timmeslut' value='" . substr($aktiviteter[0]["tid"], 0, 2) . "'>";
    $redigera_aktivitet .= ':';
    $redigera_aktivitet .= "<input type='number' name='minutslut' value='" . substr($aktiviteter[0]["tid"], 2, 2) . "'>";
    $redigera_aktivitet .= "<input type='hidden' name='id' value='" . $_GET["id"] . "'>";
    $redigera_aktivitet .= "<input type='submit' name='Redigera_post' value='Kör'>";
    $redigera_aktivitet .= "</form>";
}

if (isset($_GET['Redigera_post'])) {
    $m = $_GET["månad"];
    $d = $_GET["dag"];
    
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
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo $aktivitet;
        echo $redigera_aktivitet;
        ?>
    </body>
</html>