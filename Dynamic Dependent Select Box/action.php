<?php 
$con = new PDO("mysql:host=localhost;dbname=testing","root","");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->request_for == 'Division') {
	$query = "SELECT * FROM tbl_division ORDER BY division_name ASC";
}
if ($received_data->request_for == 'District') {
	$query = "SELECT * FROM tbl_district WHERE division_id = '".$received_data->division_id."'";
}
if ($received_data->request_for == 'State') {
	$query = "SELECT * FROM tbl_state WHERE district_id = '".$received_data->district_id."' ORDER BY state_name ASC";
}
$statement = $con->prepare($query);
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
	$data[] = $row;
}
echo json_encode($data);
?>