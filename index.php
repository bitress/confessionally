<?php

    include_once 'includes/init.php';

    if (!$login->isLoggedIn()){
        header("Location: register.php");
    }

    $user = new User();
    $res = $user->getUserData(Session::get("uid"));

    $message = new Message();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home | <?= APP_NAME ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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

                <?php if (!$login->isLoggedIn()):  ?>
                <li class="nav-item"><a class="nav-link" href="#!">Login</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Register</a></li>
                <?php else: ?>

                <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Logout</a></li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Hello, <?= htmlentities($res['nickname']) ?>!</h1>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class="col-lg-4">

            <div class="card mb-4">
                <div class="card-header">Login Details</div>
                <div class="card-body">
                    <div class="alert alert-info mb-2" role="alert">
                        <strong>Username: </strong> <span><?= htmlentities($res['nickname']) ?></span> <br>
                        <strong>Passcode: </strong> <span><?= htmlentities($res['passcode']) ?></span>
                        <p class="text-muted mt-2 d-inline-block"><strong>Note!</strong> Please screenshot and save your login, there is no way to recover if forgotten.</p>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" id="user_id" value="<?= $res['user_id'] ?>">
                    <button class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#delete_account">Delete account</button>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Share this link to your friends, to receive anonymous messages.</div>
                <div class="card-body">
                        <div class="mb-3">
                            <input type="text" class="form-control mb-1" id="user_url"  onclick="copyUrl()" value="<?= htmlentities($message->generateUrl()); ?>">
                            <button class="btn btn-block btn-info" onclick="copyUrl()">Click me to copy the link!</button>
                        </div>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="row">

                <h3 class="mb-3">Anonymous Messages</h3>

                <div id="messages_cards"></div>

            </div>

        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; <?= APP_NAME ?> 2022</p></div>
</footer>



<div class="modal fade" id="delete_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>It is sad to see you go.</p>
                <p>Once you delete your account, your received secrets are permanently removed from <?= APP_NAME ?>.</p>
                <p>By clicking <strong>Delete</strong> you understand that accounts aren't recoverable.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="delete_account_modal" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script src="assets/jquery/jquery.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

</body>
</html>
