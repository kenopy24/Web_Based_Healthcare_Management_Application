<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎31 January, ‎2021
Date last edited: 2 March, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();
include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/DataTables/datatables.css" />
  <link rel="icon" href="../pictures/WHMAicon.png" type="image/x-icon">
  

  <script type="text/javascript" src="../css/DataTables/datatables.js"></script>


  <title>History</title>
  <style>
    .wrapper {
      text-align: center;
    }
  </style>
</head>

<body>

  <?php
  include_once('../Navbars/UserNavbar.php');
  ?>
  <main>
    <div class="d-flex align-items-center justify-content-between">

      <div class="p-2 bd-highlight col-example">
        <h1>History</h1>
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

      $query3 = "SELECT appointment.ID AS A_ID, appointment.D_ID, appointment.U_ID, appointment.A_Date, appointment.A_Time, appointment.status, users.name FROM appointment INNER JOIN doctors ON (appointment.D_ID = doctors.ID) INNER JOIN users ON (users.UID = doctors.UID) WHERE users.name = '$search' AND usertype ='Doctor' AND appointment.U_ID = '" . $_SESSION['UID']  . "' AND appointment.status != 'Active' ";

      $result3 = $db->query($query3);
      if ($result3->num_rows > 0) {
        $num = 1;
        echo '
        <div class = "table-responsive">
        <table class="table" id="history">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
            <th scope="col">Doctor`s Prescriptions</th>
            <th scope="col">Status</th>
        
         </tr>
        </thead>
        ';
        while ($row3 = $result3->fetch_assoc()) {

          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td>' . $row3['name'] . '</td>';
          echo '<td>' . $row3['A_Date'] . '</td>';
          echo '<td>' . $row3['A_Time'] . '</td>';
          echo '<td>';
          $query4 = "SELECT * FROM patient_medication INNER JOIN patient ON (patient_medication.p_id = patient.p_id) INNER JOIN medicine ON (patient_medication.med_id = medicine.id) WHERE patient.a_id = $row3[A_ID]";

          $result4 = $db->query($query4);
          if ($result4->num_rows > 0) {
            while ($row4 = $result4->fetch_assoc()) {
              echo $row4['product_name'] . ' | ' . ' x ' . $row4['quantity'] . ' || ';
            }
          } else {
            echo '<b>N/A</b>';
          }

          echo '</td>';
          echo '<td>' . $row3['status'] . '</td>';

          echo '</tr>';
        }
      } else {
        echo 'No results available';
      }
    } else {

      $query = "SELECT appointment.ID AS A_ID, appointment.D_ID, appointment.U_ID, appointment.A_Date, appointment.A_Time, appointment.status, users.name FROM appointment INNER JOIN doctors ON (appointment.D_ID = doctors.ID) INNER JOIN users ON (users.UID = doctors.UID) WHERE usertype ='Doctor' AND appointment.U_ID = '" . $_SESSION['UID']  . "' AND appointment.status != 'Active' ";

      $result = $db->query($query);

      echo '<tbody>';

      if ($result->num_rows > 0) {
        $num = 1;
        echo '
        <div class = "table-responsive">
        <table class="table" id="history" style="width:100%">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
            <th scope="col">Doctor`s Prescriptions</th>
            <th scope="col">Status</th>
            
          </tr>
        </thead>
      ';
        while ($row = $result->fetch_assoc()) {

          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td>' . $row['name'] . '</td>';
          echo '<td>' . $row['A_Date'] . '</td>';
          echo '<td>' . $row['A_Time'] . '</td>';
          echo '<td>';
          $query2 = "SELECT * FROM patient_medication INNER JOIN patient ON (patient_medication.p_id = patient.p_id) INNER JOIN medicine ON (patient_medication.med_id = medicine.id) WHERE patient.a_id = $row[A_ID]";

          $result2 = $db->query($query2);
          if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
              echo $row2['product_name'] . ' | ' . ' x ' . $row2['quantity'] . ' || ';
            }
          } else {
            echo '<b>N/A</b>';
          }

          echo '</td>';
          echo '<td>' . $row['status'] . '</td>';

          echo '</tr>';
        }
      } else {
        echo '<h3>You have no completed or cancelled appointments.</h3>';
      }
    }


    echo '</tbody>
 </table>
  </div>';
    ?>
  </main>
  <script>
    $(document).ready(function() {
      $('#history').dataTable({
        "bFilter": false
      });
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>