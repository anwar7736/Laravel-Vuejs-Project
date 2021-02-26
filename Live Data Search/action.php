<?php 

	$con = new PDO("mysql:host=localhost;dbname=testing","root","");
	$receive_data = json_decode(file_get_contents("php://input"));
	$data = array();
		if ($receive_data->search!='') {
			$query = "SELECT * FROM tbl_sample WHERE first_name LIKE '%".$receive_data->search."%' OR last_name LIKE '%".$receive_data->search."%'";
		}
		else{
			$query = "SELECT * FROM tbl_sample ORDER BY id DESC";
		}
		$statement = $con->prepare($query);
		$statement->execute();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		echo json_encode($data);
	

?>