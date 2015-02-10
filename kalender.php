<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "berzanapp");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

include 'data.php';



$m = date('M');
$y = date('Y');
$string_datum = $y . "-" . date('m') . "-01";

if(isset($_GET["kalender_byt"])) {
    $m = $_GET["månad_kalender"];
    $y = $_GET["år_kalender"];
    $string_datum = $_GET['år_kalender'] . "-" . $_GET['månad_kalender'] . "-01";
}

$date_datum = strtotime($string_datum);

$form_html = "";
if (isset($_GET["laggTill_aktivitet"])) {
    $form_html .= "<div id='form_aktivitet'>";
    $form_html .= "<form method='GET'>";
    $form_html .= "<p>Titel</p>";
    $form_html .= "<input type='text' name='titel' required>";
    $form_html .= "<p>Inlägg</p>";
    $form_html .= "<input id='ruta' type='text' name='info' required>";
    $form_html .= "<p>Plats</p>";
    $form_html .= "<input type='text' name='plats' required>";
    $form_html .= "<p>Datum (åååå-mm-dd)</p>";
    $form_html .= "<select name='ar'>";
    $form_html .= "<option value='2015'>2015</option>";
    $form_html .= "<option value='2016'>2016</option>";
    $form_html .= "<option value='2017'>2017</option>";
    $form_html .= "<option value='2018'>2018</option>";
    $form_html .= "<option value='2019'>2019</option>";
    $form_html .= "<option value='2020'>2020</option>";
    $form_html .= "</select> - ";
    $form_html .= "<select name='manad'>";
    $form_html .= "<option value='01'>Januari</option>";
    $form_html .= "<option value='02'>Februari</option>";
    $form_html .= "<option value='03'>Mars</option>";
    $form_html .= "<option value='04'>April</option>";
    $form_html .= "<option value='05'>Maj</option>";
    $form_html .= "<option value='06'>Juni</option>";
    $form_html .= "<option value='07'>Juli</option>";
    $form_html .= "<option value='08'>Augusti</option>";
    $form_html .= "<option value='09'>September</option>";
    $form_html .= "<option value='10'>Oktober</option>";
    $form_html .= "<option value='11'>November</option>";
    $form_html .= "<option value='12'>December</option>";
    $form_html .= "</select> - ";
    $form_html .= "<select name='dag'>";
    for ($i = 1; $i < 32; $i++) {
        if (strlen($i) == 1) {
            $i = 0 . $i;
        }
        $form_html .= "<option value='$i'>$i</option>";
    }
    $form_html .= "</select>";
    $form_html .= "<p>Starttid(tt:mm)</p>";
    $form_html .= "<select name='timme_start'>";
    for ($i = 0; $i < 24; $i++) {
        if (strlen($i) == 1) {
            $i = 0 . $i;
        }
        $form_html .= "<option value='$i'>$i</option>";
    }
    $form_html .= "</select>:";
    $form_html .= "<select name='minut_start' required>";
    for ($n = 0; $n < 60; $n++) {
        if (strlen($n) == 1) {
            $n = 0 . $n;
        }
        $form_html .= "<option value='$n'>$n</option>";
    }
    $form_html .= "</select>";
    $form_html .= "<p>Sluttid (tt:mm)</p>";
    $form_html .= "<select name='timme_slut'>";
    for ($i = 0; $i < 24; $i++) {
        if (strlen($i) == 1) {
            $i = 0 . $i;
        }
        $form_html .= "<option value='$i'>$i</option>";
    }
    $form_html .= "</select>:";
    $form_html .= "<select name='minut_slut' required>";
    for ($n = 0; $n < 60; $n++) {
        if (strlen($n) == 1) {
            $n = 0 . $n;
        }
        $form_html .= "<option value='$n'>$n</option>";
    }
    $form_html .= "</select>";
    $form_html .= "<p>Användare</p>";
    $form_html .= "<input type='text' name='användare' required>";
    $form_html .= "<input type='hidden' name='action' value='ny_aktivitet'>";
    $form_html .= "<input type='submit'>";
    $form_html .= "</form>";
    $form_html .= "</div>";
}

