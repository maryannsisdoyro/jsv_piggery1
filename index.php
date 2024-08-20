<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<style>
  .card {
    background: #fff;
    box-shadow: 1px 1px 20px 1px rgba(0, 0, 0, 0.2);
  }

  .card .card-body {
    padding: 10px;
  }

  .card .card-body h4 {
    font-weight: bold;
  }

  .card .card-body .d-flex {
    display: flex;
    gap: 10px;
  }

  .card .card-img-top {
    height: 250px;
  }

  .card .card-img-top img {
    height: 100%;
    object-fit: cover;
    object-position: center;
  }
</style>

<div class="container">
  <div class="row" style="margin: 20px 0;">
    <div class="col-md-12">
      <h3 style="margin-bottom: 20px;">Pigs Available</h3>
    </div>
    <?php
    $all_pig = $db->query("SELECT 
        p.*,
        b.name AS breed_name, 
        c.name AS class_name, 
        v.name AS vita_name, 
        f.name AS feed_name  
        FROM pigs p LEFT JOIN breed b ON p.breed_id = b.id LEFT JOIN vitamins v ON p.vitamins_id = v.id LEFT JOIN classification c ON p.classification_id = c.id LEFT JOIN feed f ON p.feed_id = f.id WHERE p.status = 1 ORDER BY p.id DESC ");
    $fetch = $all_pig->fetchAll(PDO::FETCH_OBJ);
    if ($all_pig->rowCount() > 0) {
      foreach ($fetch as $data) {
    ?>

        <div class="col-md-4">
          <div class="card">
            <div class="card-img-top">
              <img src="<?= $data->img ?>" alt="image">
            </div>
            <div class="card-body">
              <h4><?= $data->pigno ?></h4>
              <div class="d-flex">
                <div>
                  <p>Breed</p>
                  <p>Classification</p>
                  <p>Weight</p>
                  <p>Month(s)</p>
                </div>
                <div>
                  <p>: <?= $data->breed_name ?></p>
                  <p>: <?= $data->class_name ?></p>
                  <p>: <?= $data->weight ?> kilogram</p>
                  <p>: <?= $data->month > 1 ? $data->month . ' months' : $data->month . ' month' ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      }
    } else {
      ?>
      <div class="col-md-12 text-center">
        <h5>No record found</h5>
      </div>
    <?php

      $get = $db->query("SELECT
      q.id, 
      q.date_q,
      q.date_start,
      q.date_end,
      q.reason,
      b.name AS breed,
      p.pigno,
      c.name AS classification,
      f.name AS feed,
      v.name AS vitamins
      FROM 
      quarantine q 
      LEFT JOIN 
      pigs p ON q.pig_no = p.id 
      LEFT JOIN 
      classification c ON p.classification_id = c.id 
      LEFT JOIN 
      feed f ON p.feed_id = f.id 
      LEFT JOIN 
      vitamins v ON p.vitamins_id = v.id 
      LEFT JOIN 
      breed b ON p.breed_id = b.id 
      WHERE 
      p.status = 2
      ");
            $res = $get->fetchAll(PDO::FETCH_OBJ);
            $today_date = date('Y-m-d');
            foreach ($res as $n) {
              if ($n->date_end == $today_date) {
                $update = $db->query("UPDATE pigs SET status = 1 WHERE id = '$n->pigno'");
                if ($update) {
                  $delete = $db->query("DELETE FROM quarantine WHERE id = $n->id");
                }
              }
            }
          }
    ?>
  </div>
</div>


<?php include 'theme/foot.php'; ?>