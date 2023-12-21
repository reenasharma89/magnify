<?php require 'db/connection_open.php';?>

<?php 
	  	$arr = $departmentArr = [];

		$q = mysqli_query($conn,"SELECT e.e_id,e.email,e.e_status,e.name,d.dep_id FROM employee as e LEFT JOIN employee_detail as d ON e.e_id = d.e_id order by e.e_id") or die (mysqli_error($conn));

		$dep_sql = "SELECT * FROM department";
		$dep_res = $conn->query($dep_sql);

		if($dep_res->num_rows>0) {
			while($dep_row = $dep_res->fetch_assoc()) {
				$departmentArr[$dep_row["id"]] = $dep_row["dep_name"];
			}
		}

		  while($row = mysqli_fetch_assoc($q)) {
		  	//echo "<pre>"; print_r($row); die;
		  	$arr[] = [
		  		$row["e_id"],
		  		$row["name"],
		  		$row["email"],
		  		(isset($departmentArr[$row["dep_id"]])) ? $departmentArr[$row["dep_id"]] : "",
		  	];
		  }
		
		$finalArr = [
			"total"=>count($arr),
			// "totalNotFiltered"=>count($arr),
			// "rows"=>$arr,
			"data"=>$arr,
		];

		echo json_encode($finalArr);
	  ?>