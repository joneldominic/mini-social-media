<?php

include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
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
        <form class="" action="index.html" method="post">
            <div class="form-group">
                <label for="post_title">Title</label>
                <input type="text" class="form-control" id="post_title" placeholder="Example input">
            </div>
            <div class="form-group">
                <label for="post_content">Content</label>
                <textarea class="form-control" id="post_content" rows="3"></textarea>
            </div>
            <button href="#" class="btn btn-secondary float-right">
                <span class="fas fa-share"></span> Share
            </button>
        </form>


    </div>
    <div class="card-footer text-muted">
        <small>
            Date Today!
        </small>
    </div>
</div>

<!-- Posts -->
<?php
    list($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted) = $up->getPost('%', 2);
    // print_r($post_userID);
    // print_r($post_titles);
    // print_r($post_contents);

    // $post_user = $up->getUserInformation($post_userID[0]);
    // echo "<br />" .  $post_user['firstname'] . "<br /><br /><hr />";
    //
    // echo $post_userID[0] . "<br />" . $post_titles[0] . "<br />" . $post_contents[0];


    for($index = 0; $index < sizeof($post_titles); $index++) {

        $post_user = $up->getUserInformation($post_userID[$index]);

        echo "".
                '<div class="card mb-4">' .
                    '<div class="card-header">' .
                        '<a class="font-weight-bold" href="#">' .
                            '<img src="' . $up->getProfilePicture($post_user['user_id']) . '" alt="..." class="border border-dark rounded-circle img-icon">' .
                            " " . $post_user['firstname'] . " " . $post_user['lastname'] .
                        '</a>'
            ."";
                        if($post_userID[$index] == $_SESSION['id']) {
                            echo "" .
                                '<div class=" float-right">' .
                                    '<a href="editpost.php?id=postID" class="btn btn-sm btn-info "> <span class="fas fa-pen"></span> </a>' .
                                    '<a href="#" class="btn btn-sm btn-danger "> <span class="fas fa-trash"></span> </a>' .
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



<!-- Blog Post -->
<!--
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
        <a href="viewpost.php?id=postIDhere">
            <h3 class="card-title">This is your POst</h3>
        </a>
        <p class="card-text">You can edit and update your post. Post home (index.php) should be sort by date, from latest to oldest</p>
        <a href="viewpost.php?id=postIDhere" class="btn btn-secondary float-right">
            <span class="fas fa-comment-alt"></span> Comment
        </a>
    </div>
    <div class="card-footer text-muted">
        <small>
            Posted on January 1, 2017 by
        </small>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <a class="font-weight-bold" href="#">
            <img src="./images/dp.jpg" alt="..." class="border border-dark rounded-circle img-icon">
            Others User Account
        </a>
    </div>
    <div class="card-body">
        <a href="viewpost.php?id=postIDhere">
            <h3 class="card-title">Other User Post</h3>
        </a>
        <p class="card-text">This is sample post from users who's post is set to public/friends only</p>
        <a href="viewpost.php?id=postIDhere" class="btn btn-secondary float-right">
            <span class="fas fa-comment-alt"></span> Comment
        </a>
    </div>
    <div class="card-footer text-muted">
        <small>
            Posted on January 1, 2017 by
        </small>
    </div>
</div>
-->

<?php include 'includes/footer.php'; // include the footer; footer.php is a file where the nav bar is located
?>