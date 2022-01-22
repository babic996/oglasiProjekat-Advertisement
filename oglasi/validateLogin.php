<?php
$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connect error: " . $connection->connect_error);
}

$email = $_POST["email"];
$pass = $_POST["password"];

$sql = "SELECT * from users WHERE email='$email'";
$result = $connection->query($sql);

if (!empty($result->num_rows) && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row["password"])) {
        session_start();
        $_SESSION["loggedInUser"] = $row;
        header("Location: index.php");
    } else {
        setcookie("loginFailed", true);
        header("Location: index.php");
    }
}

$connection->close();
