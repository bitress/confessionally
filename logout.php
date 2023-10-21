<?php

    include_once "includes/init.php";

    Session::del("isLoggedIn");
    Session::del("secretKey");
    Session::del("uid");

    session_destroy();

    header("Location: register.php");
