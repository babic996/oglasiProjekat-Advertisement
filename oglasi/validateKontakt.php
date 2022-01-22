<?php

session_start();
$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}

$ime = $_GET["ime_kontakta"];
$mail = $_GET["email_kontakta"];
$mess = $_GET["poruka_kontakta"];
if (!empty($_SESSION["loggedInUser"])) {
    $id = $_SESSION["loggedInUser"]["ID"];
}

if (!empty($_SESSION["loggedInUser"])) {
    $sql1 = "INSERT INTO `kontakt`(`id_kontakta`, `id_korisnika`, `ime_kontakta`, `email_kontakta`, `poruka`) VALUES ('','$id','$ime','$mail','$mess')";
    $result1 = $connection->query($sql1);
    $connection->close();
    setcookie("poslataPoruka", true);
    header("Location: index.php");
} else {
    $sql2 = "INSERT INTO `kontakt`(`id_kontakta`, `id_korisnika`, `ime_kontakta`, `email_kontakta`, `poruka`) VALUES ('','','$ime','$mail','$mess')";
    $result2 = $connection->query($sql2);
    $connection->close();
    setcookie("poslataPoruka", true);
    header("Location: index.php");
}
