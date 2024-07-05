<?php 
include 'setting/system.php';

if(isset($_POST['remove'])){
	
	if (!empty($_POST['selector'])) {
		$id=$_POST['selector'];
		$N = count($id);
		$status = 1;
		for($i=0; $i < $N; $i++)
		{
			$check = $db->query("SELECT p.id,p.pigno FROM quarantine q INNER JOIN pigs p ON q.pig_no = p.id WHERE q.id = '$id[$i]'");
			$row = $check->fetch(PDO::FETCH_ASSOC);
			$update_pig = $db->query("UPDATE pigs SET status = '$status' WHERE id = ". $row['id']."");
	
			if ($update_pig) {
				$query = $db->query("DELETE FROM quarantine where id ='$id[$i]'");
			}
			 
		}
		header("location: manage-quarantine.php");
	}else{
		header("location: manage-quarantine.php");
	}
}
?>
