<?php defined('BASEPATH') or die("No Access Allowed"); ?>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="text-center">
        <span><h1>Selamat Datang Di Vo-Ten</h1></span>
      </div>
      <div class="col-md-9 col-lg-6 ">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="post">
          <div class="text-center">
          <span class="info-login"><h4>Login untuk dapat melakukan pemilihan</h4></span>
          </div>

          <div class="divider d-flex align-items-center my-4">
          </div>

          <!-- NIS input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Masukkan NIS</label>
            <input type="number" class="form-control form-control-lg" placeholder="Enter a valid NIS" required="NIS" name="nis"/>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" name="submit" value="Login" class="btn btn-danger btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">
          </div>

        </form>
      </div>
    </div>
  </div>
</section>