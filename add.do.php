<?php
	$conn = new mysqli('localhost','root','','it');
?>
<?php
if(isset($_POST['name']) && strlen($_POST['name'])){
	$name = $_POST['name'];
	$passout = $_POST['passout'];
	$company = $_POST['company'];
	$file_name = $_FILES['fileToUpload']['name'];
	$file_type = $_FILES['fileToUpload']['type'];
	$file_size = $_FILES['fileToUpload']['size'];
	$file_temp = $_FILES['fileToUpload']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	echo $file_name;
	$out_name = $passout.'_'.$name.'.'.$ext;
	$out_fol = 'uploads/'.$out_name;
	echo $out_fol;
	if($ext=='png' || $ext=='jpg' || $ext=='jpeg'){
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check[0]<$check[1]){
			echo "<br>Done";
			move_uploaded_file($file_temp, $out_fol);
			$sql = "INSERT INTO que(name,passout,company,imgname) VALUES('$name','$passout','$company','$out_name')";
			if($conn->query($sql)===TRUE){
				echo "Success";
			}
			else{
				echo "Error";
			}
		}
		else{
			echo "<br>Please choose a Potrait image";
		}
	}
	else{
		echo "Image is not png or jpg";
	}
}
else{
	echo "Enter all the data";
}

?>