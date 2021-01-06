<?php 
include_once("db_connect.php");
include("header.php");
?>
<title>probTrackerr</title>
<script type="text/javascript" src="dist/jquery.tabledit.js"></script>
<?php include_once("container.php") ?>
<div class="container home">
	<h2>probTrackerr</h2>

		<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			
			<label for="dates">Date</label>
			<input type="text" value="<?php echo date('Y-m-d'); ?>" name="date" id="dates"> 

			<label for="divisions">Division</label>
			<input type="text" name="divison" id="divisions">

			<label for="districts">District</label>
			<input type="text" name="district" id="districts"> <br><br>

			<label for="upazillas">Upazilla</label>
			<input type="text" name="upazilla" id="upazillas">

			<label for="names">Name</label>
			<input type="text" name="name" id="names"> <br><br>

			<label for="mobiles">Mobile Number</label>
			<input type="text" name="mobile" id="mobiles">

			<label for="hoding_nums">Holding Numbers</label>
			<input type="number" name="holding_num" id="holding_nums">

			<label for="descriptions">Problem Statement</label>
			<input type="text" name="prob_stat" id="prob_stats"> <br><br>

			<label for="descriptions">Solution</label>
			<input type="text" name="solution" id="solutions"> <br><br>
			
			
			<button type="submit" name="submit" id="taskBtn" class="taskBtn">Add Problems</button>
			
		</form>

</div>

	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Problem Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add Problem</a>
					</div>
					</div>
            </div>        
        </div>
    </div>
<?php 

if(isset($_POST['submit'])){

	if(empty($_POST['prob_stat'])){
		echo "Can you please enter something before submitting?";
	}
	else{
		
		// $id = $_POST['id'];
		$dates = $_POST['date']; //Converting htmlentiies to string
		$divison = $_POST['divison'];
		$district = $_POST['district'];
		$upazilla = $_POST['upazilla'];
		$names = $_POST['name'];
		$mobile = $_POST['mobile'];
		$holding_num = $_POST['holding_num'];
		$prob_stat = $_POST['prob_stat'];
		$solution = $_POST['solution'];

		$sql = "INSERT INTO lims(dates, divison, district, upazilla, names, mobile, holding_num, prob_stat, solution) VALUES ('$dates', '$divison', '$district', '$upazilla', '$names', '$mobile', '$holding_num', '$prob_stat', '$solution')";
	
		if($conn->query($sql) == True){
			echo "You added a problem that you need to check";
			header("location: index.php");
		}
		else{
			echo "Error: ". $sql . "<br>" . $db->error;
		}
	}	
}

?>

	<table id="prob_table" class="table table-striped">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Serial No.</th>
				<th>Dates</th>
				<th>Division</th>
				<th>District</th>
				<th>Upazilla</th>
				<th>Name</th>
				<th>Mobile</th>
				<th>Holding Number</th>
				<th>Problem Statement</th>
				<th>Solution</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql_query = "SELECT * FROM lims";
			
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $lims = mysqli_fetch_assoc($resultset) ) {
			?>
			   <tr id="<?php echo $lims ['id']; ?>">
			   <td><?php echo $lims ['id']; ?></td> 
			   <td><?php echo $lims ['id']; ?></td>
			   <td><?php echo $lims ['dates']; ?></td>
			   <td><?php echo $lims ['divison']; ?></td>
			   <td><?php echo $lims ['district']; ?></td>
			   <td><?php echo $lims ['upazilla']; ?></td>
			   <td><?php echo $lims ['names']; ?></td>
			   <td><?php echo $lims ['mobile']; ?></td>
			   <td><?php echo $lims ['holding_num']; ?></td>
			   <td><?php echo $lims ['prob_stat']; ?></td>
			   <td><?php echo $lims ['solution']; ?></td>
			   </tr>
			<?php } ?>
		</tbody>
    </table>
</div>
<script type="text/javascript" src="custom_table_edit.js"></script>
<?php include('footer.php');?>
