<?php
    include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
    include_once('controller/InfoController.php');

    if (isset($_GET['id'])) {
        $currentPostID = $_GET['id'];
        $postData = $pControl->getSinglePost($_GET['id']);
        $posterData = $up->getUserInformation($postData['user_id']);
    } else {
        $postData = $pControl->getSinglePost(null);
    }

    if (isset($_POST['deletePost'])) {
        $data = array(  'post_ID' => $_POST['post_ID_Del'],
                        'post_userID' => $_POST['post_userID_Del'],
                      );

        $post_del = $pControl->deletePost($data, "index.php");
        if ($post_del === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['addPostComment'])) {
        $data = array(  'postID_comment' => $_POST['postID_comment'],
                        'postUserID_comment' => $_POST['postUserID_comment'],
                        'postContent_comment' => $_POST['post_content'],
                      );

        if ($data['postContent_comment'] == null) {
            echo '<script>alert("Cannot post empty comment")</script>';
        } else {
            $post_addComment = $pControl->addComment($data);
            // echo "comment added";
            if ($post_addComment === false) {
                echo "ERROR";
            }
        }
    }

    if (isset($_POST['deletePostComment'])) {

        $postComment_del = $pControl->deletePostComment($_POST['postCommentID'], "viewpost.php?id=$currentPostID");
        if ($postComment_del === false) {
            echo "ERROR";
        }
    }


?>

<hr>
<!-- Blog Post -->
<div class="card mb-4">
    <div class="card-header">
        <a class="font-weight-bold"
            href=
                <?php
                    if($user_data['user_id'] == $postData['user_id']) {
                        echo "profile.php?id=". $user_data['user_id'] ."" ;
                    } else {
                        echo "friendsprofile.php?id=". $postData['user_id'] ."" ;
                    }
                ?>
            >
            <img src=<?php echo "". $up->getProfilePicture($posterData['user_id'] .""); ?> alt="..." class="border border-dark rounded-circle img-icon">
            <?php echo "". $posterData['firstname'] . " " . $posterData['lastname'] .""; ?>
        </a>

        <?php if($user_data['user_id'] == $postData['user_id']) { ?>
            <div class="float-right">
                <!-- <a href="editpost.php?id=postID" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a> -->
                <!-- <a href="#" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a> -->
                <a href="editpost.php?id=<?php echo $currentPostID ?>" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>

                <form method="post">
                    <input type="hidden" name="post_ID_Del" value="<?php echo $currentPostID ?>">
                    <input type="hidden" name="post_userID_Del" value="<?php echo $user_data['user_id'] ?>">

                    <button type="submit" id="deletePost" name="deletePost" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </button>
                </form>
            </div>
        <?php } ?>

    </div>

    <div class="card-body">
        <a href="#"><h3 class="card-title"><?php echo $postData['title']; ?></h3></a><small><?php echo $postData['date_posted']; ?></small>
        <p class="card-text"><?php echo $postData['content']; ?></p>
        <a href="#" class="btn btn-secondary float-right">
            <span class="fas fa-comment-alt"></span> Comment
        </a>
    <div class="clearfix"></div>

    <!-- <hr class=""> -->
        <ul class="list-group list-group-flush text-small mt-3">
            <li class="list-group-item">
                <form class="" method="post">
                    <div class="form-group">
                        <!-- <label for="post_content">Content</label> -->
                        <input type="hidden" name="postID_comment" value="<?php echo $currentPostID ?>">
                        <input type="hidden" name="postUserID_comment" value="<?php echo $user_data['user_id'] ?>">

                        <textarea class="form-control" id="post_content" name="post_content" rows="2"></textarea>
                    </div>
                    <button type="submit" id="addPostComment" name="addPostComment" class="btn btn-secondary btn-sm float-right">
                        <span class="fas fa-share"></span> Post
                    </button>
                </form>
            </li>

<?php
            list($comment_ID, $comment_userID, $comment_contents, $comment_datePosted) = $pControl->getComments($currentPostID);
            if (is_array($comment_ID)) {
                for ($index = 0; $index < sizeof($comment_ID); $index++) {
                    $post_user = $up->getUserInformation($comment_userID[$index]);

                    if ($comment_userID[$index] == $user_data['user_id']) {
?>
                    <li class="list-group-item">
                        <div class="float-left">
                            <a href="profile.php?id=<?php echo $user_data['user_id'] ?>"><b class="card-title"><?php echo $post_user['firstname'] ." ". $post_user['lastname'] ?></b></a><small><?php echo " " . $comment_datePosted[$index] ?></small>
                            <p class="card-text"> <?php echo $comment_contents[$index] ?> </p>
                        </div>

                        <div class=" float-right">
                            <!-- <a href="#" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a> -->
                            <form class="" method="post">
                                <input type="hidden" id="postCommentID" name="postCommentID" value="<?php echo $comment_ID[$index] ?>">
                                <button type="submit" id="deletePostComment" name="deletePostComment" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span></button>
                            </form>
                        </div>
                    </li>
<?php
                    } else {
?>
                    <li class="list-group-item">
                        <a href="friendsprofile.php?id=<?php echo $comment_userID[$index] ?>"><b class="card-title"><?php echo $post_user['firstname'] ." ". $post_user['lastname'] ?></b></a><small><?php echo " " . $comment_datePosted[$index] ?></small>
                        <p class="card-text"><?php echo $comment_contents[$index] ?></p>
                    </li>
<?php
                    }
                }
            }
?>



<!--
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
              <comment><a href="#" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a></comment>
              <a href="#" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>
            </div>
          </li> -->

        </ul>
    </div>
    <!-- <div class="card-footer">

    </div> -->
</div>

<?php
    include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located
?>
