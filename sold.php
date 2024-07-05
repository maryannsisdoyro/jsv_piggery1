<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<?php 
 if(!$_GET['id'] OR empty($_GET['id']) OR $_GET['id'] == '')
 {
 	header('location: manage-pig.php');

 }else{
 	
 	$pigno = $bname = $b_id = $cname = $c_id = $fname = $f_id = $vname = $v_id =$health = "";
 	$id = (int)$_GET['id'];
 	$query = $db->query("SELECT * FROM pigs WHERE id = '$id' ");
 	$fetchObj = $query->fetchAll(PDO::FETCH_OBJ);

 	foreach($fetchObj as $obj){
		$pid = $obj->id;
       $pigno = $obj->pigno;
	   $b_id = $obj->breed_id;
	   $c_id = $obj->classification_id;
       $f_id = $obj->feed_id;
       $v_id = $obj->vitamins_id;
	   $health = $obj->health_status;

	     $k = $db->query("SELECT * FROM breed WHERE id = '$b_id' ");
		 $k = $db->query("SELECT * FROM classification WHERE id = '$c_id' ");
         $k = $db->query("SELECT * FROM feed WHERE id = '$f_id' ");
         $k = $db->query("SELECT * FROM vitamins WHERE id = '$v_id' ");
       	 $ks = $k->fetchAll(PDO::FETCH_OBJ);
       	 foreach ($ks as $r) {
       	 	$bname = $r->name;
			$cname = $r->name;
            $fname = $r->name;
            $vname = $r->name;
       	 }
 	}
 }

?>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Pig Management</b></h5>
  </header>
 
 <?php #include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
	 <div class="w3-row">
	 	<h2>Sold List</h2>
	 	<div class="col-md-6 table-responsive">
	 		<table class="table table-hover" id="table">
	 			<thead>
	 				<tr>
	 					<th>Pig No</th>
	 					<th>Date sold</th>
	 					<!-- <th>Breed</th>
                        <th>Classification</th>
                        <th>Feed</th>
                        <th>Vitamins</th> -->
	 					<th>Reason</th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				<?php

	 				$get = $db->query("SELECT p.pigno,s.date_sold,s.reason FROM sold s LEFT JOIN pigs p ON s.pig_id = p.id");
	 				$res = $get->fetchAll(PDO::FETCH_OBJ);
	 				foreach($res as $n){ ?>
                         <tr>
                         	<td> <?php echo $n->pigno; ?> </td>
                         	<td>  <?php echo $n->date_sold; ?> </td>
                         	<td> <?php echo $n->reason; ?> </td>
                         </tr> 
	 				<?php }

	 				?>
	 			</tbody>
	 		</table>
	 	</div>

	 	<div class="col-md-6">

     <?php
      if(isset($_POST['submit']))
      {
      	$id = $_POST['id'];
     
      	// $n_breed = $_POST['breed'];
        // $n_breed = $_POST['classification'];
        // $n_breed = $_POST['feed'];
        // $n_breed = $_POST['vitamins'];
      	$n_remark = $_POST['reason'];
      	$now = date('Y-m-d');
		$status = 3;
  

      	$n_id = $_GET['id'];

      	$insert_query = $db->query("INSERT INTO sold(pig_id, date_sold, reason)VALUES('$id','$now', '$n_remark') ");

		$update_pig = $db->query("UPDATE pigs SET status = '$status' WHERE id = '$id'");

      	if($insert_query){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Pig successfully sold <i class="fa fa-check"></i></strong>
        </div>
       <?php
         header('refresh: .5');
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error inserting pig data. Please try again <i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }

      }

     ?>


	 		<form role='form' method="post">
			
			 <input type="hidden" name="id" readonly="on" class="form-control" value="<?php echo $pid; ?>">
	 			<div class="form-group">
	 				<label class="control-label">Pig No</label>
	 				<input type="text" name="pigno" readonly="on" class="form-control" value="<?php echo $pigno; ?>">
	 			</div>

	 			<!-- <div class="form-group">
	 				<label class="control-label">Breed</label>
	 				<input type="text" name="breed" readonly="on" class="form-control" value="<?php echo $bname; ?>">
	 			</div>
                
	 			<div class="form-group">
	 				<label class="control-label">Classification</label>
	 				<input type="text" name="classsificaation" readonly="on" class="form-control" value="<?php echo $cname; ?>">
	 			</div>
                
	 			<div class="form-group">
	 				<label class="control-label">Feed</label>
	 				<input type="text" name="feed" readonly="on" class="form-control" value="<?php echo $fname; ?>">
	 			</div>
                
	 			<div class="form-group">
	 				<label class="control-label">Vitamins</label>
	 				<input type="text" name="vitamins" readonly="on" class="form-control" value="<?php echo $vname; ?>">
	 			</div> -->
				

	 			<div class="form-group">
	 				<label class="control-label">Reason</label>
	 				<textarea name="reason" placeholder="Enter reason for sold" class="form-control" value=""></textarea>
	 			</div>

	 			<button name="submit" type="submit" class="btn btn-sm  btn-default">Add to list</button>
	 		</form>
	 	</div>
	 </div>
</div>

</div>

<?php include 'theme/foot.php'; ?>