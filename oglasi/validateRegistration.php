<?php
$connection = mysqli_connect("localhost", "root", "", "oglasi");
$message = "Niste unijeli isti password!";
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}
$name = $_POST["ime"];
$lastname = $_POST["prezime"];
$mail = $_POST["email"];
$phone = $_POST["telefon"];
$pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql1 = "SELECT email FROM users WHERE email='{$mail}'";
$result1 = $connection->query($sql1);
if (!empty($result1->num_rows) && $result1->num_rows > 0) {
    setcookie("sameEmail", true);
    header("Location: registration.php");
} else {
    if ($_POST["password"] == $_POST["pon_password"]) {
        $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `telefon`, `password`) VALUES ('$name','$lastname','$mail','$phone','$pass')";
        $result = $connection->query($sql);
        $connection->close();
        setcookie("successfullReg", true);
        header("Location: index.php");
    } else {
        setcookie("wrongPassword", true);
        header("Location: registration.php");
    }
}
