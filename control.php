<?php
include 'config.php';
$id = $_GET['id'];
$nilai = $_GET['nilai'];
//$potensio = $_GET['potensio'];
mysqli_query($mysqli,"UPDATE control SET nilai='$nilai'WHERE id='$id'");
header("location:connect.php");

?>
