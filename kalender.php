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
    echo "<p>År</p>";
    echo "<input type='text' name='ar'>";
    echo "<p>Månad</p>";
    echo "<input type='text' name='manad'>";
    echo "<p>Dag</p>";
    echo "<input type='text' name='dag'>";
    echo "<input type='submit'>";
    echo "</form>";
}