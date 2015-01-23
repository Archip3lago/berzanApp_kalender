<?php
echo "hello";

function getDays($y, $m){
    if( $y==2015){
        switch ($m){
            case 0: //jan
                return 3; // torsdag
            case 1: //jan
                return 2; // torsdag
            case 2: //jan
                return 1; // torsdag
            case 3: //jan
                return 6; // torsdag
            case 4: //jan
                return 5; // torsdag
        }
    }  
}
$JAN=0;
/*
echo "Januari startar dag " . getDays(2015, 0);

$data[2015]=array(3,2,5,4,1,1,1,1,1,1); 
$data[2016]=array(3,2,5,4); 
$data[2017]=array(3,2,5,4); 

echo "Januari startar dag " . $data[2015][];
echo "Februari startar dag " . $data[2015][1];
echo "Mars  startar dag " . $data[2015][2];
*/
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
echo dag(4);
echo "<br>";

$data[2015]  = array("jan"=>3,"feb"=>6,"mar"=>6, "apr"=>2, "maj"=>4,"jun"=>0,"jul"=>2,"aug"=>5,"sep"=>1,"okt"=>3,"nov"=>6,"dec"=>1);
$data[2016]  = array("jan"=>4,"feb"=>0,"mar"=>1, "apr"=>4, "maj"=>6,"jun"=>2,"jul"=>4,"aug"=>0,"sep"=>3,"okt"=>5,"nov"=>1,"dec"=>3);
$data[2017]  = array("jan"=>6,"feb"=>2,"mar"=>2, "apr"=>5, "maj"=>0,"jun"=>3,"jul"=>5,"aug"=>1,"sep"=>4,"okt"=>6,"nov"=>2,"dec"=>4);
$data[2018]  = array("jan"=>0,"feb"=>3,"mar"=>3, "apr"=>6, "maj"=>1,"jun"=>4,"jul"=>6,"aug"=>2,"sep"=>5,"okt"=>0,"nov"=>3,"dec"=>5);
$data[2019]  = array("jan"=>1,"feb"=>4,"mar"=>4, "apr"=>0, "maj"=>2,"jun"=>5,"jul"=>0,"aug"=>3,"sep"=>6,"okt"=>1,"nov"=>4,"dec"=>6);
$data[2020]  = array("jan"=>2,"feb"=>5,"mar"=>6, "apr"=>2, "maj"=>4,"jun"=>0,"jul"=>2,"aug"=>5,"sep"=>1,"okt"=>3,"nov"=>6,"dec"=>1);
$data[2015]["skottår"] = false;
$data[2016]["skottår"] = true;
$data[2017]["skottår"] = false;
$data[2018]["skottår"] = false;
$data[2019]["skottår"] = false;
$data[2020]["skottår"] = true;

echo "Januari startar dag " . $data[2015]["jan"];
echo "Februari startar dag " . $data[2015]["feb"];
echo "Mars  startar dag " . $data[2015]["mar"];


?>