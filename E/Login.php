<?php

class Login
{

    /**
     * @var Database
     */
    private $db;
    /**
     * @var User
     */
    private $user;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->user = new User();

    }

    /**
     * Checked if user is logged in
     * @return bool|void
     */
    public function isLoggedIn(){

        if (Session::check("isLoggedIn")){
            return true;
        }

    }

    /**
     * Login the uer
     * @param $nickname user's chosen nickname
     * @param $passCode user's passcode
     * @return bool|void
     */
    public function userLogin($nickname, $passCode){

        $sql = "SELECT * FROM `users` WHERE `nickname` = :nickname LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nickname", $nickname, PDO::PARAM_STR);
        if ($stmt->execute()){

            $row = $stmt->fetch();

            if ($stmt->rowCount() > 0) {

                if ($passCode == $row['passcode']) {
                    //passcode is correct

                    $this->logInUser($row['user_id']);

                    return true;

                } else {
                    echo "Passcode is incorrect";
                }

            } else {
                echo "No username found";
            }

        } else {
            echo "Error: Something went wrong!";
        }

    }

    /**
     * Log in the user
     * @param int $id User ID
     * @return void Set the session
     */
    public function logInUser($id){

        $user = $this->user->getUserData($id);

        Session::set("isLoggedIn", true);
        Session::set("secretKey", $user['secret_key']);
        Session::set("uid", $id);

    }
}

