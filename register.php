<?php
include_once('controller/InfoController.php');
include_once('controller/AuthController.php');


  $auth = new AuthController;
  $info = new InfoController;

  $data['sex'] = $info->getSex();

// echo "<pre>";var_dump($data['sex']->fetch_assoc());exit();

  if(isset($_POST['register'])) {
    $data = array( 'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'middlename' => $_POST['middlename'],
                    'sex' => $_POST['sex'],
                    'bdate' => $_POST['bdate'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
            );

    $register_res = $auth->register($data);
    if($register_res === FALSE) {
      echo "ERROR";
    }
  }
 ?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Social Media Mini</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/font-awesome/css/all.css">

    <style>
    body {
      background-color: rgba(115,140,142,1);
    }
    .register-title{
      color:rgba(27, 63, 75, 1);
      font-size: 2em;
      text-align: center;
      font-weight: 600;
      /* text-shadow: 2px 3px 3px rgba(0, 0, 0, 0.3); */
      text-shadow: -1px -1px 0px rgba(27, 63, 75, 1),
                    1px -1px 0px rgba(27, 63, 75, 1),
                    -1px 1px 0px rgba(27, 63, 75, 1),
                    1px 1px 0px rgba(27, 63, 75, 1);

      /* border-bottom: 10px solid rgba(27, 63, 75, 0.5); */
    }

    </style>
  </head>

  <body class="">

    <div class="mx-auto w-50">

      <p class="register-title">
        <span class="fas fa-dragon"></span>
        Mini Social Media
      </p>

      <div class="card">
        <div class="card-header text-center">
          <h4>Sign-up</h4>
        </div>
        <div class="card-body w-100 mx-auto">

          <form class="" method="POST">
            <div class="row mx-auto">
              <div class="form-group col-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
              </div>
              <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
            </div>

            <hr>

            <div class="row mt-4">
              <div class="form-group col-12">
                <label for="username">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required>
              </div>
              <div class="form-group col-12">
                <label for="username">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" required>
              </div>
              <div class="form-group col-12">
                <label for="username">Middle name</label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle name" required>
              </div>
              <div class="form-group col-6">
                <label for="sex">Sex</label>
                <select class="form-control" id="sex" name="sex" required>
                  <option ></option>
                  <?php
                    foreach ($data['sex'] as $sex) {
                      echo '<option value="'.$sex['id'].'">'.$sex['sex'].'</option>';
                    }
                   ?>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="bdate">Birth Date</label>
                <input type="date" class="form-control" id="bdate" name="bdate" required>
              </div>

              <div class="form-group col-6">
                <label for="address">Address</label>
                <input type="address" class="form-control" id="address" name="address" placeholder="Address" required>
              </div>

              <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Middle name" required>
              </div>
            </div>

            <hr>

            <button type="submit" name="register" class="btn btn-primary btn-block float-right"><span class="fas fa-pen"></span> Register</button>
            <a class="btn btn-light btn-block float-left" href="login.php"> <span class="fas fa-arrow-left"></span> Cancel</a>
          </form>

        </div>
      </div>
    </div>



    <!-- Bootstrap core JavaScript -->
    <script src="./assets/jquery/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
