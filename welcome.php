<?php
session_start();
if ($_SESSION['login'] != true) {
    header('Location: login.php');
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Welcome</title>
    <style>
        .nav-btn {
            border: 1px solid gray;
            margin: 0 10px;
            padding: 0px 20px;
            color: black;
            font-weight: 600;
            text-transform: uppercase;
        }

        .nav-btn:hover {
            background-color: #16a085;
            transition: all 1s;
            border: 1px solid #16a085;
        }

        .nav-btn:hover>a {

            color: white !important;
        }

        td,
        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container pt-4">
        <nav class="navbar navbar-expand-lg  m-0">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-uppercase" href="./index.php" style="color: #16a085; font-size: 25px;">Welcome, <?php echo $_SESSION['userName'] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center">

                        <li class="nav-item nav-btn rounded" style="background-color: #16a085;">
                            <a class="nav-link text-light" href="logout.php">Log Out </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci dolorum animi doloribus eveniet atque perferendis placeat veniam libero neque, sint quibusdam expedita esse omnis assumenda exercitationem sed, beatae minima ut.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci dolorum animi doloribus eveniet atque perferendis placeat veniam libero neque, sint quibusdam expedita esse omnis assumenda exercitationem sed, beatae minima ut.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci dolorum animi doloribus eveniet atque perferendis placeat veniam libero neque, sint quibusdam expedita esse omnis assumenda exercitationem sed, beatae minima ut.</p>
        </div>

    </div>





</body>

</html>