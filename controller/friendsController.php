<?php
require_once('./config.php');


class FriendsController
{
    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }

    public function getFriends($userID) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM `user_friends` WHERE `user_id_1`= '$userID' OR `user_id_2` = $userID";
        $res = $conn->query($qry);

        $friendsID = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                if($userID != $row['user_id_2']) {
                    //Problem with assignment
                    array_push($friendsID, $row['user_id_2']);
                } else {
                    array_push($friendsID, $row['user_id_1']);
                }
            }

            $conn->close();
            return $friendsID;
        } else {
            $conn->close();
            return null;
        }
    }

    public function getRequests($userID) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM `friend_requests` WHERE `to_user_id`=$userID";
        $res = $conn->query($qry);

        $requestID = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($requestID, $row['from_user_id']);
            }

            $conn->close();
            return $requestID;
        } else {
            $conn->close();
            return null;
        }
    }

    public function isFriend($userID_1, $userID_2){
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM `user_friends` WHERE (`user_id_1`= '$userID_1' AND `user_id_2` = '$userID_2') OR (`user_id_1`= '$userID_2' AND `user_id_2` = '$userID_1')";
        $res = $conn->query($qry);

        if ($res->num_rows > 0) {

            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function isRequested($from_user_id, $to_user_id){
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM `friend_requests` WHERE `from_user_id`= '$from_user_id' AND `to_user_id`='$to_user_id'";
        $res = $conn->query($qry);

        if ($res->num_rows > 0) {

            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function hasRequested($from_user_id, $to_user_id){
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM `friend_requests` WHERE `from_user_id`= '$to_user_id' AND `to_user_id`='$from_user_id'";
        $res = $conn->query($qry);

        if ($res->num_rows > 0) {

            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function addFriendRquest($from_user_id, $to_user_id)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection


        $qry = "INSERT INTO `friend_requests`(`from_user_id`, `to_user_id`) VALUES ('$from_user_id', $to_user_id)"; // query string

        // check the connection if successful
        if ($conn->query($qry) === true) {
            Header("Location: friendsprofile.php?id=$to_user_id");
             // printf("Query failed: %s\n", $conn->error);
        } else {
            Header('Location: dberror.php');
            printf("Query failed: %s\n", $conn->error);
        }

        $conn->close(); // close the connection
    }

    public function confirmFriendRquest($from_user_id, $to_user_id, $Location)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry_delRequest = "DELETE FROM `friend_requests` WHERE (`from_user_id`='$to_user_id' AND `to_user_id`='$from_user_id') OR (`from_user_id`='$from_user_id' AND `to_user_id`='$to_user_id')";

        if ($conn->query($qry_delRequest) === true) {

            $qry_confirmRequest = "INSERT INTO `user_friends`(`user_id_1`, `user_id_2`) VALUES ($from_user_id,$to_user_id)";

            if ($conn->query($qry_confirmRequest) === true) {
                Header("Location: $Location");
                 // printf("Query failed: %s\n", $conn->error);
            } else {

                $qry_rollbackRequest = "INSERT INTO `friend_requests`(`from_user_id`, `to_user_id`) VALUES ('$from_user_id', $to_user_id)"; // query string
                printf("Query failed: %s\n", $conn->error);

                if ($conn->query($qry_confirmRequest) === true) {
                    Header('Location: dberror.php');
                } else {
                    Header('Location: dberror.php');
                    printf("Query failed: %s\n", $conn->error);
                }
            }

        } else {
            Header('Location: dberror.php');
            printf("Query failed: %s\n", $conn->error);

        }

        $conn->close(); // close the connection
    }

    public function cancelFriendRquest($from_user_id, $to_user_id) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "DELETE FROM `friend_requests` WHERE `from_user_id`='$from_user_id' AND `to_user_id`='$to_user_id'";

        if ($conn->query($qry) === true) {
            Header("Location: friendsprofile.php?id=$to_user_id");

        } else {
            Header('Location: dberror.php');
        }

        $conn->close();
    }

    public function declineFriendRquest($user_id_A, $user_id_B, $Location) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "DELETE FROM `friend_requests` WHERE `from_user_id`='$user_id_B' AND `to_user_id`='$user_id_A'";

        if ($conn->query($qry) === true) {
            Header("Location: $Location");
            // Header("Location: friendsprofile.php?id=$to_user_id");

        } else {
            Header('Location: dberror.php');
        }

        $conn->close();
    }

    public function unfriend($userID_1, $userID_2, $Location) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "DELETE FROM `user_friends` WHERE (`user_id_1`='$userID_1' AND `user_id_2`='$userID_2') OR (`user_id_1`='$userID_2' AND `user_id_2`='$userID_1')";

        if ($conn->query($qry) === true) {
            Header("Location: $Location");
            // Header("Location: friendsprofile.php?id=$userID_2");

        } else {
            Header('Location: dberror.php');
            printf("Query failed: %s\n", $conn->error);

        }

        $conn->close();
    }



    // public function getPosts($userID, $privacy_condition) {
    // public function getPosts($query_condition) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     // $qry = "SELECT * FROM posts WHERE user_id LIKE '$userID' AND privacy=1 OR privacy=2 ORDER BY date_posted DESC";
    //     $qry = "SELECT * FROM posts WHERE $query_condition ORDER BY date_posted DESC";
    //     $res = $conn->query($qry);
    //
    //     $post_ID = array();
    //     $post_userID = array();
    //     $post_titles = array();
    //     $post_contents = array();
    //     $post_datePosted = array();
    //
    //     if ($res->num_rows > 0) {
    //         while ($row = $res->fetch_assoc()) {
    //             array_push($post_ID, $row['id']);
    //             array_push($post_userID, $row['user_id']);
    //             array_push($post_titles, $row['title']);
    //             array_push($post_contents, $row['content']);
    //             array_push($post_datePosted, $row['date_posted']);
    //         }
    //
    //         $conn->close();
    //         return array($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted);
    //     } else {
    //         $conn->close();
    //         return null;
    //     }
    // }
    //
    // // public function getPosts($userID, $privacy_condition) {
    // public function getSinglePost($postID) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $qry = "SELECT * FROM posts WHERE id='$postID'";
    //     $res = $conn->query($qry);
    //
    //     if ($res->num_rows > 0) {
    //         $data = $res->fetch_assoc();
    //         return $data;
    //     } else {
    //         return null;
    //     }
    // }
    //
    // public function addPost($data)
    // {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $user_id = $data['user_id'];
    //     $post_title = $data['post_title'];
    //     $post_content = $data['post_content'];
    //     $post_privacy = $data['$post_privacy'];
    //
    //
    //     $qry_add_post = "INSERT INTO `posts`(`user_id`, `title`, `content`, `privacy`) VALUES ('$user_id','$post_title','$post_content', '$post_privacy')"; // query string
    //
    //     // check the connection if successful
    //     if ($conn->query($qry_add_post) === true) {
    //
    //     }
    //
    //     $conn->close(); // close the connection
    // }
    //
    // public function deletePost($data, $Location) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $post_ID = $data['post_ID'];
    //     $post_userID = $data['post_userID'];
    //
    //     $qry_delete_post =  "DELETE FROM posts WHERE id='$post_ID' AND user_id='$post_userID'";
    //     $qry_delete_postComments = "DELETE FROM comments WHERE post_id='$post_ID' AND user_id='$post_userID'";
    //
    //     if ($conn->query($qry_delete_post) === true) {
    //         if($conn->query($qry_delete_postComments) === true) {
    //             Header("Location: ". $Location ."");
    //         } else {
    //             Header('Location: dberror.php');
    //         }
    //     } else {
    //         Header('Location: dberror.php');
    //     }
    //
    //     $conn->close();
    // }
    //
    // public function updatePost($data, $Location)
    // {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $post_ID = $data['post_ID'];
    //     $post_title = $data['post_title'];
    //     $post_content = $data['post_content'];
    //     $post_privacy = $data['post_privacy'];
    //
    //     $qry_update_post = "UPDATE `posts`
    //                         SET `title`='$post_title',
    //                             `content`='$post_content',
    //                             `privacy`=$post_privacy
    //                         WHERE `id` = $post_ID";
    //
    //
    //     // check the connection if successful
    //     if ($conn->query($qry_update_post) === true) {
    //         Header("Location: ". $Location ."");
    //     } else {
    //         // Header('Location: dberror.php');
    //     }
    //
    //     $conn->close(); // close the connection
    // }
    //
    // public function addComment($data) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $postID_comment = $data['postID_comment'];
    //     $postUserID_comment = $data['postUserID_comment'];
    //     $postContent_comment = $data['postContent_comment'];
    //
    //     $qry_add_comment = "INSERT INTO `comments` (`post_id`, `user_id`, `content`) VALUES ('$postID_comment', '$postUserID_comment', '$postContent_comment')";
    //
    //     // check the connection if successful
    //     if ($conn->query($qry_add_comment) === true) {
    //         Header("Location: viewpost.php?id=$postID_comment");
    //     }
    //
    //     $conn->close(); // close the connection
    // }
    //
    // public function getComments($postID) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     // $qry = "SELECT * FROM posts WHERE user_id LIKE '$userID' AND privacy=1 OR privacy=2 ORDER BY date_posted DESC";
    //     // $qry = "SELECT * FROM comments WHERE `post_id`=$postID ORDER BY `date_posted` DESC";
    //     $qry_getComments = "SELECT * FROM comments WHERE `post_id`=$postID ORDER BY `date_posted` DESC";
    //
    //     $res = $conn->query($qry_getComments);
    //
    //     $comment_ID = array();
    //     $comment_userID = array();
    //     $comment_contents = array();
    //     $comment_datePosted = array();
    //
    //     if ($res->num_rows > 0) {
    //         while ($row = $res->fetch_assoc()) {
    //             array_push($comment_ID, $row['id']);
    //             array_push($comment_userID, $row['user_id']);
    //             array_push($comment_contents, $row['content']);
    //             array_push($comment_datePosted, $row['date_posted']);
    //         }
    //
    //         $conn->close();
    //         return array($comment_ID, $comment_userID, $comment_contents, $comment_datePosted);
    //     } else {
    //         $conn->close();
    //         // printf("Query failed: %s\n", $conn->error);
    //         return null;
    //     }
    // }
    //
    // public function deletePostComment($commentID, $Location) {
    //     $db = new config; // create config instance
    //     $conn = $db->dbconnect(); // getting the connection
    //
    //     $qry_delete_postComments = "DELETE FROM comments WHERE id='$commentID'";
    //
    //     if ($conn->query($qry_delete_postComments) === true) {
    //         if($conn->query($qry_delete_postComments) === true) {
    //             Header("Location: ". $Location ."");
    //         } else {
    //             Header('Location: dberror.php');
    //         }
    //     } else {
    //         Header('Location: dberror.php');
    //         // printf("Query failed: %s\n", $conn->error);
    //     }
    //
    //     $conn->close();
    // }


}
