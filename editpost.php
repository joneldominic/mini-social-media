<?php

include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
?>

<hr>
<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-header">
    <h5>Update Post</h5>
  </div>
  <div class="card-body">
    <form class="" action="viewpost.php?id=postID" method="post">
      <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" class="form-control" id="post_title" placeholder="Example input" value="OLD TITLE">
      </div>
      <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" id="post_content" rows="3"> OLD CONTENT. Update post page when button update is click, the information in the database should be updated and the page will reroute to viewpost.php page that will display the updated information </textarea>
      </div>
      <button class="btn btn-secondary float-right">
        <span class="fas fa-pen"></span> Update
      </button>
    </form>
  </div>
  <div class="card-footer text-muted">
    <small>
      Date posted
    </small>
  </div>


</div>



<?php include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located
?>
