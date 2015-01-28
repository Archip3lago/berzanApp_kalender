<?php
function dag($d){
    switch($d){
        case 0:
            return "Måndag";
        case 1:
            return "Tisdag";
        case 2:
            return "Onsdag";
        case 3:
            return "Torsdag";
        case 4:
            return "Fredag";
        case 5:
            return "Lördag";
        case 6:
            return "Söndag";
    }
}

$data[2015]  = array("Jan"=>3,"Feb"=>6,"Mar"=>6, "Apr"=>2, "May"=>4,"Jun"=>0,"Jul"=>2,"Aug"=>5,"Sep"=>1,"Oct"=>3,"Nov"=>6,"Dec"=>1);
$data[2016]  = array("Jan"=>4,"Feb"=>0,"Mar"=>1, "Apr"=>4, "May"=>6,"Jun"=>2,"Jul"=>4,"Aug"=>0,"Sep"=>3,"Oct"=>5,"Nov"=>1,"Dec"=>3);
$data[2017]  = array("Jan"=>6,"Feb"=>2,"Mar"=>2, "Apr"=>5, "May"=>0,"Jun"=>3,"Jul"=>5,"Aug"=>1,"Sep"=>4,"Oct"=>6,"Nov"=>2,"Dec"=>4);
$data[2018]  = array("Jan"=>0,"Feb"=>3,"Mar"=>3, "Apr"=>6, "May"=>1,"Jun"=>4,"Jul"=>6,"Aug"=>2,"Sep"=>5,"Oct"=>0,"Nov"=>3,"Dec"=>5);
$data[2019]  = array("Jan"=>1,"Feb"=>4,"Mar"=>4, "Apr"=>0, "May"=>2,"Jun"=>5,"Jul"=>0,"Aug"=>3,"Sep"=>6,"Oct"=>1,"Nov"=>4,"Dec"=>6);
$data[2020]  = array("Jan"=>2,"Feb"=>5,"Mar"=>6, "Apr"=>2, "May"=>4,"Jun"=>0,"Jul"=>2,"Aug"=>5,"Sep"=>1,"Oct"=>3,"Nov"=>6,"Dec"=>1);

$data[2015]["skottar"] = false;
$data[2016]["skottar"] = true;
$data[2017]["skottar"] = false;
$data[2018]["skottar"] = false;
$data[2019]["skottar"] = false;
$data[2020]["skottar"] = true;

$Jan_length = 31;
$Feb_length = 28;
$Feb_length_skott = 29;
$Mar_length = 31;
$Apr_length = 30;
$May_length = 31;
$Jun_length = 30;
$Jul_length = 31;
$Aug_length = 31;
$Sep_length = 30;
$Oct_length = 31;
$Nov_length = 30;
$Dec_length = 31;


?>