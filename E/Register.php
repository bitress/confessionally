<?php

class Register
{

    /**
     * @var Database
     */
    private $db;
    /**
     * @var Login
     */
    private $login;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->login = new Login();
    }


    /**
     * Register user
     * @param string $nickname User nickname
     */
    public function userRegister($nickname){

        $nickname = trim($nickname);
        $secretKey = $this->generateSecretKey();
        $passCode = $this->generatePinCode();


        try {

            if ($this->checkUsername($nickname)){
                echo "Nickname is taken. Please choose another!";
                return false;
            }

            $sql = "INSERT INTO `users` (`nickname`, `secret_key`, `passcode`) VALUES (:nickname, :secret_key, :passcode)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":nickname", $nickname);
            $stmt->bindParam(":secret_key", $secretKey);
            $stmt->bindParam(":passcode", $passCode);

            if ($stmt->execute()){

                    $last_id = $this->db->lastInsertId(); // get user id

                    $this->login->logInUser($last_id);

                return true;
            }

        } catch (Exception $e){
            echo "Error: " . $e;
        }


    }

    /**
     * Generate user key for the url
     * @return string User secret key

     */
    private function generateSecretKey(){

        try {

            if (function_exists("random_bytes")) {
                $bytes = random_bytes(ceil(7 / 2));
            } elseif (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes(ceil(7 / 2));
            }

        } catch (Exception $e){
           echo ("no cryptographically secure random function available");
        }

        return substr(bin2hex($bytes), 0, 7);
    }

    /**
     * Generate 4 digit pin
     * @return int generated 4 digit pin
     */
    private function generatePinCode(){
        return rand(pow(10, 6 -1), pow(10, 6)-1);
    }

    /**
     * Check username if it exists or not
     * @param $username
     * @return void
     */
    public function checkUsername($username){

        try {

            $sql = "SELECT * FROM `users` WHERE `nickname` = :u LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":u", $username, PDO::PARAM_STR);
            if ($stmt->execute()){

                if ($stmt->rowCount() > 0){
                    return true;
                }
            }

        } catch (Exception $e){
            echo "Error: ". $e->getMessage();
        }

    }

}