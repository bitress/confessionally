<?php

include_once 'includes/init.php';

if ($login->isLoggedIn()){
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login | <?= APP_NAME ?></title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    <img src="assets/img/Confessionally.png" alt="logo" width="100">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Login to <?= APP_NAME ?></h1>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nickname">Nickname</label>
                                <input id="nickname" type="text" class="form-control" name="nickname" value="" required autofocus>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="passcode">Passcode</label>
                                </div>
                                <input id="passcode" type="password" class="form-control" name="passcode" required>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="button" id="login" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="register.php" class="text-dark">Create One</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2022 &mdash; <?= APP_NAME ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script src="js/scripts.js"></script>
</body>
</html>


