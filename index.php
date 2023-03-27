<?php

session_start();
require_once('db.php');


// Get Submit Data
if (isset($_POST['submit'])) {

    // Vallidate User Data
    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['cpassword'])) {
        $_SESSION['fieldsRequired'] = '<div class="alert alert-danger" role="alert">
        Your Fields Are Required;
      </div>
      ';
    }

    $fname = htmlspecialchars($_POST['fname']) ;
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $cpassword = htmlspecialchars($_POST['cpassword']);


    // Password And Confirm Password Match Check
    if ($password != $cpassword) {
        $_SESSION['fieldsRequired'] = '<div class="alert alert-danger" role="alert">
        Oops!   Your Password Not Match
      </div>
      ';
    }

    // Password Hash
    $hash = password_hash($cpassword, PASSWORD_DEFAULT);


    // Filter Email Address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['submitError'] = '<div class="alert alert-danger" role="alert">
        Invallid Email.
      </div>
      ';
    }


    $query = "INSERT INTO user(fname, lname, email, password) VALUES ('$fname','$lname','$email','$hash')";
    // echo $query;


    if($qExe = $conn->query($query)){
        $_SESSION['submitSuccess'] = '<div class="alert alert-success" role="alert">
        Registration Successfully Submited...!
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
    <title>Registration Students</title>

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
                        <li class="nav-item nav-btn rounded">
                            <a class="nav-link" aria-current="page" href="login.php">Log in </a>
                        </li>
                        <li class="nav-item nav-btn rounded" style="background-color: #16a085;">
                            <a class="nav-link text-light" href="add.php"> Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5" style="width: 800px;">
            <div class="d-flex justify-content-center py-5 shadow rounded">
                <div class="col-md-10">
                    <?php

                    if (isset($_SESSION['submitError'])) {
                        echo $_SESSION['submitError'];
                    }
                    unset($_SESSION['submitError']);

                    if (isset($_SESSION['submitSuccess'])) {
                        echo $_SESSION['submitSuccess'];
                    }
                    unset($_SESSION['submitSuccess']);

                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Your First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Your Last Name" required>
                            </div>
                        </div>


                        <div class="my-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cpassword" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" required>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn  btn-success px-5" value="Submit">
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>