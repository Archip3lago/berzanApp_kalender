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
    echo "<p>Tid (tt:mm)</p>";
    echo "<input type='number' name='timme'> : <input type='number' name='minut'>";
    echo "<p>Användare</p>";
    echo "<input type='text' name='användare'>";
    echo "<input type='hidden' name='action' value='ny_aktivitet'>";
    echo "<input type='submit'>";
    echo "</form>";
}

if(isset($_GET["action"]) and $_GET["action"] == "ny_aktivitet"){
    
    echo $tmp_titel = filter_input(INPUT_GET, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_info = filter_input(INPUT_GET, 'info', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_plats = filter_input(INPUT_GET, 'plats', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_year = filter_input(INPUT_GET, 'ar', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_month = filter_input(INPUT_GET, 'manad', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_day = filter_input(INPUT_GET, 'dag', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_timme = filter_input(INPUT_GET, 'timme', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_minut = filter_input(INPUT_GET, 'minut', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $tmp_anv = filter_input(INPUT_GET, 'användare', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $datum = $tmp_year . "-" . $tmp_month . "-" . $tmp_day . " " . $tmp_timme . ":" . $tmp_minut . ":00";
    
//    $sql = "INSERT INTO aktiviteter(titel, inlägg, datum, tid, person, plats) VALUES (:titel, :info, :datum, :tid, :person, :plats)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":titel", $tmp_titel);
    $stmt->bindParam(":info", $tmp_info);
    $stmt->bindParam(":datum", $tmp_datum);
    $stmt->bindParam(":tid", $tmp_tid);
    $stmt->bindParam(":person", $tmp_anv);
    $stmt->bindParam(":plats", $tmp_plats);
    $stmt->execute();
    echo $sql . "<br>";
    
    
}