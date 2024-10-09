<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php
$all_rooms = find_all_desc('chat');

// Function to fetch all records from a table in descending order of 'id'
function find_all_desc($table) {
  global $db;
  $sql = "SELECT * FROM {$table} ORDER BY id DESC";
  return find_by_sql($sql);
}

?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-7 col-md-offset-1">
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
        <center><strong>Mga Bugo chat</strong></center>
      </div>
      <div class="panel-body">
      <form method="POST" action="autodelete2.php">
      <button type="submit" class="btn btn-danger" name="delete_selected" style="float: right;">
  <span class="glyphicon glyphicon-trash"></span> Delete
</button>
<br><br>
    <table style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_rooms as $room): ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="room-checkbox" name="rooms[]" value="<?php echo (int)$room['id']; ?>">
                    </td>
                    <td><?php echo remove_junk(ucfirst($room['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($room['email'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($room['message'])); ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="autodelete2.php?id=<?php echo (int)$room['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
<?php if (isset($js_error_msgs)): ?>
  <script src="sweetalert.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessages = <?php echo $js_error_msgs; ?>;
        errorMessages.forEach(function(msg) {
            swal({
                title: "",
                text: msg,
                icon: "warning",
                dangerMode: true
            });
        });
    });
  </script>
<?php endif; ?>

<script src="sweetalert.min.js"></script>
<script>
const urlParams = new URLSearchParams(window.location.search);
const successParam = urlParams.get('success');

if (successParam === 'true') {
    let successMessage = "";
    if (urlParams.get('delete_room')) {
        successMessage = "Rooms Deleted Successfully.";
    }
    
    swal("", successMessage, "success")
        .then((value) => {
            window.location.href = 'autodelete.php'; 
        });
}

// Select All Checkbox Functionality
document.getElementById('select-all').addEventListener('click', function(event) {
  var checkboxes = document.querySelectorAll('.room-checkbox');
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = event.target.checked;
  });
});
</script>
