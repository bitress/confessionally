<?php

    include_once 'init.php';

    if (!empty($_POST['action'])){

        $action = $_POST['action'];

        switch ($action){
            case 'userRegister':

                $reg = new Register();

                    $stmt = $reg->userRegister($_POST['nickname']);

                    if ($stmt === true){
                        echo "true";
                    }
                break;

            case 'userLogin':

                $login = new Login();

                $stmt = $login->userLogin($_POST['nickname'], $_POST['passcode']);

                if ($stmt === true){
                    echo "true";
                }
                break;

            case 'sendMessage':

                $mes = new Message();

                $stmt = $mes->sendMessage($_POST['message'], $_POST['secret_key']);

                if ($stmt === true){
                    echo "true";
                }
                break;

            case 'getMessage':

                $mes = new Message();

                $res = $mes->getAllMessage();

                break;

            case 'deleteMessage':

                $mes = new Message();
                $res = $mes->deleteMessage($_POST['id']);

                if ($res === true){
                    echo "true";
                }

                break;

            case 'deleteAccount':

                $del = new User();

                $stmt = $del->deleteAccount($_POST['id']);

                if ($stmt === true){
                    echo 'true';
                }
            break;
            default:
                break;
        }


    }