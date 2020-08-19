

<?php
$con = @mysqli_connect("9b1qp.myd.infomaniak.com", "9b1qp_martin", "Slamming_12_3");

if (!$con) {
    echo "Error: " . mysqli_connect_error();
    exit();
}
//echo 'Connected to MySQL';
$verbunden=mysqli_select_db($con, "9b1qp_abutesteKlasse");
if($verbunden)
//echo('DB-Verbindung hergestellt! ');
    $dummy=1;
else
    die('DB-Verbindung fehlgeschlagen! ');

?>

<?php
$con1 = @mysqli_connect("9b1qp.myd.infomaniak.com", "9b1qp_heimmart", "t4xray!!ST");

if (!$con1) {
    echo "Error: " . mysqli_connect_error();
    exit();
}
//echo 'Connected to MySQL';
$verbunden=mysqli_select_db($con1, "9b1qp_lernplattform");
if($verbunden)
//echo('DB-Verbindung hergestellt! ');
    $dummy=1;
else
    die('DB-Verbindung fehlgeschlagen! ');

?>





