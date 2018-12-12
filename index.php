<!DOCTYPE html>
<html>
<head>
	<title>Page</title>
	<style type="text/css">
		.box{
			margin: 5px;
			width: 180px;
			border: 2px solid black;
			float:left;
			padding: 8px;
		}
		.inbox{
			height: 240px;
		}
		.outbox{
			height: 60px;
		}
	</style>
</head>
<body>
	Register Yourself : <a href="add.php"> Register here </a><br>
	Select passout Year :
	<form method="get" action="">
		<select name="yearby">
			<option value="">All</option>
			<option value="2021">2021</option>
			<option value="2020">2020</option>
			<option value="2019">2019</option>
			<option value="2018">2018</option>
			<option value="2017">2017</option>
			<option value="2016">2016</option>
			<option value="2015">2015</option>
			<option value="later">Later</option>
		</select>
		<button type="submit">Search</button>
	</form>
<?php
$conn = new mysqli('localhost','root','','it');
if(isset($_GET['yearby'])){
	if(($_GET['yearby'])>1998){
			$yearby = $_GET['yearby'];
			$sql = "SELECT * FROM student WHERE passout='$yearby'";
	}
	else if(($_GET['yearby'])=='later'){
			$yearby = $_GET['yearby'];
			$sql = "SELECT * FROM student WHERE passout<2015";
	}
	else{
			$yearby = $_GET['yearby'];
			$sql = "SELECT * FROM student";
	}
}
else{
	$sql = 'SELECT * FROM student';
}
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
echo "<p>".$num." persons found</p>";
while($row = mysqli_fetch_assoc($result)){
	$img_name = 'img/'.$row['id'].".jpg";
	echo "<div class='box'><div class='inbox'>";
	echo "<img src='$img_name' style='width:180px;height:240px'></div><br>";
	echo "<div class='outbox'><b>".$row['name']."</b><br>Company : ".$row['company']."<br>Passout : ".$row['passout']."</div></div>";
}
?>
</body>
</html>