if (isset($_GET["action"]) and $_GET["action"] == "ny_aktivitet") {

    $tmp_titel = filter_input(INPUT_GET, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_info = filter_input(INPUT_GET, 'info', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_plats = filter_input(INPUT_GET, 'plats', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_year = filter_input(INPUT_GET, 'ar', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_month = filter_input(INPUT_GET, 'manad', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_day = filter_input(INPUT_GET, 'dag', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_timme = filter_input(INPUT_GET, 'timme_start', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_minut = filter_input(INPUT_GET, 'minut_start', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_anv = filter_input(INPUT_GET, 'användare', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_timmeslut = filter_input(INPUT_GET, 'timme_slut', FILTER_SANITIZE_SPECIAL_CHARS);
    $tmp_minutslut = filter_input(INPUT_GET, 'minut_slut', FILTER_SANITIZE_SPECIAL_CHARS);
    $tid_slut = $tmp_timmeslut . $tmp_minutslut;
    $datum = $tmp_year . "-" . $tmp_month . "-" . $tmp_day . " " . $tmp_timme . ":" . $tmp_minut . ":00";

    $sql = "INSERT INTO aktiviteter(titel, inlägg, plats, person, datum, tid) VALUES (:titel, :info, :plats, :person, :datum, :tid)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":titel", $tmp_titel);
    $stmt->bindParam(":info", $tmp_info);
    $stmt->bindParam(":datum", $datum);
    $stmt->bindParam(":tid", $tid_slut);
    $stmt->bindParam(":person", $tmp_anv);
    $stmt->bindParam(":plats", $tmp_plats);
    $stmt->execute();
    header("Location:?");
    exit();
}

function skriv_ut_dagar($year, $month, $displacement, $date) {
    echo "<h1>" . $month . "</h1>";
    echo "<div class='dagnamn'>";
    echo "<h3>Måndag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Tisdag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Onsdag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Torsdag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Fredag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Lördag</h3>";
    echo "</div>";
    echo "<div class='dagnamn'>";
    echo "<h3>Söndag</h3>";
    echo "</div>";
    for ($i = 1; $i <= $displacement; $i++) {
        echo "<div class='stay_hidden dag'>";
        echo "<p>Detta syns inte</p>";
        echo "</div>";
    }


    $antal = date('t', $date);
    for ($i = 1; $i <= $antal; $i++) {
        echo "<div class='dag'>";
        echo "<p>" . $i . "</p>";
        letaAktivitet($year, $month, $i);
        echo "<form method  ='GET'>";
        echo "<input type='hidden' name='laggTill_aktivitet'>";
        echo "<input type='hidden' name='date' value='dag_" . $i . "'>";
        echo "<input type='submit' value='Ny aktivitet'>";
        echo "</div>";
    }
}

function letaAktivitet($year, $month, $day) {
    $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
    if (strlen($day) == 1) {
        $day = 0 . $day;
    }
    $datum = $year . "-" . $month . "-" . $day;
    $sql = "SELECT * FROM aktiviteter WHERE datum LIKE '" . $datum . "%'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $aktiviteter = $stmt->fetchAll();
    foreach ($aktiviteter as $aktivitet) {
        echo "<a href='aktivitet.php?aktivitets_id=" . $aktivitet["id"] . "'>" . $aktivitet["titel"] . "</a><br>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>stuff shizzle</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="enklare.css">
    </head>
    <body>
        <div id='wrapper'>
            <form method="GET">
                <select name="år_kalender">
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
                <select name="månad_kalender">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Mars</option>
                    <option value="04">April</option>
                    <option value="05">Maj</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Augusti</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <input type='submit' name='kalender_byt' value='kör'>
            </form>
            <?php
            skriv_ut_dagar($y, $m, $data[$y][$m], $date_datum);
            echo $form_html;
            ?>
        </div>
    </body>
</html>