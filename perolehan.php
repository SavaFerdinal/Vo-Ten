<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perolehan</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <style>
    body {
      background: #000428;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #004e92, #000428);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #004e92, #000428);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
  </style>
</head>

<body>
  <div class="container" style="padding-top:20px; color:#eee; text-align:center;">
    <h2>HASIL VOTING</h2>
    <hr>
  </div>

  <?php
  define("BASEPATH", dirname(__FILE__));
  session_start();

  include('./include/connection.php');

  if (isset($_POST['periode'])) {
    $periode = $_POST['periode'];
  } else {
    $now     = date('Y');
    $dpn     = date('Y') + 1;
    $periode = $now . '/' . $dpn;
  }

  $get = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?");
  $get->bind_param('s', $periode);
  $get->execute();
  $get->store_result();
  $htg = $get->num_rows();

  if ($htg > 0) {
  ?>
    <?php
    for ($i = 0; $i < $htg; $i++) {
      $get->bind_result($id, $nama, $foto, $visi, $misi, $suara, $per);
      $get->fetch();
    ?>
    <div class="container">
      <div class="text-center">
        <div class="row">
          <div class="col-md-4">
            <div class="thumbnail">
              <img class="kandidat" src="../assets/img/kandidat/<?php echo $foto; ?>">
              <div class="suara">
                <span class="badge alert-success"><b><?php echo $suara; ?> Suara</b></span>
              </div>
              <div class="caption" style="text-align:center">
                <h4><?php echo $nama; ?></h4>
              </div>
            </div>
          </div>
        <?php
      }
        ?>
      <?php
      } else {

        echo '<div>
               <div class="warning callout" style="padding: 30px 20px; text-align: center; color:#eee;">
                 <h3><b>TIDAK ADA KANDIDAT!</b></h3>
               </div>
          </div>';
      }
      ?>
      </div>
      
      <div class="text-center">
        <a href="./" class="btn btn-danger">Back to Home</a>
        </div>
      </div>
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>