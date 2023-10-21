<?php

class Message
{

    /**
     * @var Database
     */
    private $db;
    /**
     * @var User
     */
    private $user;


    public function __construct(){
        $this->db = Database::getInstance();
        $this->user = new User();

    }

    /**
     * Get all secret messages
     * @return void
     */
    public function getAllMessage(){
        $id = Session::get("uid");

        $sql = "SELECT * FROM `message` WHERE `user_id` = :uid ORDER BY date_created DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":uid", $id);
        if ($stmt->execute()) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {

                $output = "";

                foreach ($res as $row) {

                    $output .= '<div class="col-sm-12">';
                    $output .= '<div class="card mb-4">';
                    $output .= '<div class="card-body">';
                    $output .= '<div class="small text-muted">' . date("l jS \of F Y", strtotime($row["date_created"])) . '</div>';
                    $output .= ' <p class="card-text">' . htmlentities($row["message"]) . '</p>';
                    $output .='<a href="#" class="btn btn-sm btn-danger float-end delete_message" data-id="' . $row['message_id'] . '"><i class="fa fa-trash"></i></a>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';

                }

            } else {

                $output = '<div class="col-sm-12">';
                $output .= '<div class="card mb-4">';
                $output .= '<div class="card-body">';
                $output .= ' <p class="card-text">Nothing to show here yet, send your link to your friends to get secret messages.</p>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';

            }

            echo $output;


        }

    }

    /**
     * Send message to a user
     * @param $message Secret Message
     * @param $secretKey Secret Key of the receiver
     * @return bool|void
     */
    public function sendMessage($message, $secretKey){

        $message = trim($message);
        $user_id = $this->user->getUserId($secretKey);
        $ip = $this->getUserIpAddr();

        $sql = "INSERT INTO `message` (user_id, message, ip_address) VALUES (:uid, :message, :ip)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":uid", $user_id);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":ip", $ip);
        if ($stmt->execute()){
            return true;
        }

    }

    /**
     * Delete a message
     * @param $id Message id
     * @return bool|void
     */
    public function deleteMessage($id){

        try {

            $sql = "DELETE FROM message WHERE message_id = :msg_id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":msg_id", $id, PDO::PARAM_INT);
            if ($stmt->execute()){
                return true;
            }

        } catch (Exception $e){
            echo "Error: ". $e->getMessage();
        }

    }

    /**
     * Generate a url for the message
     * @return string
     */
    public function generateUrl(){

        $id = Session::get("uid");

        $res = $this->user->getUserData($id);

        return BASE_URL . "message.php?id=". $res['secret_key'];

    }

    /**
     * Get user's ip address
     * @return mixed
     */
    private function getUserIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


}