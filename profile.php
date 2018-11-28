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

?>

<h3 class="my-3 mt-5">Your Feeds
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

<!-- Posts -->
<?php
    list($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted) = $pControl->getPosts("user_id =".$_SESSION['id']."");

    for ($index = 0; $index < sizeof($post_titles); $index++) {
        $post_user = $up->getUserInformation($post_userID[$index]);

        echo "".
                '<div class="card mb-4">' .
                    '<div class="card-header">' .
                        '<a class="font-weight-bold" href="#">' .
                            '<img src="' . $up->getProfilePicture($post_user['user_id']) . '" alt="..." class="border border-dark rounded-circle img-icon">' .
                            " " . $post_user['firstname'] . " " . $post_user['lastname'] .
                        '</a>'
            ."";
                            if ($post_userID[$index] == $_SESSION['id']) {
                                echo "" .
                                    '<div class=" float-right">' .
                                        '<a href="editpost.php?id=' . $post_ID[$index] . '" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>' .
                                        // '<a href="#" id="deletePost" name="deletePost" post-id-ref="'.$post_ID[$index].'" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>' .
                                        '<a href="#" id="deletePost" name="deletePost" post-id-ref="'.$post_ID[$index].'" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>' .
                                        // document.getElementById(SELECTED_DATE_ID).getAttribute('data-value'); for JavaScript to access attibute for id
                                    '</div>'
                                ."";
                            }

        echo "".    '</div>' .

                    '<div class="card-body">' .
                        '<a href="viewpost.php?id=' . $post_ID[$index] . '">' .
                            '<h3 class="card-title">' . $post_titles[$index] . '</h3>' .
                        '</a>' .
                        '<p class="card-text">' . $post_contents[$index] . '</p>' .
                        '<a href="viewpost.php?id=' . $post_ID[$index] . '" class="btn btn-secondary float-right">' .
                            '<span class="fas fa-comment-alt"></span> Comment' .
                        '</a>' .
                    '</div>' .
                    '<div class="card-footer text-muted">' .
                        '<small>' .
                            'Posted on ' . $post_datePosted[$index] .
                        '</small>' .
                    '</div>' .
                '</div>'
            ."";
    }

 ?>

<?php include 'includes/footer.php'; ?>
