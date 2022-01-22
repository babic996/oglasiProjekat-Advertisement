<?php
setcookie("logoutSuccessful", true);
session_start();
session_destroy();
header("Location: index.php");
