<?php
session_start();
require_once('db.php');

if (isset($_POST['submit'])) {
    // Vallidate User Data
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['errors'] = '<div class="alert alert-danger" role="alert">
        Your Fields Are Required;
      </div>
      ';
    }

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Filter Email Address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'] = '<div class="alert alert-danger" role="alert">
        Invallid Email.
      </div>
      ';
    }


    // Email Match
    $selectEmail = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
    $emailExe = $conn->query($selectEmail);
    if ($emailExe->num_rows) {

        $row = $emailExe->fetch_assoc();
        $hash = $row['password'];
        if (password_verify($password, $hash)) {

            $_SESSION['LoginSuccess'] = '<div class="alert alert-success" role="alert">
                                    <span class="fw-bold">Congress..!</span> You\'r Loged In.
                                </div>
                                ';
            $_SESSION['login'] = true;
            $_SESSION['userName'] = $row['fname'];
            header("Location: welcome.php");
        } else {
            $_SESSION['errors'] = '<div class="alert alert-danger" role="alert">
        <span class="fw-bold">Oops..!</span> Password Not Match.
      </div>
      ';
        }
    } else {
        $_SESSION['errors'] = '<div class="alert alert-danger" role="alert">
        <span class="fw-bold">Invallid Email.</span> please enter vallid email address.
      </div>
      ';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Login</title>
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
                <a class="navbar-brand fw-bold" href="./index.php" style="color: #16a085; font-size: 30px;">USER MANAGEMENT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center">

                        <li class="nav-item nav-btn rounded" style="background-color: #16a085;">
                            <a class="nav-link text-light" href="#">Log in </a>
                        </li>
                        <li class="nav-item nav-btn rounded">
                            <a class="nav-link" aria-current="page" href="./index.php">Sign Up </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5" style="width: 800px;">
            <div class="bg-dark text-light d-flex justify-content-center py-5 shadow rounded">
                <div class="col-md-10">
                    <?php

                    if (isset($_SESSION['errors'])) {
                        echo $_SESSION['errors'];
                    }
                    unset($_SESSION['errors']);

                    ?>
                    <form action="" method="POST" class="m-5">

                        <div class="my-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="mt-2 btn  btn-success px-5" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>