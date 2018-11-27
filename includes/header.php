<?php
  session_start(); // starting the session the access session variables
  // check if session isloggedin is null, if null redirect the page to login.php
  if ($_SESSION['isloggedin'] === null) {
      header('Location: login.php');
  }

  include_once 'controller/UserProfileController.php';


  $up = new UserProfileController;
  $user_data = $up->getUserInformation($_SESSION['id']);

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

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"> <span class="fas fa-lg fa-dragon " ></span> Social Media Mini</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="profile.php?id=<?php echo $user_data['id']?>">
                <span class="fas fa-user"></span>

                <?php
                echo($user_data['firstname']);
                ?>

              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">
                <span class="fa fa-home"></span>
                Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=""> <span class=""></span> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="friendslist.php">
                <span class="badge badge-pill badge-danger">2</span>
                <span class="fas fa-users"></span>
                Friends
              </a>
            </li>

            <!-- <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="fas fa-user-plus"></span>
                Friend Requests
              </a>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fas fa-cog"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="manageprofile.php?id=<?php echo $user_data['id']; ?>"> <span class="fas fa-cogs"></span> Manage Profile</a>
                <a class="dropdown-item" href="changepassword.php?id=<?php echo $user_data['id']; ?>"> <span class="fas fa-key"></span> Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="controller/logout.php"> <span class="fas fa-sign-out-alt "></span> Sign-out</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
