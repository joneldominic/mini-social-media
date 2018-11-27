<?php
require_once('./config.php'); //include the config class Config

class AuthController
{
    public function __construct()
    {
        //checking the connection
        $db = new config;
        $db->dbconnect();
    }

    public function register($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $uname = $data['username'];
        $pass = md5($data['password']); // md5 is 32 character hex number encrytion

        $qry_insert_user = "INSERT INTO `users`(`username`, `password`) VALUES ('$uname', '$pass')"; // query string

        // check the connection if successful
        if ($conn->query($qry_insert_user) === true) {
            $user_id = $conn->insert_id;
            $fname = $data['firstname'];
            $lname = $data['lastname'];
            $mname = $data['middlename'];
            $sex = $data['sex'];
            $address = $data['address'];
            $email = $data['email'];
            $bdate =$data['bdate'];

            $qry_inset_usr_info = "INSERT INTO `user_info`(`user_id`, `firstname`, `lastname`, `middlename`, `sex`, `bdate`, `address`, `email`) VALUES ($user_id,'$fname','$lname','$mname',$sex,'$bdate', '$address', '$email')";

            // preparing rollback incase the insert user_infomation failed
            if ($conn->query($qry_inset_usr_info) === false) {
                $qry_rollback_del = "DELETE FROM `users` WHERE `id`=".$user_id;
                $conn->query($qry_rollback_del);
                return false;
            } else {
                Header('Location: login.php'); // redirect to login.php page
            }
        }

        $conn->close(); // close the connection
    }

    // defines the user sessions when loggedin
    public function user_session($data)
    {
        session_start();
        $_SESSION["id"] = $data['id'];
        $_SESSION["username"]	= $data['username'];
        $_SESSION["isloggedin"] = true;
    }


    public function login($data)
    {
        //
    $db = new config; // create config instance
    $conn = $db->dbconnect(); // getting the connection

    $uname = $data['username'];
        $pass = md5($data['password']);

        // var_dump($data);exit();

        $qry_get_user = "SELECT * FROM `users` WHERE `username`='$uname' AND `password`='$pass'";
        $user_res = $conn->query($qry_get_user);

        if ($user_res->num_rows > 0) {
            $user_info = $user_res->fetch_assoc(); // getting the array values from the query result
      $this->user_session($user_info); // calling user_session() in this class to to define sessions
      header('Location: index.php'); // redirects to index.php page
        } else {
            return false; // returning the fasle if error exist or no data result
        }

        $conn->close(); // close the connection
    }


    public function updateUserPassword($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $usrinfoid = $data['id'];

        $qry_get_usr_info = "SELECT * FROM `user_info` WHERE `id`=$usrinfoid";
        $res_user_info = $conn->query($qry_get_usr_info); // sending query
        $useraccount = $res_user_info->fetch_assoc();
        $usrid = $useraccount['user_id'];


        $qry_get_user = "SELECT * FROM `users` WHERE `id`=$usrid";
        $accountres = $conn->query($qry_get_user);


        if ($accountres->num_rows > 0) {
            $accountinfo = $accountres->fetch_assoc();
            $passfromdb = $accountinfo['password'];
            $passfromfrm = $data['oldpassword'];

            if ($passfromdb == $passfromfrm) {
                $newpass = $data['newpassword'];
                $qry = "UPDATE `users`
                SET `password`='$newpass'
                WHERE `id`=$usrid";
                $updatepass = $conn->query($qry);
                // var_dump($qry); exit();
                header("Location: profile.php?id=$usrinfoid"); // redirects to index.php page
            } else {
                return false;
            }
        } else {
            return false;
        }

        $conn->close(); // close the connection
    }
}
