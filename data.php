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

$data[2015]  = array("01"=>3,"02"=>6,"03"=>6, "04"=>2, "05"=>4,"06"=>0,"07"=>2,"08"=>5,"09"=>1,"10"=>3,"11"=>6,"12"=>1);
$data[2016]  = array("01"=>4,"02"=>0,"03"=>1, "04"=>4, "05"=>6,"06"=>2,"07"=>4,"08"=>0,"09"=>3,"10"=>5,"11"=>1,"12"=>3);
$data[2017]  = array("01"=>6,"02"=>2,"03"=>2, "04"=>5, "05"=>0,"06"=>3,"07"=>5,"08"=>1,"09"=>4,"10"=>6,"11"=>2,"12"=>4);
$data[2018]  = array("01"=>0,"02"=>3,"03"=>3, "04"=>6, "05"=>1,"06"=>4,"07"=>6,"08"=>2,"09"=>5,"10"=>0,"11"=>3,"12"=>5);
$data[2019]  = array("01"=>1,"02"=>4,"03"=>4, "04"=>0, "05"=>2,"06"=>5,"07"=>0,"08"=>3,"09"=>6,"10"=>1,"11"=>4,"12"=>6);
$data[2020]  = array("01"=>2,"02"=>5,"03"=>6, "04"=>2, "05"=>4,"06"=>0,"07"=>2,"08"=>5,"09"=>1,"10"=>3,"11"=>6,"12"=>1);

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