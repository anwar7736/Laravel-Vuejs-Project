<?php 

	$con = new PDO("mysql:host=localhost;dbname=testing","root","");
	$receive_data = json_decode(file_get_contents("php://input"));
	$data = array();
	if($receive_data->district!=''){
		$query = " SELECT * FROM tbl_district WHERE dist_name LIKE '%".$receive_data->district."%' ORDER BY dist_name ASC LIMIT 10 ";
		$statement = $con->prepare($query);
		$statement->execute();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
	}
	echo json_encode($data);	
?>