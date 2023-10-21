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
    <meta name="description" content="Fess up your feelings and secrets to your friend. ">
    <title>Create Link | <?= APP_NAME ?></title>


    <meta property="og:description" content="Fess up your feelings and secrets to your friend. ">
    <meta property="og:title" content="Create Link | <?= APP_NAME ?>" />
    <meta property="og:url" content="https://www.confessionally.xyz/register.php" />
    <meta property="og:image" content="assets/img/Confessionally.png" />
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
                        <h1 class="fs-4 card-title fw-bold mb-4">Register to <?= APP_NAME ?></h1>

                        <div class="alert alert-info" role="alert">
                            Fess up your feelings and secrets to your friend.
                        </div>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nickname">Nickname</label>
                                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Enter you nickname" value="" required autofocus>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="button" id="register" class="btn btn-primary ms-auto">
                                    Create your link
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Already have one? <a href="login.php" class="text-dark">Login</a>
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


