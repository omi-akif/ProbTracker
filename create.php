<?php
// Include config file
include_once("db_connect.php");

$name = $division = $district = $upazila = $mob_num = $holding_num = $problem = $solution = "";
$name_err = $holding_num_err = $problem_err = $solution_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
	
	//Enter divisions
	$input_division = $_POST['division'];
	$division = $input_division;

	//Enter districts
	$input_district = $_POST['district'];
	$district = $input_district;

	//Enter upazila
	$input_upazila = $_POST['upazila'];
	$upazila = $input_upazila;

	//Enter mobile number
	$input_mob_num = $_POST['mobile'];
	$mob_num = $input_mob_num;

	// Validate holding_num
    $input_holding_num = trim($_POST["holding_num"]);
    if(empty($input_holding_num)){
        $holding_num_err = "Please enter the holding_num amount.";     
    } elseif(!ctype_digit($input_holding_num)){
        $holding_num_err = "Please enter a positive integer value.";
    } else{
        $holding_num = $input_holding_num;
    }

    // Validate problem
    $input_problem = trim($_POST["problem"]);
    if(empty($input_problem)){
        $problem_err = "Please enter a problem.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $problem = $input_problem;
    }
    
    //Validate solution
    $input_solution = trim($_POST["solution"]);
    $solution = $input_solution;
    
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($problem_err) && empty($holding_num_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (names, problem, holding_num) VALUES (?, ?, ?)";
 
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssi", $param_name, $param_holding_num, $param_problem, $param_solution);
            
            // Set parameters
            $param_name = $name;
            $param_holding_num = $holding_num;
            $param_problem = $problem;
            $param_solution = $solution;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        // $stmt->close();
    }
    
    // Close connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Mysoftheaven (BD) Ltd.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>

	
	


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Mysoftheaven (BD) Ltd.</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="wrapper">
						<div class="row no-gutters">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="contact-wrap w-100 p-md-5 p-4 py-5">
									<h3 class="mb-4">State your problem</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
				            Your problem has been sent!
				      		</div>
									<form method="POST" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="date" id="dates" value="<?php echo date('Y-m-d'); ?>">
												</div>
                                            </div>
                                            
                                            <div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="name" id="names" placeholder="Name">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													
													<?php 
														$div_sql = "SELECT id, name FROM divisions";
														$div_res = $conn->query($div_sql);
														$divisions = $div_res->fetch_all(MYSQLI_ASSOC);
													?>
													
													<select name="division" id="division" class="form-control">
														
														<option value="" class="form-control" disabled selected hidden>Division</option>
														<?php foreach($divisions as $division):?>
															<option value="<?=$division['id'];?>">
																<?=$division['name']?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>

											<div class="col-md-12"> 
												<div class="form-group">
													<select class="form-control" name="division" id="district">
														
														<option value="" class="form-control">District</option>
														
													</select>
												</div>
											</div>

											<div class="col-md-12" id="upazila"> 
												<div class="form-group">		
													<select class="form-control">
														
														<option value="" class="form-control">Upazila</option>
														
													</select>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="holding_num" id="holding_num" placeholder="Holding Number">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<textarea name="prob_stat" class="form-control" id="prob_stat" cols="30" rows="6" placeholder="Problem"></textarea>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<textarea name="solution" class="form-control" id="solution" cols="30" rows="6" placeholder="Solution"></textarea>
												</div>
											</div>


											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Submit" name = "submit" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>

											<!-- Close connection -->
											<?php 
											
											$conn->close(); 
											
											?>

										</div>
									</form>
								</div>
							</div>
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="info-wrap w-100 p-md-5 p-4 py-5 img">
									<h3>Contact information</h3>
									<p class="mb-4">We're open for any suggestion or just to have a chat</p>
				        	<div class="dbox w-100 d-flex align-items-start">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Address:</span> 19-B/2-C & 2-D, Block-F, 5th Floor, Ring Road, Shamoli, Dhaka-1207. </p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Phone:</span> <a href="tel://+8801970776606">+8801970776606</a></p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Email:</span> <a href="mailto:info@mysoftheaven.com">info@mysoftheaven.com</a></p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Website</span> <a href="https://www.mysoftheaven.com/">www.mysoftheaven.com</a></p>
					          </div>
				          </div>
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>

	</body>

<script>
		$(document).ready(function(){
			$("#division").on("change", function(){
				
				var division = this.value;
				// console.log(division);
				$.ajax({
					type: 'POST',
					url: 'district.php',
					data: {'division_id': division},
					success: function(data)
					{
						console.log(data);
						$('#district').html(data);
					}
				});
			});
				
		});

		$(document).ready(function(){
			$("#district").on("change", function(){
				// var district = $('#district').data();
				var district = this.value;

				$.ajax({
					type: 'POST',
					url: 'upazila.php',
					data: {'district_id': district},
					success: function(data)
					{
						console.log(data);
						$('#upazila').html(data);
					}
				});
			});				
		});

	
			

</script>
</html>