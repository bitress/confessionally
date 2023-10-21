<?php

include_once 'includes/init.php';

    if ($login->isLoggedIn()){
        header("Location: index.php");
    }

    if (!isset($_GET['id'])){
        header("Location: register.php");
    }

    $user = new User();

    if ($user->checkSecretKey($_GET['id'])){

        $id = $user->getUserId($_GET['id']);
        $res = $user->getUserData($id);

    } else {
        header("Location: register.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Send an anonymous message to <?= $res['nickname'] ?> | <?= APP_NAME ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href=""><?= APP_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>

                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Send a message to <?= htmlentities($res['nickname']) ?>!</h1>
            <p class="lead mb-0">Fess up your feelings and secret to your friend.</p>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class="col-lg-12">

            <div class="row justify-content-center">

                <div class="card w-75 my-4">
                    <div class="card-body">

                            <input type="hidden" id="secret_key" value="<?= htmlentities($res['secret_key']) ?>">
                            <textarea class="form-control" id="message" rows="4" placeholder="Send an anonymous message ..."></textarea>
                            <div class="input-group">
                                <button class="btn btn-primary btn-block mt-2" type="button" id="send_message">Send message</button>
                            </div>


                    </div>
                </div>

            </div>



        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; <?= APP_NAME ?> 2022</p></div>
</footer>

<!-- Bootstrap core JS-->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
