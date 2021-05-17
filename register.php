<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎4 January, ‎2021
Date last edited: 3 March, ‎2021
-->
<!DOCTYPE html>
<?php
session_start();
include('connection/conn.php');
if (isset($_SESSION['ERRORemail_message'])) {

    echo '<script>alert("Email already exist")</script>';
    unset($_SESSION['ERRORemail_message']);
}

if (isset($_SESSION['ERRORusername_message'])) {

    echo '<script>alert("Username already exist")</script>';
    unset($_SESSION['ERRORusername_message']);
}

if (isset($_SESSION['ERRORname_message'])) {

    echo '<script>alert("Name already exist")</script>';
    unset($_SESSION['ERRORname_message']);
}

if (isset($_SESSION['ERRORphoneNumber_message'])) {

    echo '<script>alert("Phone Number already exist")</script>';
    unset($_SESSION['ERRORphoneNumber_message']);
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="icon" href="pictures/WHMAicon.png" type="image/x-icon">
    <title>Register</title>
    <style>
        .navbar .navbar-nav>li>a {
            line-height: 50px;
        }

        a {
            font-size: 24px
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>

</head>
<!-- class="form-signup" -->

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="pictures/WHMAlogo.png" alt="" width="100px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="d-flex align-items-center justify-content-center" style="width: auto;height: 700px;">
            <form action="process.php" method="POST" style="width: 400px;" class="shadow p-3 mb-5 bg-white rounded">
                <input type="hidden" name="registration_form" value="">

                <div class="text-center mb-4">

                    <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

                </div>
                <div class="form-label-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="form-control" placeholder="Name" required="" autofocus="" name="name" pattern="^[a-zA-Z]{2,}(?: [a-zA-Z]+){0,6}$" title="Integers are not allowed">
                </div>
                <br>
                <div class="form-label-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" class="form-control" placeholder="Username" required="" autofocus="" name="username">
                </div>
                <br>
                <div class="form-label-group">
                    <label for="email">Email address:</label>
                    <input type="email" id="email" class="form-control" placeholder="Email address" required="" autofocus="" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$">

                </div>
                <br>
                <div class="form-label-group">
                    <label for="phone_number">Phone number:</label>
                    <input type="text" id="phone_number" class="form-control" placeholder="Phone Number" required="" autofocus="" name="phone_number" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title="Only numbers are allowed/No spaces/Exp:0123456789">
                </div>
                <br>
                <div class="form-label-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" class="form-control" placeholder="Password" required="" name="password_confirm" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number">
                </div>
                <br>

                <div class="col text-center" >
                    <button type="submit" class="btn btn-lg btn-primary btn-block" value="Register" id="btnSubmit">Register</button>
                </div>

            </form>
        </div>
    </main>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; Copyright 2021 WHMA.com
            </span>
        </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>