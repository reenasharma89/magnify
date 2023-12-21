<?php require 'db/connection_open.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Magnify - Employee</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	 <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
      id="theme-styles"
    />

</head>
<body><br/>
	<div class="container" style="padding: 5px;">
    <div class="row">
	<div class="col-sm-6" style="border: 1px solid black; padding: 10px;">
	<form id="magnify_employee" method="POST">
		<div class="mb-3 row">
	    	<label for="employee_name" class="col-sm-4 col-form-label">Employee Name</label>
	    	<div class="col-sm-6">
	      		<input type="text" class="form-control" name="employee_name" id="employee_name" required>
	    	</div>
	  	</div>
	  	<div class="mb-3 row">
	    	<label for="employee_id" class="col-sm-4 col-form-label">Employee ID</label>
	    	<div class="col-sm-6">
	      		<input type="text" class="form-control" name="employee_id" id="employee_id" required>
	    	</div>
	  	</div>
		<div class="mb-3 row">
	    	<label for="email" class="col-sm-4 col-form-label">Email</label>
	    	<div class="col-sm-6">
	      		<input type="email" class="form-control" name="email" id="email" required>
	    	</div>
	  	</div>
	  	<div class="mb-3 row">
	    	<label for="employment_status" class="col-sm-4 col-form-label">Employment Status</label>
	    	<div class="col-sm-6">
	      		<select class="form-select" name="employment_status"  id="employment_status" required>
	      			<option value="1">Active</option>
	      			<option value="0">Inactive</option>
	      		</select>
	    	</div>
	  	</div>
	  	<div class="mb-3 row">
	    	<label for="department" class="col-sm-4 col-form-label">Department</label>
	    	<div class="col-sm-6">
	      		<select class="form-select" multiple  id="department" name="department[]" required>
				  <?php 
				  	$sql = "SELECT * FROM department";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
					    echo "<option value=".$row['id'].">".$row['dep_name']."</option>";
					  }
					} else {
					  echo "0 results";
					}
				  ?>
				</select>
	    	</div>
	  	</div>
  		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	</div>
	<div class="col-sm-6" style="border: 1px solid black; padding: 10px;">
		
		<table id="employee_data" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Employee Status</th>
                <th>Department</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Employee Status</th>
                <th>Department</th>
            </tr>
        </tfoot>
    </table>

	</div>
</div>
</div>

	<script type="text/javascript">

		var data_table = new DataTable('#employee_data', {
    ajax: 'employee.php',
     processing: true,
    serverSide: false
});
 
		$('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'post_employee.php',
            data: $('form').serialize(),
            success: function (res) {
            	 data_table.ajax.reload( null, false ); 
              Swal.fire(
							  res
							);
							$('#magnify_employee').trigger("reset");
            }
          });
        });



</script>
</body>
</html>
<?php require 'db/connection_close.php';?>