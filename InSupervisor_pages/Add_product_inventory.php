<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎26 ‎January, ‎2021
Date last edited: 16 February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}
if (isset($_SESSION['ERRORproductN_message'])) {

  echo '<script>alert("Product already exist")</script>';
  unset($_SESSION['ERRORproductN_message']);
}

if (isset($_SESSION['ERRORproductC_message'])) {

  echo '<script>alert("Product code already exist")</script>';
  unset($_SESSION['ERRORproductC_message']);
}

if (isset($_SESSION['Add_product_success'])) {

  echo '<script>alert("Product added")</script>';
  unset($_SESSION['Add_product_success']);
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
          <input type="hidden" name="add_product" value="">
          <div class="text-center mb-4">
            <h1>Add medicine</h1>
          </div>
          <label for="supplier_name">Supplier Name:</label>
          <select name="supplier_name" class="form-control" id="supplier_name" required="required">
          <option value="" disabled selected>Select supplier</option>
            <?php
            $query = "SELECT * FROM supplier";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
              while ($rows = $result->fetch_assoc()) {

            ?><option value="<?php echo $rows['id'] ?>"><?php echo $rows['name']; ?></option><?php
                                                                                            }
                                                                                          }
                                                                                              ?>

          </select>
          <br>

          <div class="form-label-group">
            <label for="product_code">Medicine Product Code:</label>
            <input type="text" id="product_code" class="form-control" required="" name="product_code">
          </div>
          <br>
          <div class="mb-3">
            <label for="product_name" class="form-label">Medicine Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name">
          </div>

          <div class="mb-3">
            <label for="product_quantity" class="form-label">Medicine Quantity:</label>
            <input type="text" class="form-control" id="product_quantity" name="product_quantity">
          </div>

          <div class="mb-3">
            <label for="product_type" class="form-label">Medicine Type:</label>
            <select name="med_type" class="form-control" id="med_type" required="required" >
            <option value="" disabled selected>Select medicine type</option>
              <option value="Tablet">Tablet</option>
              <option value="Capsules">Capsules</option>
              <option value="Liquid">Liquid</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="product_description" class="form-label">Medicine Description:</label>
            <input type="text" class="form-control" id="product_description" name="product_description">
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