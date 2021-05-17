<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎14 January, ‎2021
Date last edited: 2 March, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

  header("Location: ../login.php");
}
if (isset($_SESSION['delete_message'])) {

  echo '<script>alert("Appointment cancelled")</script>';
  unset($_SESSION['delete_message']);
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
  <link rel="icon" href="../pictures/WHMAicon.png" type="image/x-icon">

  <title>My Appointments</title>
  <style>

  </style>
</head>

<body>
  <?php
  include_once('../Navbars/UserNavbar.php');
  ?>

  <main>
    <div class="text-center mb-4">
      <h1>My Appointments</h1>
    </div>
    <?php

    $query = "SELECT appointment.ID AS A_ID, appointment.D_ID, appointment.U_ID, appointment.A_Date, appointment.A_Time, appointment.status, users.name FROM appointment INNER JOIN doctors ON (appointment.D_ID = doctors.ID) INNER JOIN users ON (users.UID = doctors.UID) WHERE usertype ='Doctor' AND appointment.U_ID = '" . $_SESSION['UID']  . "' AND appointment.status = 'Active'";

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
        <th scope="col">Doctor Name</th>
        <th scope="col">Appointment Date</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Current Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
  ';
      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th>' .  $num++ . '</th>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['A_Date'] . '</td>';
        echo '<td>' . $row['A_Time'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td> <a href="../process.php?delete_appointment_patient=1&ID=' . $row['A_ID'] . '"> <button type="submit" class="btn btn-danger">Cancel</button> </td>';
        echo '</tr>';
      }
    } else {
      echo '<br>';
      echo '<h2>You have no appointments</h2>';
    }


    echo '</tbody>
 </table>
  </div>';
    ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>