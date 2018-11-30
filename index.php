<?php

    include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
    include_once('controller/InfoController.php');

    $infoC = new InfoController;
    $infoC_data['privacy'] = $infoC->getPrivacy();

    if (isset($_POST['addPost'])) {
        $data = array(  'user_id' => $_POST['user_id'],
                        'post_title' => $_POST['post_title'],
                        'post_content' => $_POST['post_content'],
                        '$post_privacy' => $_POST['privacy'],
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
            $post_res = $pControl->addPost($data);
            if ($post_res === false) {
                echo "ERROR";
            }
        }
    }

    if (isset($_POST['deletePost'])) {
        $data = array(  'post_ID' => $_POST['post_ID_Del'],
                        'post_userID' => $_POST['post_userID_Del'],
            );


        $post_del = $pControl->deletePost($data,"index.php");
        if ($post_del === false) {
            echo "ERROR";
        }
    }

?>

<h3 class="my-3 mt-5">News Feeds
</h3>
<hr>

<!-- Post -->
<div class="card mb-4">
    <div class="card-header">
        <h5>What's on your mind?</h5>
    </div>
    <div class="card-body">
        <form class="" method="post">
            <div class="form-group">
                <label for="post_title">Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter you post title here...">
            </div>
            <div class="form-group">
                <label for="post_content">Content</label>
                <textarea class="form-control" id="post_content" name="post_content" rows="3" placeholder="Enter you post content here..."></textarea>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" id="privacy" name="privacy" required>
                          <?php
                            foreach ($infoC_data['privacy'] as $infoC_data) {
                                echo '<option value="'.$infoC_data['id'].'">'.$infoC_data['privacy'].'</option>';
                            }
                           ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" name="addPost" class="btn btn-secondary float-right">
                            <span class="fas fa-share"></span> Share
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-muted">
        <small>
            <?php
                date_default_timezone_set("Asia/Manila");
                $date_array = getdate();

                $formated_date  = "Date: ";
                $formated_date .= $date_array['year'] . "/";
                $formated_date .= $date_array['mon'] . "/";
                $formated_date .= $date_array['mday'];

                echo $formated_date;
            ?>
        </small>
    </div>
</div>

<?php
    list($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted) = $pControl->getPosts("(user_id LIKE '%' AND (privacy=1 OR privacy=3)) OR (user_id=". $_SESSION['id'] ." AND privacy=2)");
    if(is_array($post_titles)) {
        for ($index = 0; $index < sizeof($post_titles); $index++) {
            $post_user = $up->getUserInformation($post_userID[$index]);
 ?>
            <div class="card mb-4">
                <div class="card-header">
<?php
                    if ($post_userID[$index] == $_SESSION['id']) {
?>
                        <a class="font-weight-bold" href="profile.php?id=<?php echo $post_userID[$index] ?>">
                            <img src="<?php echo $up->getProfilePicture($post_user['user_id']) ?>" alt="Profile Picture" class="border border-dark rounded-circle img-icon">
                            <?php echo $post_user['firstname'] . " " . $post_user['lastname'] ?>
                        </a>

                        <div class=" float-right">
                            <a href="editpost.php?id=<?php echo $post_ID[$index] ?>" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>

                            <form method="post">
                                <input type="hidden" name="post_ID_Del" value="<?php echo $post_ID[$index] ?>">
                                <input type="hidden" name="post_userID_Del" value="<?php echo $post_userID[$index] ?>">

                                <button type="submit" id="deletePost" name="deletePost" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </button>
                            </form>
                        </div>
<?php
                    } else {
?>
                        <a class="font-weight-bold" href="friendsprofile.php?id=<?php echo $post_userID[$index] ?>">
                            <img src="<?php echo $up->getProfilePicture($post_user['user_id']) ?>" alt="Profile Picture" class="border border-dark rounded-circle img-icon">
                            <?php echo $post_user['firstname'] . " " . $post_user['lastname'] ?>
                        </a>
<?php
                    }
?>
                </div>

                <div class="card-body">
                    <a href="viewpost.php?id=<?php echo $post_ID[$index] ?>">
                        <h3 class="card-title"><?php echo $post_titles[$index] ?></h3>
                    </a>
                    <p class="card-text"><?php echo $post_contents[$index] ?></p>
                    <a href="viewpost.php?id=<?php echo $post_ID[$index] ?>" class="btn btn-secondary float-right">
                        <span class="fas fa-comment-alt"></span> Comment
                    </a>
                </div>
                <div class="card-footer text-muted">
                    <small>
                        Posted on <?php echo $post_datePosted[$index] ?>
                    </small>
                </div>
            </div>
<?php
        }
    }
?>

<?php include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located?>
