<?php
require_once('./config.php');


class InfoController
{
    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }

    // getting the sexes from the database
    public function getSex()
    {
        $db = new config;
        $dbcon = $db->dbconnect();

        $qry = "SELECT * FROM sex";
        $res = $dbcon->query($qry); // sending query

        if ($res->num_rows > 0) {
            $data = $res;
            return $data;
        } else {
            return null;
        }
    }

    // getting all privacy from the database
    public function getPrivacy()
    {
        $db = new config;
        $this->$conn = $db->dbconnect();

        $qry = "SELECT * FROM privacy";
        $res = $conn->query($qry);

        if ($res->num_rows > 0) {
            $data = $res->fetch_assoc();
            return $data;
        } else {
            return null;
        }
    }
}
