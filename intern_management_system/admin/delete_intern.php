<?php
include("../config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM intern WHERE id='$id'");
}

header("Location: view_intern.php");
exit();
?>