<html>
    <head>
        <title>stuff shizzle</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="enklare.css">
    </head>
    <body>

    </body>
</html>
<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "berzanapp");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

include 'data.php';

echo "<div id='wrapper'>";

$m = date('M');
$y = date('Y');

skriv_ut_dagar($y, $m, $data[$y][$m]);


echo "</div>";

if (isset($_GET["laggTill_aktivitet"])) {
    echo "<form method='GET'>";
    echo "<p>Titel</p>";
    echo "<input type='text' name='titel'>";
    echo "<p>Inlägg</p>";
    echo "<input type='text' name='info'>";
    echo "<p>Plats</p>";
    echo "<input type='text' name='plats'>";
    echo "<p>Datum (åååå-mm-dd)</p>";
    echo "<input type='number' name='ar'> - <input type='number' name='manad'> - <input type='number' name='dag'>";
    echo "<p>Starttid(tt:mm)</p>";
    echo "<input type='number' name='timme_start'> : <input type='number' name='minut_start'>";
    echo "<p>Sluttid (tt:mm)</p>";
    echo "<input type='number' name='timme_slut'> : <input type='number' name='minut_slut'>";
    echo "<p>Användare</p>";
    echo "<input type='text' name='användare'>";
    echo "<input type='hidden' name='action' value='ny_aktivitet'>";
    echo "<input type='submit'>";
    echo "</form>";
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
}

function skriv_ut_dagar($year, $month, $displacement) {
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



    $length = date('t');
    for ($i = 1; $i <= $length; $i++) {
        $m = date('m');
        echo "<div class='dag'>";
        echo "<p>" . $i . "</p>";
        letaAktivitet($year, $m, $i);
        echo "<form method='GET'>";
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
        echo "<a href=''>" . $aktivitet["titel"] . "</a>";
    }
}
