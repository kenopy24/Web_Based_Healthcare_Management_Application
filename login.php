<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎4 January, ‎2021
Date last edited: 3 March, ‎2021
-->
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connection/conn.php');
if (isset($_SESSION['reg_message'])) {

  echo '<script>alert("Registration successful")</script>';
  unset($_SESSION['reg_message']);
}
if (isset($_SESSION['updatePass_message'])) {

  echo '<script>alert("Password updated")</script>';
  unset($_SESSION['updatePass_message']);
}

if (isset($_SESSION['error_login_message'])) {

  echo '<script>alert("Incorrect username/password")</script>';
  unset($_SESSION['error_login_message']);
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="icon" href="pictures/WHMAicon.png" type="image/x-icon">
  <title>Sign In</title>
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
      <form action="process.php" method="POST" class="shadow p-3 mb-5 bg-white rounded" style="width: 350px;">
        <input type="hidden" name="login_form" value="">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
        </div>
        <div class="form-label-group">
          <label for="inputUsername">Username:</label>
          <input type="text" name="username" class="form-control" placeholder="username" required="" autofocus="" style="width: 300px;">
        </div>
        <br>
        <div class="form-label-group">
          <label for="inputPassword">Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required="" style="width: 300px;">
        </div>
        <br>
        <a href="forgot.php" style="font-size: 15px;">Forgot password</a>
        <br>
        <a href="register.php" style="font-size: 15px;">New User?</a>
        <br>
        <br>
        <div class="col text-center">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>


</html>