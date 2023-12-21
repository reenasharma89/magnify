<?php require 'db/connection_open.php';?>

<?php 
//echo "<pre>"; print_r($_POST); echo "</pre>"; die;

extract($_POST);

$email = (string)$email;
$sql = "INSERT INTO employee (
	e_id, name, email,e_status)
VALUES (
	'$employee_id', 
	'$employee_name', 
	'$email', 
	'$employment_status')";

if ($conn->query($sql) === TRUE) {

	$emp_dep_str = '';
	foreach($department as $dv){
		$emp_dep_str .= "(".$employee_id.",".$dv.") ,";
	}
	
	$emp_dep_str = rtrim($emp_dep_str,',');

	$multi_sql = "INSERT INTO employee_detail (e_id, dep_id) VALUES $emp_dep_str";

	if($conn->query($multi_sql) === TRUE){
		echo "New record created successfully";
	} else {
		echo "Error: " . $multi_sql . "<br>" . $conn->error;
	}

  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
die;


?>