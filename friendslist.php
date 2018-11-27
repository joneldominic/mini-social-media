<?php include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
 // add security sessions here
 // only logged in users can access this page

?>

<h3 class="my-3 mt-5">Friend Requests
</h3>
<hr>

<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-body">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Kolit</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-success align-self-center float-right"> <span class="fas fa-check-circle "></span> Accept</a>
        </div>
      </li>

      <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Kolit</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-success align-self-center float-right"> <span class="fas fa-check-circle "></span> Accept</a>
        </div>
      </li>

    </ul>
  </div>
</div>

<h3 class="my-3 mt-5">Friends List
</h3>
<hr>

<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-body">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Kolit</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-danger align-self-center float-right"> <span class="fas fa-trash"></span> Remove</a>
        </div>
      </li>

      <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Coolot</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-danger align-self-center float-right"> <span class="fas fa-trash"></span> Remove</a>
        </div>
      </li>
    </ul>
  </div>
</div>




<?php include 'includes/footer.php';
  // include the header; header.php is a file where the nav bar is located
?>
