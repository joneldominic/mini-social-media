<?php
require_once('./config.php');


class PostController
{
    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }

    // public function getPosts($userID, $privacy_condition) {
    public function getPosts($query_condition) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        // $qry = "SELECT * FROM posts WHERE user_id LIKE '$userID' AND privacy=1 OR privacy=2 ORDER BY date_posted DESC";
        $qry = "SELECT * FROM posts WHERE $query_condition ORDER BY date_posted DESC";
        $res = $conn->query($qry);

        $post_ID = array();
        $post_userID = array();
        $post_titles = array();
        $post_contents = array();
        $post_datePosted = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($post_ID, $row['id']);
                array_push($post_userID, $row['user_id']);
                array_push($post_titles, $row['title']);
                array_push($post_contents, $row['content']);
                array_push($post_datePosted, $row['date_posted']);
            }

            $conn->close();
            return array($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted);
        } else {
            $conn->close();
            return null;
        }
    }

    public function addPost($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $user_id = $data['user_id'];
        $post_title = $data['post_title'];
        $post_content = $data['post_content'];
        $post_privacy = $data['$post_privacy'];


        $qry_add_post = "INSERT INTO `posts`(`user_id`, `title`, `content`, `privacy`) VALUES ('$user_id','$post_title','$post_content', '$post_privacy')"; // query string

        // check the connection if successful
        if ($conn->query($qry_add_post) === true) {
            Header('Location: index.php');
        }

        $conn->close(); // close the connection
    }


}
