<?php

$string_datum = date('y') . "-" . date('m') . "-01";
$date_datum = strtotime($string_datum);
echo date('t', $date_datum);
