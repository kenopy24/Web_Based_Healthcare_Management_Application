<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎29 February, ‎2021
Date last edited: 25 February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}

if (isset($_SESSION['edit_suppliers'])) {

  echo '<script>alert("Supplier updated")</script>';
  unset($_SESSION['edit_suppliers']);
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

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../pictures/WHMAicon.png" type="image/x-icon">

  <title>View Suppliers</title>
  <style>

  </style>
</head>

<body>


  <?php
  include_once('../Navbars/InvSNavbar.php');
  ?>

  <main>
    <div class="d-flex align-items-center justify-content-between">

      <div class="p-2 bd-highlight col-example">
        <h1>Suppliers Lists</h1>
      </div>
      <div class="p-2 bd-highlight col-example">
        <form class="d-flex" method="POST">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" <?php
              if (!empty($_POST['search'])) {
                echo "value='" . $_POST['search'] . "'";
              }
              ?> name="search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

    </div>
    <?php
    echo '
    <div class = "table-responsive">
      
  ';
    if (!empty($_POST['search'])) {

      $search = $_POST['search'];

      $query2 = "SELECT * FROM supplier WHERE name = '$search'";

      $result2 = $db->query($query2);
      if ($result2->num_rows > 0) {

        $num = 1;
        echo '
          <div class = "table-responsive">
          <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        ';
        while ($row2 = $result2->fetch_assoc()) {

          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td id="name' . $row2['id'] . '">' . $row2['name'] . '</td>';
          echo '<td id="address' . $row2['id'] . '">' . $row2['address'] . '</td>';
          echo '<td id="phone' . $row2['id'] . '">' . $row2['phone'] . '</td>';
          echo '<td id="email' . $row2['id'] . '">' . $row2['email'] . '</td>';
          echo '<td> <button type="button" onclick="set_id(' . $row2['id'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</button></td>';
        }
      } else {
        echo 'No results available';
      }
    } else {

      $query = "SELECT * FROM supplier";

      $result = $db->query($query);

      echo '<tbody>';

      if ($result->num_rows > 0) {
        $num = 1;
        echo '
          <div class = "table-responsive">
          <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        ';
        while ($row = $result->fetch_assoc()) {

          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td id="name' . $row['id'] . '">' . $row['name'] . '</td>';
          echo '<td id="address' . $row['id'] . '">' . $row['address'] . '</td>';
          echo '<td id="phone' . $row['id'] . '">' . $row['phone'] . '</td>';
          echo '<td id="email' . $row['id'] . '">' . $row['email'] . '</td>';
          echo '<td> <button type="button" onclick="set_id(' . $row['id'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</button></td>';
        }
      }else {
        echo 'Not Available';
      }
    }

    echo '</tbody>
 </table>
  </div>';
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../process.php" method="POST">
              <input type="hidden" name="edit_supplier" value="">
              <input type="hidden" name="id" id="inputID" value="">
              <div class="form-label-group">
                <label for="text">Supplier Name:</label>
                <input type="text" id="new_name" class="form-control" name="new_name">
              </div>
              <br>
              <div class="form-label-group">
                <label for="text">Supplier Address:</label>
                <input type="text" id="new_address" class="form-control" name="new_address">
              </div>
              <br>
              <div class="form-label-group">
                <label for="text">Supplier Phone:</label>
                <input type="text" id="new_phone" class="form-control" name="new_phone">
              </div>
              <br>
              <div class="form-label-group">
                <label for="text">Supplier Email:</label>
                <input type="text" id="new_email" class="form-control" name="new_email">
              </div>
              <br>

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    function set_id(id) {
      document.getElementById("inputID").value = id;
      setValue(id)
    }

    var inputname = document.querySelector('#new_name')
    var inputaddress = document.querySelector('#new_address')
    var inputphone = document.querySelector('#new_phone')
    var inputemail = document.querySelector('#new_email')

    function setValue(id) {
      inputname.value = document.querySelector(`#name${id}`).textContent
      inputaddress.value = document.querySelector(`#address${id}`).textContent
      inputphone.value = document.querySelector(`#phone${id}`).textContent
      inputemail.value = document.querySelector(`#email${id}`).textContent
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>