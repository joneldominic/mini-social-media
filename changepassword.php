<?php include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located

  $usrid = $_GET['id'];

  if(isset($_POST['updatepassword'])) {
    $data = array(  'oldpassword' => md5($_POST['oldpassword']),
                    'newpassword' => md5($_POST['newpassword']),
                    'id' => $usrid,
            );

    include_once('controller/AuthController.php');
    $auth = new AuthController;

    $res = $auth->updateUserPassword($data);
    if($res === FALSE) {
      echo "ERROR";
    }
  }

?>

<h3 class="my-3 mt-5">Profile Manager
</h3>
<hr>

<!-- Blog Post -->
<div class="card mb-4">
  <!-- <div class="card-header">
    <a class="font-weight-bold" href="#">
      <img src="./images/dp.jpg" alt="..." class="border border-dark rounded-circle img-icon">
      Jhone Ronelle Maaghop
    </a>
  </div> -->
  <div class="card-body">
    <form class="" method="POST">
      <div class="row mx-auto">
        <div class="form-group col-12">
          <label for="username">Old Password</label>
          <input type="text" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" required>
        </div>
        <div class="form-group col-12">
          <label for="password">Password</label>
          <input type="text" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required>
        </div>
      </div>

      <hr>
      <input type="hidden" name="user_id" value="<?php echo $usrid; ?>">
      <button type="submit" name="updatepassword" class="btn btn-primary btn-block float-right"><span class="fas fa-pen"></span> Change</button>
      <a class="btn btn-light btn-block float-left" href="index.php"> <span class="fas fa-arrow-left"></span> Cancel</a>
    </form>


  </div>

</div>


<?php include 'includes/footer.php'; ?>
