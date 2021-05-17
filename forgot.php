<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎8 February, ‎2021
Date last edited: 8 February, ‎2021
-->
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connection/conn.php');

if (isset($_SESSION['email_check'])) {

    echo'<script>alert("The email does not link to any user")</script>';
    unset($_SESSION['email_check']);
  }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="icon" href="pictures/WHMAicon.png" type="image/x-icon">
    <title>Forgot password</title>
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

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
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
            <form action="process.php" method="POST" class="shadow p-3 mb-5 bg-white rounded" style="width: 350px;">
                <input type="hidden" name="forgot_form" value="">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Forgot password</h1>
                </div>
                <div class="form-label-group">
                    <label for="inputUsername">Email:</label>
                    <br>
                    <input type="email" name="email" class="form-control" placeholder="email" required="" autofocus="" style="width: 300px;">
                </div>
                <br>
                <div class="col text-center">
                    <button class="btn  btn-primary btn-block" type="submit"  value="Send Email">Submit</button>
                </div>
            </form>
        </div>
        <?php
            if(isset($_SESSION["email"]) && isset($_SESSION["token"])) {
                
                echo'<input type="hidden" id="email" value="'.$_SESSION["email"].'">';
                echo'<input type="hidden" id="token" value="'.$_SESSION["token"].'">';
                unset($_SESSION['email']);
                unset($_SESSION['token']);
            }
        ?>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; Copyright 2021 WHMA.com
            </span>
        </div>
    </footer>


    <script src="https://smtpjs.com/v3/smtp.js">
    </script>
    <script>
        
        var email = document.getElementById("email").value;
        var token = document.getElementById("token").value;
        
        sendEmail(email,token);

        function sendEmail(email,token) {
            Email.send({
                Host : "smtp.gmail.com",
                Username : "whmsmed@gmail.com",
                Password : "medicalstonks",
                To: email,
                From: "whmsmed@gmail.com",
                Subject: "Reset password",
                Body: `A request has been received to change the password for your WHMA account.<br> <a href="localhost/Web_Based_Healthcare_Management_Application/reset.php?token=${token}">Click here to reset</a>`
            }).then(
                message => alert("mail has been sent sucessfully")
            );
        }

        
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>


</html>