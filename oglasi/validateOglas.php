<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connect error: " . $connection->connect_error);
}

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["logo_firme"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["logo_firme"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["logo_firme"]["size"] > 500000) {
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
) {
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    setcookie("uploadSlike", true);
    header("Location: index.php");
    $connection->close();
} else {
    move_uploaded_file($_FILES["logo_firme"]["tmp_name"], $target_file);
}


$id = $_SESSION["loggedInUser"]["ID"];
$naziv = $_POST["naziv_firme"];
$logo = $_FILES["logo_firme"]["name"];
$sjediste = $_POST["sjediste_firme"];
$id_kat = $_POST["listaKategorija"];
$op_posla = $_POST["opis_posla"];



$dt1 = new DateTime();
$datum_obj = $dt1->format("Y-m-d");

$dt2 = new DateTime("+1 month");
$datum_ist = $dt2->format("Y-m-d");

$sql = "INSERT INTO `svioglasi`(`id_poslodavca`, `id_oglasa`,`naziv_firme`, `logo_firme`, `sjediste_firme`, `kategorija_id`,`opis_posla`, `datum_objavljivanja`, `datum_isteka`) VALUES ('$id','','$naziv','$logo','$sjediste','$id_kat','$op_posla','$datum_obj','$datum_ist')";
$result = $connection->query($sql);
setcookie("dodatOglas", true);
header("Location: index.php");

$connection->close();
