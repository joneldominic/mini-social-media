<?php

include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
?>

<hr>
<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-header">
    <a class="font-weight-bold" href="#">
      <img src="./images/dp.jpg" alt="..." class="border border-dark rounded-circle img-icon">
      Your account profile name here
    </a>
    <div class=" float-right">
      <a href="editpost.php?id=postID" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>
      <a href="#" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>
    </div>
  </div>
  <div class="card-body">
    <a href="#"><h3 class="card-title">This is your POst</h3></a><small>January 1, 2017</small>
    <p class="card-text">You can edit and update your post</p>
    <a href="#" class="btn btn-secondary float-right">
      <span class="fas fa-comment-alt"></span> Comment
    </a>

    <div class="clearfix"></div>
    <!-- <hr class=""> -->
    <ul class="list-group list-group-flush text-small mt-3">
      <li class="list-group-item">
        <form class="" action="index.html" method="post">
          <div class="form-group">
            <!-- <label for="post_content">Content</label> -->
            <textarea class="form-control" id="post_content" rows="2"></textarea>
          </div>
          <button href="#" class="btn btn-secondary btn-sm float-right">
            <span class="fas fa-share"></span> Post
          </button>
        </form>
      </li>
      <li class="list-group-item">
        <a href="#"><b class="card-title">Account A name </b></a> <small>January 1, 2017</small>
        <p class="card-text">asdas asdkqw asda aoioisd asdad</p>
      </li>
      <li class="list-group-item">
        <a href="#"><b class="card-title">Account B name </b></a> <small>January 1, 2017</small>
        <p class="card-text">asdas asdkqw asda aoioisd asdad</p>
      </li>
      <li class="list-group-item">
        <a href="#"><b class="card-title">Account C name </b></a> <small>January 1, 2017</small>
        <p class="card-text">asdas asdkqw asda aoioisd asdad</p>
      </li>
      <li class="list-group-item">
        <div class="float-left">
          <a href="#"><b class="card-title">Your Account </b></a> <small>January 1, 2017</small>
          <p class="card-text">Your Comment</p>
        </div>
        <div class=" float-right">
          <!-- <a href="#" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a> -->
          <a href="#" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>
        </div>
      </li>
    </ul>
  </div>
  <!-- <div class="card-footer">

  </div> -->
</div>



<?php include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located
?>
