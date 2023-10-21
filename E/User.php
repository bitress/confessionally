<?php

class User
{

    /**
     * @var Database
     */
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Get the user's id
     * @param $secretKey User's secret key
     * @return mixed
     */
    public function getUserId($secretKey){

        $sql = "SELECT * FROM `users` WHERE `secret_key` = :sk";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":sk", $secretKey, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['user_id'];

    }

    /**
     * Fetch user's data using id
     * @param $id User's id
     * @return mixed|void
     */
    public function getUserData($id){

        try {

            $sql = "SELECT * FROM `users` WHERE `users`.`user_id` = :uid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":uid", $id, PDO::PARAM_INT);

        } catch (Exception $e){
            echo "Error: " . $e;
        }

        if ($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }

    /**
     * Validate the user's secretkey
     * @param $secret_key user's secret key
     * @return bool|void
     */
    public function checkSecretKey($secret_key){


        $sql = "SELECT * FROM `users` WHERE `secret_key` = :sk";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":sk", $secret_key, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1){
            return true;
        }

    }

    /**
     * Delete user's account
     * @param $id user's id
     * @return bool|void
     */
    public function deleteAccount($id){

        $sql_account = "DELETE FROM `users` WHERE user_id = :uid";
        $sql_messages = "DELETE FROM `message` WHERE user_id = :uid";

        $stmt = $this->db->prepare($sql_account);
        $stmt->bindParam(":uid", $id);
        if ($stmt->execute()){

            $stmt = $this->db->prepare($sql_messages);
            $stmt->bindParam(":uid", $id);

            if ($stmt->execute()){

                Session::del("isLoggedIn");
                Session::del("secretKey");
                Session::del("uid");

                session_destroy();

                return true;
            }

        }

    }


}