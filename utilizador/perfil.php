<?php
session_start();

if (!isset($_SESSION['Utilizador']) && !isset($_SESSION['id']) ){
  header( "Location:log.php" );
}

if ($_SESSION['role'] == 'admin'){
  header( "Location:../admin/perfil.php" );
}

?>
<!DOCTYPE html>
<html lang="en">
<!--Perfil do User-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="perfil">
  <meta name="author" content="Tiago Moura">

  <title>Perfil</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/thumbnail-gallery.css" rel="stylesheet">
  
  <!-- Responsive CSS -->
  <link href="css/responsive.css" rel="stylesheet"> 

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
  <?php require('topfooter.php');?>
  <div class="container" style="margin-top: 70px;margin-right:250px;">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Perfil</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form>
                  <div class="form-group row">
                    <label for="username" class="col-4 col-form-label">User Name*</label> 
                    <div class="col-8">
                      <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">First Name</label> 
                    <div class="col-8">
                      <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="lastname" class="col-4 col-form-label">Last Name</label> 
                    <div class="col-8">
                      <input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nick Name*</label> 
                    <div class="col-8">
                      <input id="text" name="text" placeholder="Nick Name" class="form-control here" required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select" class="col-4 col-form-label">Display Name public as</label> 
                    <div class="col-8">
                      <select id="select" name="select" class="custom-select">
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">Email*</label> 
                    <div class="col-8">
                      <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="website" class="col-4 col-form-label">Website</label> 
                    <div class="col-8">
                      <input id="website" name="website" placeholder="website" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="publicinfo" class="col-4 col-form-label">Public Info</label> 
                    <div class="col-8">
                      <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="newpass" class="col-4 col-form-label">New Password</label> 
                    <div class="col-8">
                      <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="offset-4 col-8">
                      <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>