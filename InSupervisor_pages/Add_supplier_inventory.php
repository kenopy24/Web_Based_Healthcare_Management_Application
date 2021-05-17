<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎26 ‎January, ‎2021
Date last edited: 21 February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}
if (isset($_SESSION['ERRORsupplierName_message'])) {

  echo '<script>alert("Supplier name already exist")</script>';
  unset($_SESSION['ERRORsupplierName_message']);
}

if (isset($_SESSION['ERRORSupplieraddress_message'])) {

  echo '<script>alert("Supplier address already exist")</script>';
  unset($_SESSION['ERRORSupplieraddress_message']);
}

if (isset($_SESSION['ERRORSupplierphone_message'])) {

  echo '<script>alert("Supplier phone number already exist")</script>';
  unset($_SESSION['ERRORSupplierphone_message']);
}

if (isset($_SESSION['ERRORSupplieremail_message'])) {

  echo '<script>alert("Supplier email already exist")</script>';
  unset($_SESSION['ERRORSupplieremail_message']);
}

if (isset($_SESSION['Add_supplier_success'])) {

  echo '<script>alert("Supplier added")</script>';
  unset($_SESSION['Add_supplier_success']);
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../pictures/WHMAicon.png" type="image/x-icon">

  <title>Add product</title>
  <style>

  </style>
</head>

<body>

  <?php
  include_once('../Navbars/InvSNavbar.php');
  ?>
  <main>
    <div class="mx-auto" style="width: 500px;">
      <div class="shadow p-3 mb-5 bg-white rounded" style="width: 500px;">
        <form action="../process.php" method="POST">
          <input type="hidden" name="add_supplier" value="">
          <div class="text-center mb-4">
            <h1>Add supplier</h1>
          </div>
          <div class="form-label-group">
            <label for="text">Supplier Name:</label>
            <input type="text" id="supplier_name" class="form-control" required="" name="supplier_name">
          </div>

          <br>

          <div class="form-label-group">
            <label for="supplier_address">Supplier Address:</label>
            <input type="text" id="supplier_address" class="form-control" required="" name="supplier_address">
          </div>
          <br>
          <div class="mb-3">
            <label for="supplier_email" class="form-label">Supplier Email:</label>
            <input type="email" class="form-control" id="supplier_email" name="supplier_email" required="" >
          </div>

          <div class="mb-3">
            <label for="supplier_phone_number" class="form-label">Supplier Phone number:</label>
            <input type="text" class="form-control" id="supplier_phone_number" name="supplier_phone_number" required="" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title="Only numbers are allowed/No spaces/Exp:0123456789">
          </div>
          <br>
          <div class="wrapper col text-center" >
            <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </form>
      </div>
    </div>

  </main>

</body>

</html>