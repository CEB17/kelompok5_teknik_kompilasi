<?php
include 'config.php';
$id = $_GET['id'];
$nilai_sensor=mysqli_query($mysqli,"SELECT nilai FROM control WHERE id='$id'");
 
if($val=mysqli_fetch_array($nilai_sensor)){
echo "#";
echo $val['nilai'];
echo "#@";


}
?>
