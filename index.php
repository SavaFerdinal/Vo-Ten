<?php
define('BASEPATH', dirname(__FILE__));
session_start();

if (isset($_SESSION['siswa'])) {
   header('location:./vote.php');
}

if (isset($_POST['submit'])) {

   require('include/connection.php');

   $nis     = $_POST['nis'];
   $thn     = date('Y');
   $dpn     = date('Y') + 1;
   $periode = $thn.'/'.$dpn;

   $cek = $con->prepare("SELECT * FROM t_pemilih WHERE nis = ? && periode = ?") or die($con->error);
   $cek->bind_param('ss', $nis, $periode);
   $cek->execute();
   $cek->store_result();

   if ($cek->num_rows() > 0) {

      echo '<script type="text/javascript">alert("Anda sudah memberikan suara");</script>';

   } else {

      $sql = $con->prepare("SELECT * FROM t_user WHERE id_user = ? && pemilih = 'Y'") or die($con->error);
      $sql->bind_param('s', $nis);
      $sql->execute();
      $sql->store_result();

      if ($sql->num_rows() > 0 ) {
         $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
         $sql->fetch();

         $_SESSION['siswa'] = $id;

         header('location:./vote.php');

      } else {

         echo '<script type="text/javascript">alert("Anda tidak berhak memberikan suara");</script>';

      }

   }

}


?>
<!DOCTYPE html>
<html>
      <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Vo-Ten</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
            <link rel="stylesheet" href="./assets/css/custom.css"/>
            <style type="text/css">
                  #content-slider {
                  position: relative;
                  width: 400px;
                  height: 300px;
                  overflow: hidden;
                  }
                  #content-slider img {
                  display: block;
                  width: 400px;
                  height: 300px;
                  }
                  .img-thanks {
                        max-width: 200px;
                        width: 100%;
                        max-height: 250px;
                  }

                  .divider:after,
                  .divider:before {
                  content: "";
                  flex: 1;
                  height: 1px;
                  background: #eee;
                  }
                  .h-custom {
                  height: calc(100% - 73px);
                  }
                  @media (max-width: 450px) {
                  .h-custom {
                  height: 100%;
                  }
                  }
            </style>
      </head>
      <body>
            <div class="container">
                  <div class="row">
                        <div class="col-md-12">
                        <?php
                        if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                              case 'thanks':
                              include('./thanks.php');
                              break;

                              default:
                              include('./form.php');
                              break;
                        }
                        } else {
                        include('./form.php');
                        }
                        ?>

                        </div>
                  </div>
                  
            </div>
            <script type="text/javascript" src="./assets/js/jquery-2.2.3.min.js"></script>
            <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function() {
            $('#content-slider').cycle({
                  fx: 'fade',
                  speed: 1000,
                  timeout: 500
            });
            });
            </script>
      </body>
</html>
