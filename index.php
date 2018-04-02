<?php
//index.php

$error = '';
$name = '';
$year = '';
$division = '';
$roll = '';

//function for formatting strings to correct form
function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
			if(empty($_POST["name"])) //name
			{
					$error .= '<p><label class="text-danger">Please Enter Valid Name</label></p>';
			}
			else
			{
					$name = clean_text($_POST["name"]);
					if(!preg_match("/^[a-zA-Z ]*$/",$name))
					{
							$error .= '<p><label class="text-danger">Please Enter Valid Name</label></p>';
					}
			}
			if(isset($_POST["year"])) //year
			{
							$year =$_POST["year"];
			}
			else
			{
							$error .= '<p><label class="text-danger">Please Enter Valid Year</label></p>';
			}
			if(empty($_POST["division"])) //division
			{
							$error .= '<p><label class="text-danger">Please Enter Valid Division</label></p>';
			}
			else
			{
		 					$division =clean_text($_POST["division"]);
			if(!ctype_alpha($division) or !preg_match("/^[a-rA-R ]$/",$division) )
			{
							$error .= '<p><label class="text-danger">Please Enter Valid Division</label></p>';
			}
			}
			if(empty($_POST["roll"])) //roll number
			{
							$error .= '<p><label class="text-danger">Please Enter Valid Roll Number</label></p>';
			}
			else
			{
							$roll = $_POST["roll"];

			if(!is_numeric($roll) or ($roll>80) )
			{
							$error .='<p><label class="text-danger">Please Enter Valid Roll Number</label></p>';
			}
			}

			if($error == '')
			{
							$file_open = fopen("form_data.csv", "a"); //open file in append mode
							$no_rows = count(file("form_data.csv"));
							if($no_rows > 1)
							{
							$no_rows = ($no_rows - 1) + 1;
							}
$form_data = array( //make array of input data
'sr_no'		=>	$no_rows,
'name'		=>	$name,
'year'		=>	$year,
'division'	=>	$division,
'roll'	=>	$roll);

							fputcsv($file_open, $form_data); //store array as a record of one line in csv
							$error = '<label class="text-success">Your Form is Successfully Submitted!</label>';
							$name = '';
							$year = '';
							$division = '';
							$roll = '';
			}
}
//html code
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Web Form</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h1 align="center"><strong>TRF Form</strong></h1>
			<div class="col-md-6" style="margin:0 auto; float:none;">
				<form method="post">
					<h3 align="center">Student Information</h3>
					<br/>
					<?php echo $error; ?>
					<div class="form-group">
						<label>Enter Name</label>
						<input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
					</div>
					<div class="form-group">
						<label>Enter Year</label>
						<select name="year">
							<option value="1"> </option>
							<option value="2">1</option>
							<option value="3">2</option>
							<option value="4">3</option>
							<option value="5">4</option>
						</select>
					</div>
					<div class="form-group">
						<label>Enter Division</label>
						<input type="text" name="division" class="form-control" placeholder="Enter Division" value="<?php echo $division; ?>" />
					</div>
					<div class="form-group">
						<label>Enter Roll Number</label>
						<input type="text" name="roll" class="form-control" placeholder="Enter Roll Number" value="<?php echo $roll; ?>"/>
					</div>
					<div class="form-group" align="center">
						<input type="submit" name="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
