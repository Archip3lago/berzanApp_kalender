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

$data[2015]  = array("jan"=>3,"feb"=>6,"mar"=>6, "apr"=>2, "maj"=>4,"jun"=>0,"jul"=>2,"aug"=>5,"sep"=>1,"okt"=>3,"nov"=>6,"dec"=>1);
$data[2016]  = array("jan"=>4,"feb"=>0,"mar"=>1, "apr"=>4, "maj"=>6,"jun"=>2,"jul"=>4,"aug"=>0,"sep"=>3,"okt"=>5,"nov"=>1,"dec"=>3);
$data[2017]  = array("jan"=>6,"feb"=>2,"mar"=>2, "apr"=>5, "maj"=>0,"jun"=>3,"jul"=>5,"aug"=>1,"sep"=>4,"okt"=>6,"nov"=>2,"dec"=>4);
$data[2018]  = array("jan"=>0,"feb"=>3,"mar"=>3, "apr"=>6, "maj"=>1,"jun"=>4,"jul"=>6,"aug"=>2,"sep"=>5,"okt"=>0,"nov"=>3,"dec"=>5);
$data[2019]  = array("jan"=>1,"feb"=>4,"mar"=>4, "apr"=>0, "maj"=>2,"jun"=>5,"jul"=>0,"aug"=>3,"sep"=>6,"okt"=>1,"nov"=>4,"dec"=>6);
$data[2020]  = array("jan"=>2,"feb"=>5,"mar"=>6, "apr"=>2, "maj"=>4,"jun"=>0,"jul"=>2,"aug"=>5,"sep"=>1,"okt"=>3,"nov"=>6,"dec"=>1);

$data[2015]["skottar"] = false;
$data[2016]["skottar"] = true;
$data[2017]["skottar"] = false;
$data[2018]["skottar"] = false;
$data[2019]["skottar"] = false;
$data[2020]["skottar"] = true;

$jan_length = 31;
$feb_length = 28;
$feb_length_skott = 29;
$mar_length = 31;
$apr_length = 30;
$maj_length = 31;
$jun_length = 30;
$jul_length = 31;
$aug_length = 31;
$sep_length = 30;
$okt_length = 31;
$nov_length = 30;
$dec_length = 31;


echo date('n');
?>