<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Recent Pigs</h2>
 <div class=" table-responsive">
 	<table class="table table-hover" id="table">
 		<thead>
 			<tr>
 				<th>S/N</th>
 				<th>Pig No.</th>
 				<th>Breed</th>
				<th>Classification</th>
				<th>Feed</th>
				<th>Vitamins</th>
 				<th>Weight</th>
 				<th>Gender</th>
 				<th>Arrived</th>
				 <th>Remark</th>
 				<th>Desc.</th>
 			</tr>
 		</thead>
 		<tbody>
 		<?php
$qpi = $db->query("SELECT * FROM pigs ORDER BY id");
$result = $qpi->fetchAll(PDO::FETCH_OBJ);
$c = $qpi->rowCount();

foreach ($result as $j) {
    $pigname = $j->pigno;
    $b_id = $j->breed_id;
    $c_id = $j->classification_id;
    $f_id = $j->feed_id;
    $v_id = $j->vitamins_id;
    $weight = $j->weight;
    $gender = $j->gender;
    $remark = $j->remark;
    $description = $j->description;
    $arr = $j->arrived;

    $breed_query = $db->query("SELECT name FROM breed WHERE id = '$b_id'");
    $breed_result = $breed_query->fetch(PDO::FETCH_OBJ);
    $bname = ($breed_result) ? $breed_result->name : '';

    $classification_query = $db->query("SELECT name FROM classification WHERE id = '$c_id'");
    $classification_result = $classification_query->fetch(PDO::FETCH_OBJ);
    $cname = ($classification_result) ? $classification_result->name : '';
  
    $feed_query = $db->query("SELECT name FROM feed WHERE id = '$f_id'");
    $feed_result = $feed_query->fetch(PDO::FETCH_OBJ);
    $fname = ($feed_result) ? $feed_result->name : '';

    $vitamins_query = $db->query("SELECT name FROM vitamins WHERE id = '$v_id'");
    $vitamins_result = $vitamins_query->fetch(PDO::FETCH_OBJ);
    $vname = ($vitamins_result) ? $vitamins_result->name : '';

    ?>
    <tr>
        <td><?php echo $j->id; ?></td>
        <td><?php echo $pigname; ?></td>
        <td><?php echo $bname; ?></td>
        <td><?php echo $cname; ?></td>
        <td><?php echo $fname; ?></td>
        <td><?php echo $vname; ?></td>
        <td><?php echo $weight; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $arr; ?></td>
        <td><?php echo $remark; ?></td>
        <td><?php echo $description; ?></td>
    </tr>
    <?php
}
?>

 		</tbody>
 	</table>
 </div>
 </div>
</div>


</div>


<?php include 'theme/foot.php'; ?>