<?php 

	$con = new PDO("mysql:host=localhost;dbname=registration","root","");
	$receive_data = json_decode(file_get_contents("php://input"));
	$data = array();
	if ($receive_data->email!='') {
		$is_available = 'Yes';
		$query = "SELECT * FROM login_system WHERE Email='".$receive_data->email."'";
		$statement = $con->prepare($query);
		$statement->execute();
		$count = $statement->rowCount();
		if ($count > 0) {
			$is_available = 'No';
		}
		$data = array(
			'is_available' => $is_available

		);
		}
		echo json_encode($data);	
?>