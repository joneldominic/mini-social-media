<?php
  include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
  include_once('controller/InfoController.php');

  $infoC = new InfoController;
  $infoC_data['privacy'] = $infoC->getPrivacy();

  if(isset($_GET['id'])) {
    $currentPostID = $_GET['id'];
    $postData = $pControl->getSinglePost($currentPostID);
  } else {
    $postData = $pControl->getSinglePost(null);

  }

  if (isset($_POST['updatePost']) && isset($_GET['id'])) {
      $data = array(  'post_ID' => $_GET['id'],
                      'post_title' => $_POST['post_title'],
                      'post_content' => $_POST['post_content'],
                      'post_privacy' => $_POST['post_privacy'],
          );

      if ($data['post_title'] == null || $data['post_content'] == null) {
        if ($data['post_title'] == null) {
            echo '<script>alert("Post need to have a title")</script>';
        } elseif ($data['post_content'] == null) {
            echo '<script>alert("Post need to have a content")</script>';
        } else {
            echo '<script>alert("Post need to have a title and content")</script>';
        }
      } else {
        $post_update = $pControl->updatePost($data,"viewpost.php?id=".$currentPostID."");
        if ($post_update === false) {
            echo "ERROR";
        }
      }
  }

?>

<hr>
<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-header">
    <h5>Update Post</h5>
  </div>
  <div class="card-body">
    <form class="" method="post">
      <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Example input" value="<?php echo $postData['title']; ?>">
      </div>
      <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="3"><?php echo $postData['content']; ?></textarea>
      </div>
      <label for="post_privacy">Privacy</label>
      <select class="form-control" id="post_privacy" name="post_privacy" required>
        <?php
          foreach ($infoC_data['privacy'] as $infoC_data) {
            if($infoC_data['id'] == $postData['privacy']) {
              echo '<option value="'.$infoC_data['id'].'" selected>'.$infoC_data['privacy'].'</option>';
            } else {
              echo '<option value="'.$infoC_data['id'].'">'.$infoC_data['privacy'].'</option>';
            }
          }
         ?>
      </select>
      <br />
      <button type="submit" name="updatePost" id="updatePost"class="btn btn-secondary float-right">
        <span class="fas fa-pen"></span> Update
      </button>
    </form>
  </div>
  <div class="card-footer text-muted">
    <small>
      <?php echo $postData['date_posted']; ?>
    </small>
  </div>
</div>


<?php include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located
?>
