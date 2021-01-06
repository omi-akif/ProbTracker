<?php
require_once("db_connect.php");

$dis = $_POST['division_id'];

$dis_query = 'SELECT id,name FROM `districts` WHERE `division_id` = "'.$dis.'"';

$dis_conn = $conn->query($dis_query);

$districts = $dis_conn->fetch_all(MYSQLI_ASSOC);

?>

    <div class="form-group"> 
        <select name="district" id ="district" class="form-control">
            <option value="" class="form-control" disabled selected hidden>District</option>
            <?php foreach($districts as $district):?>
                <option value="<?=$district['id'];?>">
                    <?=$district['name']?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>