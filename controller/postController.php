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

    public function getPosts($userID, $privacy) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM posts WHERE user_id LIKE '$userID' AND privacy!=$privacy ORDER BY date_posted DESC";
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

}
