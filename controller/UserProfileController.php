<?php
require_once('./config.php');


class UserProfileController
{
    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }


    public function getUserInformation($id)
    {
        $db = new config;
        $dbcon = $db->dbconnect();

        $qry_get_usr_info = "SELECT * FROM `users` as u INNER JOIN `user_info` as `ui` ON `ui`.`user_id`=`u`.`id` where `u`.`id`=$id";
        $res = $dbcon->query($qry_get_usr_info); // sending query

        return $res->fetch_assoc();
    }

    public function updateUserProfile($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $user_id = $data['user_id'];
        $fname = $data['firstname'];
        $lname = $data['lastname'];
        $mname = $data['middlename'];
        $sex = $data['sex'];
        $bdate =$data['bdate'];
        $address = $data['address'];
        $email = $data['email'];

        $qry = "UPDATE `user_info`
            SET `firstname`='$fname',
            `lastname`='$lname',
            `middlename`='$mname',
            `sex`='$sex',
            `bdate`='$bdate',
            `address`='$address',
            `email`='$email'
            WHERE `user_id`=$user_id";

        if ($conn->query($qry) === false) {
            return false;
        } else {
            Header('Location: manageprofile.php'); // redirect to login.php page
        }
    }

    public function getProfilePicture($userID) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT * FROM user_info WHERE user_id=$userID";
        $res = $conn->query($qry);
        $result = mysqli_fetch_array($res);

        // echo '<img src="data:image/jpeg;base64,'.base64_encode($result['picture']).'" class="img-fluid" alt="Responsive image"/>';
        // $imageHolder = '"'.'data:image/jpeg;base64,'.base64_encode($result['picture']).'"'
        $imageHolder = 'data:image/jpeg;base64,'.base64_encode($result['picture']);
        return $imageHolder;
    }

    public function updateProfilePicture($userID) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        if(isset($_POST["update_ProfilePic"]))
        {
            $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            $query = "UPDATE user_info SET picture = '$file' WHERE user_id = '$userID'";
            if ($conn->query($query) === false) {
                return false;
            } else {
                // $_POST["update_ProfilePic"] = NULL;
            }
        }
    }

    public function getPost($userID, $privacy) {
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
