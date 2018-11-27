<?php include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located

  include_once('controller/InfoController.php');

  $info = new InfoController;

  $data['sex'] = $info->getSex();

// echo "<pre>";var_dump($data['sex']->fetch_assoc());exit();

  if(isset($_POST['updateprofile'])) {
    $data = array(  'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'middlename' => $_POST['middlename'],
                    'sex' => $_POST['sex'],
                    'bdate' => $_POST['bdate'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
                    'user_id' => $_POST['user_id'],
            );

    $res = $up->updateUserProfile($data);
    if($res === FALSE) {
      echo "ERROR";
    }
  }

?>

<h3 class="my-3 mt-5">Profile Manager
</h3>
<hr>

<div class="card mb-4">
  <div class="card-body">
    <div id="changePP">
      <label>Profile Picture</label> <br />
      <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image" class="" />
            <br />
            <img id="img_preview" src="#" alt="Profile Picture" class="img-fluid d-none" width="200px" height="200px"/>
            <br />
            <input type="submit" name="update_ProfilePic" id="update_ProfilePic" value="Update" class="d-none"/>
      </form>
      <?php $up->updateProfilePicture($_SESSION['id']) ?>
    </div>
  </div>
</div>


<div class="card mb-4">
  <!-- <div class="card-header">
    <a class="font-weight-bold" href="#">
      <img src="./images/dp.jpg" alt="..." class="border border-dark rounded-circle img-icon">
      Jhone Ronelle Maaghop
    </a>
  </div> -->
  <div class="card-body">
    <form class="" method="POST">
      <div class="row mt-4">
        <div class="form-group col-12">
          <label for="username">First name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_data['firstname'] ?>" placeholder="First name" required>
        </div>
        <div class="form-group col-12">
          <label for="username">Last name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user_data['lastname'] ?>" placeholder="Last name" required>
        </div>
        <div class="form-group col-12">
          <label for="username">Middle name</label>
          <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $user_data['middlename'] ?>" placeholder="Middle name" required>
        </div>
        <div class="form-group col-6">
          <label for="sex">Sex</label>
          <select class="form-control" id="sex" name="sex" required>
            <option ></option>
            <?php
              foreach ($data['sex'] as $sex) {
                if($sex['id'] == $user_data['sex'])   echo '<option value="'.$sex['id'].'" selected="selected" >'.$sex['sex'].'</option>';
                else echo '<option value="'.$sex['id'].'">'.$sex['sex'].'</option>';
              }
             ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label for="bdate">Birth Date</label>
          <input type="date" class="form-control" id="bdate" name="bdate" value="<?php echo $user_data['bdate'] ?>" required>
        </div>

        <div class="form-group col-6">
          <label for="address">Address</label>
          <input type="address" class="form-control" id="address" name="address" value="<?php echo $user_data['address'] ?>" placeholder="Address" required>
        </div>

        <div class="form-group col-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email'] ?>" placeholder="Middle name" required>
        </div>
      </div>

      <hr>
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
      <button type="submit" name="updateprofile" class="btn btn-primary btn-block float-right"><span class="fas fa-pen"></span> Update</button>
      <a class="btn btn-light btn-block float-left" href="index.php"> <span class="fas fa-arrow-left"></span> Cancel</a>
    </form>


  </div>
  <!-- <div class="card-footer text-muted">
    <small>
      Date Today!
    </small>
  </div> -->
</div>


<?php include 'includes/footer.php'; ?>
