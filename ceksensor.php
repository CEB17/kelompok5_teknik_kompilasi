<?php
$conn = mysqli_connect("localhost", "root", "", "iot");
$result = mysqli_query($conn, "SELECT * FROM led");
$data = mysqli_fetch_array($result);
$isi = $data ["potensio"];

echo $isi;
?>