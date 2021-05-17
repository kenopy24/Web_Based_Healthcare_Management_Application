<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎25 ‎January, ‎2021
Date last edited: 25 February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}

if (isset($_SESSION['add_product'])) {

  echo '<script>alert("Product updated")</script>';
  unset($_SESSION['add_product']);
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

  <title>View Medicine</title>
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
        <h1>Medicine Lists</h1>
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

      $query2 = "SELECT medicine.id AS I_ID, medicine.supplier_id, medicine.product_code, medicine.product_name, medicine.product_quantity, medicine.product_description, type, supplier.name FROM medicine INNER JOIN supplier ON (medicine.supplier_id = supplier.id) WHERE medicine.product_code = '$search'";

      $result2 = $db->query($query2);
      if ($result2->num_rows > 0) {
        $num = 1;
        echo '
          <div class = "table-responsive">
          <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Medicine Code</th>
              <th scope="col">Medicine Name</th>
              <th scope="col">Medicine Quantity</th>
              <th scope="col">Medicine description</th>
              <th scope="col">Medicine type</th>
              <th scope="col">Supplier Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        ';
        while ($row2 = $result2->fetch_assoc()) {

          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td>' . $row2['product_code'] . '</td>';
          echo '<td>' . $row2['product_name'] . '</td>';
          echo '<td>' . $row2['product_quantity'] . '</td>';
          echo '<td>' . $row2['product_description'] . '</td>';
          echo '<td>' . $row2['type'] . '</td>';
          echo '<td>' . $row2['name'] . '</td>';
          echo '<td> <button type="button" onclick="set_id(' . $row2['I_ID'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Quantity</button></td>';
          echo '</tr>';
        }
      } else {
        echo 'No results available';
      }
    } else {

      $query = "SELECT medicine.id AS I_ID, medicine.supplier_id, medicine.product_code, medicine.product_name, medicine.product_quantity, medicine.product_description, type, supplier.name FROM medicine INNER JOIN supplier ON (medicine.supplier_id = supplier.id)";

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
              <th scope="col">Medicine Code</th>
              <th scope="col">Medicine Name</th>
              <th scope="col">Medicine Quantity</th>
              <th scope="col">Medicine description</th>
              <th scope="col">Medicine type</th>
              <th scope="col">Supplier Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
            ';
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td>' . $row['product_code'] . '</td>';
          echo '<td>' . $row['product_name'] . '</td>';
          echo '<td>' . $row['product_quantity'] . '</td>';
          echo '<td>' . $row['product_description'] . '</td>';
          echo '<td>' . $row['type'] . '</td>';
          echo '<td>' . $row['name'] . '</td>';
          echo '<td> <button type="button" onclick="set_id(' . $row['I_ID'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Quantity</button></td>';
          echo '</tr>';
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../process.php" method="POST">
              <input type="hidden" name="edit_product" value="">
              <input type="hidden" name="id" id="inputID" value="">
              <div class="form-label-group">
                <label for="text">New amount:</label>
                <input type="text" id="new_amount" class="form-control" required="" name="new_amount">
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
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>