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


echo "<div id='wrapper'>";
for($i = 1; $i <= 31; $i++){
    echo "<div class='dag' id='nummer_". $i ."'>";
    echo "<p>" . $i . "</p>";
    echo "<form method='GET'>";
    echo "<input type='submit' name='laggTill_aktivitet' value='Ny Aktivitet'>";
    echo "<input type='hidden' name='id' value='". $i ."'>";
    echo "</form></div>";
}
echo "</div>";

if(isset($_GET["laggTill_aktivitet"])){
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

if(isset($_GET["action"]) and $_GET["action"] == "ny_aktivitet"){
    
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
    
    $sql = "INSERT INTO aktiviteter(titel, inlägg, plats, person, daatum, tid) VALUES (:titel, :info, :plats, :person, :daatum, :tid)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":titel", $tmp_titel);
    $stmt->bindParam(":info", $tmp_info);
    $stmt->bindParam(":daatum", $datum);
    $stmt->bindParam(":tid", $tid_slut);
    $stmt->bindParam(":person", $tmp_anv);
    $stmt->bindParam(":plats", $tmp_plats);
    $stmt->execute(); 
}