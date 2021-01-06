<?php
require_once("db_connect.php");

$upa = $_POST['district_id'];


$upa_query = 'SELECT id,name FROM `upazilas` WHERE `district_id` = "'.$upa.'"';

$upa_conn = $conn->query($upa_query);

$upazilas = $upa_conn->fetch_all(MYSQLI_ASSOC);


?>

<div class="form-group"> 
        <select name="upazila" id="upazila" class="form-control">
            <option value="" class="form-control" disabled selected hidden>Upazila</option>
            <?php foreach($upazilas as $upazila):?>
                <option value="<?=$upazila['id'];?>">
                    <?=$upazila['name']?>
                </option>
            <?php endforeach; ?>
        </select>
</div>