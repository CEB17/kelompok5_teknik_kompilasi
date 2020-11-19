<?php include 'css.css';
include 'config.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<link rel="stylesheet" href="css.css">
	<script type="text/javascript" src = "jquery/jquery.min.js"></script>
	<title>IoT Kelompok 5</title>
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#ceksensor").load('ceksensor.php');
			}, 1000);
		});
	</script>




</head>
<div class="body">
<body>
	<div class="h2">
		<h2>IoT Kelompok 5</h2>
	</div>

	<div class ="tul">
		<ul>DATA POTENSIO</ul>
		<ul><span id ="ceksensor"></span></ul>
	</div>

	<ul>

	<button class="button tombs" onclick="window.location.href='control.php?id=1&nilai=1'">ON!</button>

	</ul>
	
	<ul>
	
	<button class="button tombs" onclick="window.location.href='control.php?id=1&nilai=0'">OFF</button>
	
	</ul>

	<ul>
	<div class="ket">
	<?php
		$data = mysqli_query($mysqli, "SELECT nilai FROM control WHERE id='1'");
		if($val=mysqli_fetch_array($data)){
		$hasil = $val['nilai'];
		if($hasil == 1){
		$status = "LAMPU ON!";
		}
		else {
		$status = "LAMPU OFF";
		}

		echo $status;
		}
		?>
	</div>
	</ul>


	<!--<button class="button">Button</button>-->

</body>
</div>
</html>