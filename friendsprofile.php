<?php
    include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
    include_once('controller/InfoController.php');

    $infoC = new InfoController;
    $infoC_data['privacy'] = $infoC->getPrivacy();

    if (isset($_GET['id'])) {
        $currentUserID = $_GET['id'];
        $postData = $pControl->getSinglePost($_GET['id']);
        $curr_user = $up->getUserInformation($currentUserID);
    } else {
        $postData = $pControl->getSinglePost(null);
    }


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

        $post_del = $pControl->deletePost($data,"profile.php?id=".$user_data['user_id']."");
        if ($post_del === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['exec_Addfriend'])) {
        $data = array(  'from_user_id' => $_POST['from_user_id'],
                        'to_user_id' => $_POST['to_user_id'],
            );

        $AddFriendRequest = $fControl->addFriendRquest($data['from_user_id'], $data['to_user_id']);
        if ($AddFriendRequest === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['exec_Unfriend'])) {
        $data = array(  'from_user_id' => $_POST['from_user_id'],
                        'to_user_id' => $_POST['to_user_id'],
            );
        $unfriend = $fControl->unfriend($data['from_user_id'], $data['to_user_id'], "friendsprofile.php?id=".$data['to_user_id']."");
        if ($unfriend === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['exec_CancelRequest'])) {
        $data = array(  'from_user_id' => $_POST['from_user_id'],
                        'to_user_id' => $_POST['to_user_id'],
            );

        $cancelFriendRquest = $fControl->cancelFriendRquest($data['from_user_id'], $data['to_user_id']);
        if ($cancelFriendRquest === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['exec_AcceptRequest'])) {
        $data = array(  'from_user_id' => $_POST['from_user_id'],
                        'to_user_id' => $_POST['to_user_id'],
            );

        $confirmFriendRquest = $fControl->confirmFriendRquest($data['from_user_id'], $data['to_user_id'], "friendsprofile.php?id=".$data['to_user_id']."");
        if ($confirmFriendRquest === false) {
            echo "ERROR";
        }
    }

    if (isset($_POST['exec_DeclineRequest'])) {
      $data = array(  'from_user_id' => $_POST['from_user_id'],
                      'to_user_id' => $_POST['to_user_id'],
          );

      $declineRequeset = $fControl->declineFriendRquest($data['from_user_id'], $data['to_user_id'], "friendsprofile.php?id=".$data['to_user_id']."");
      if ($declineRequeset === false) {
          echo "ERROR";
      }
    }


?>

<br >
<div class="card mb-4">
    <div class="card-header">
        <h4>User Profile</h4>
    </div>
    <div class="card-body">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="<?php echo $up->getProfilePicture($curr_user['user_id']) ?>" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <!-- <a href="#"> -->
              <h5 class="mt-0"><?php echo $curr_user['firstname'] . " " . $curr_user['middlename'] . " " . $curr_user['lastname']  ?></h5>
              <h6><?php echo $curr_user['address'] ?></h6>
            <!-- </a> -->
          </div>

          <form class="" method="post">

                <input type="hidden" name="from_user_id" value="<?php echo $user_data['user_id'] ?>">
                <input type="hidden" name="to_user_id" value="<?php echo $curr_user['user_id'] ?>">

                <?php if($fControl->isFriend($user_data['user_id'], $curr_user['user_id'])) { ?>

                        <button id="exec_Unfriend" name="exec_Unfriend" class="btn btn-sm btn-danger align-self-center float-right">
                            <span class="fas fa-trash"></span> Unfriend
                        </button>

                <?php } elseif($fControl->isRequested($user_data['user_id'], $curr_user['user_id'])) { ?>

                        <button id="exec_CancelRequest" name="exec_CancelRequest" class="btn btn-sm btn-warning align-self-center float-right">
                            <span class="fa fa-times"></span> Cancel Request
                        </button>

                <?php } elseif($fControl->hasRequested($user_data['user_id'], $curr_user['user_id'])) { ?>

                        <!-- <button id="exec_AcceptRequest" name="exec_AcceptRequest" class="btn btn-sm btn-success align-self-center float-right">
                            <span class="fa fa fa-check"></span> Accept
                        </button> -->

                        <div class="btn-group float-right" role="group">

                            <button id="exec_AcceptRequest" name="exec_AcceptRequest" class="btn btn-sm btn-success align-self-center float-right">
                                <span class="fa fa fa-check"></span> Accept
                            </button>

                            <button id="exec_DeclineRequest" name="exec_DeclineRequest" class="btn btn-sm btn-warning align-self-center float-right">
                                <span class="fa fa-times"></span> Decline
                            </button>

                        </div>

                <?php } else { ?>

                        <button id="exec_Addfriend" name="exec_Addfriend" class="btn btn-sm btn-success align-self-center float-right">
                            <span class="fa fa-user-plus"></span> Add Friend
                        </button>

                <?php } ?>


             <!-- <span class="fa fa-user-plus"></span> Add Friend -->
            </form>
        </div>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php

    if($fControl->isFriend($user_data['user_id'], $curr_user['user_id'])) {
        $getPost_Qry = "user_id =".$currentUserID . " AND (privacy != 2)";
    } else {
        $getPost_Qry = "user_id =".$currentUserID . " AND (privacy = 1)";
    }

    list($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted) = $pControl->getPosts($getPost_Qry);
    if(is_array($post_titles)) {
        for ($index = 0; $index < sizeof($post_titles); $index++) {
            $post_user = $up->getUserInformation($post_userID[$index]);
 ?>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="font-weight-bold" href="friendsprofile.php?id=<?php echo $post_userID[$index] ?>">
                        <img src="<?php echo $up->getProfilePicture($post_user['user_id']) ?>" alt="Profile Picture" class="border border-dark rounded-circle img-icon">
                        <?php echo $post_user['firstname'] . " " . $post_user['lastname'] ?>
                    </a>

                    <?php if ($post_userID[$index] == $_SESSION['id']) { ?>
                        <div class=" float-right">
                            <a href="editpost.php?id=<?php echo $post_ID[$index] ?>" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>

                            <form method="post">
                                <input type="hidden" name="post_ID_Del" value="<?php echo $post_ID[$index] ?>">
                                <input type="hidden" name="post_userID_Del" value="<?php echo $post_userID[$index] ?>">

                                <button type="submit" id="deletePost" name="deletePost" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </button>
                            </form>
                        </div>
                    <?php } ?>

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


<?php include 'includes/footer.php'; ?>
