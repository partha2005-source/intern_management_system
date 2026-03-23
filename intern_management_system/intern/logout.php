<?php
session_start();
session_destroy();
header("Location: intern_login.php");
exit();
?>