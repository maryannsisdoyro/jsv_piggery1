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
 <canvas id="myChart" style="width:100%;"></canvas>
</div>

<script>
var xValues = ["Pigs", "Quarantine", "Sold", "Breeds", "Vitamins", "Feeds", "Classifications"];
var yValues = [<?php echo $pCount;  ?>, <?php echo $quarantine;  ?>, <?php echo $sold;  ?>, <?php echo $bCount;  ?>, <?php echo $vCount;  ?>, <?php echo $fCount;  ?>, <?php echo $cCount;  ?>];
var barColors = ["#478ef2", "#478ef2","#478ef2","#478ef2","#478ef2", "#478ef2", "#478ef2", "#478ef2"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Total Records"
    }
  }
});
</script>

</div>


<?php include 'theme/foot.php'; ?>