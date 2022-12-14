<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if(!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>E - Voting</title>
      <link rel="stylesheet" href="./assets/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="./assets/css/animate.css"/>
      <style media="screen">
         body {
            background: #000428;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #004e92, #000428);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #004e92, #000428); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            color:#fff;
         }
         .img {
            height: 200px;
            width: 196px;
         }

         .button.success {
           background-color: #059f3e;
           color: #ebebeb;
         }

         .button.success:hover, .button.success:focus {
            background-color: #22bb5b;
            color: #fefefe;
         }
         .nama {
           position:absolute;
           background: rgba(35, 35, 35, 0.624);
           width: 196px;
           top: 178px;
           font-size:16px;
           padding:3px 0px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <?php
         require('./include/connection.php');

         $thn     = date('Y');
         $dpn     = date('Y') + 1;
         $periode = $thn.'/'.$dpn;

         $sql = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?") or die($con->error);
         $sql->bind_param('s', $periode);
         $sql->execute();
         $sql->store_result();
         if ($sql->num_rows() > 0) {
            $numb = $sql->num_rows();
            echo '<div class="text-center" style="padding-top:20px;">
                     <h2>Daftar Calon Ketua Osis Periode '.$periode.'</h2>
                  </div>
                  <hr />';

            echo '<div class="row">';

            echo '<div class="col-md-10 col-md-offset-1">';

               for ($i = 1; $i <= $numb; $i++) {
                  $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
                  $sql->fetch();
         ?>
                  <div class="col-md-3">
                    <section class="wow fadeInDown" data-wow-delay="<?php echo $i; ?>s">
                      <div class="thumbnail">  
                        <div class="text-center">
                           <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="img">
                           <p class="nama"><?php echo $nama; ?></p>
                           <div class="caption">
                              <a href="./detail.php?id=<?php echo $id; ?>" class="btn btn-warning btn-block">Lihat Visi Misi</a>
                              <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="btn btn-success btn-block">Beri Suara</a>
                           </div>
                          </div>
                        </div>
                     </section>
                  </div>

         <?php
               }

            echo '</div>';

         } else {

            echo '<div class="text-center" style="padding-top: 25%;">
                     <h1>Belum Ada Calon Ketua</h1>
                     <a href="logout.php" class="btn btn-danger">Kembali ke Beranda</a>
                  </div>';
         }

         echo '</div>';
         ?>
      </div>

      <script type="text/javascript" src="./assets/js/jquery.js"></script>
      <script type="text/javascript" src="./assets/js/wow.js"></script>
      <script type="text/javascript">
         wow = new WOW(
            {
               animateClass: 'animated',
               offset:100,
               callback:function(box) {
                  console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
               }
            }
         );
         wow.init();
      </script>
   </body>
</html>
