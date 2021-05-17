<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎14 ‎January, ‎2021
Date last edited: 2 ‎March, ‎2021
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
if (isset($_SESSION['updateStat_message'])) {

  echo '<script>alert("Status updated")</script>';
  unset($_SESSION['updateStat_message']);
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
  include_once('../Navbars/DoctorNavbar.php');
  ?>
  <main>
    <div class="d-flex align-items-center justify-content-between">

      <div class="p-2 bd-highlight col-example">
        <h1>My Appoinments</h1>
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

      $query2 = "SELECT appointment.ID AS A_ID, appointment.D_ID, appointment.U_ID, appointment.A_Date, appointment.A_Time, appointment.status, users.name, users.email FROM appointment INNER JOIN users ON (users.UID = appointment.U_ID) INNER JOIN doctors ON (appointment.D_ID = doctors.ID) WHERE users.name = '$search' AND doctors.UID = '" . $_SESSION['UID'] . "' AND appointment.status = 'Active'";

      $result2 = $db->query($query2);
      if ($result2->num_rows > 0) {
        $num = 1;
        echo '
    <div class = "table-responsive">
    <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Patient Name</th>
        <th scope="col">Appointment Date</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Current Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
  ';
        while ($row2 = $result2->fetch_assoc()) {
          echo '<tr>';
          echo '<th>' .  $num++ . '</th>';
          echo '<td>' . $row2['name'] . '</td>';
          echo '<td>' . $row2['A_Date'] . '</td>';
          echo '<td>' . $row2['A_Time'] . '</td>';
          echo '<td>' . $row2['status'] . '</td>';
          echo '<td> <a href="../process.php?delete_appointment_doctor=1&ID=' . $row2['A_ID'] . '"> <button type="submit" class="btn btn-danger">Cancel</button><a href="../process.php?update_appointmentStatus_doctor=1&ID=' . $row2['A_ID'] . '"> <button type="submit" class="btn btn-success">Update Status</button> <a href="../process.php?sendReminder=1&ID=' . $row2['A_ID'] . '&email=' . $row2['email'] . '&A_Date=' . $row2['A_Date'] . '&A_Time=' . $row2['A_Time'] . '&name=' . $row2['name'] . '"> <button type="submit" class="btn btn-primary">Send Reminder</button></td>';
          echo '</tr>';
        }
      } else {
        echo 'No results available';
      }
    } else {
      $query = "SELECT appointment.ID AS A_ID, appointment.D_ID, appointment.U_ID, appointment.A_Date, appointment.A_Time, appointment.status, users.name, users.email FROM appointment INNER JOIN users ON (users.UID = appointment.U_ID) INNER JOIN doctors ON (appointment.D_ID = doctors.ID) WHERE doctors.UID = '" . $_SESSION['UID'] . "' AND appointment.status = 'Active'";

      $result = $db->query($query);

      echo '<tbody>';
      if ($result->num_rows > 0) {
        $num = 1;
        echo '
      <div class = "table-responsive">
      <table class="table" id="table">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Patient Name</th>
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
          echo '<td> <a href="../process.php?delete_appointment_doctor=1&ID=' . $row['A_ID'] . '"> <button type="submit" class="btn btn-danger">Cancel</button><a href="../process.php?update_appointmentStatus_doctor=1&ID=' . $row['A_ID'] . '"> <button type="submit" class="btn btn-success">Update Status</button> <a href="../process.php?sendReminder=1&ID=' . $row['A_ID'] . '&email=' . $row['email'] . '&A_Date=' . $row['A_Date'] . '&A_Time=' . $row['A_Time'] . '&name=' . $row['name'] . '"> <button type="submit" class="btn btn-primary">Send Reminder</button></td>';
          echo '</tr>';
        }
      } else {
        echo '<br>';
        echo '<td><b>You have no appointments</b></td>';
      }
    }


    echo '</tbody>
 </table>
  </div>';
    ?>
    <?php
    if (isset($_SESSION["email"]) && isset($_SESSION["name"]) && isset($_SESSION["a_date"]) && isset($_SESSION["a_time"])) {

      echo '<input type="hidden" id="email" value="' . $_SESSION["email"] . '">';
      echo '<input type="hidden" id="name" value="' . $_SESSION["name"] . '">';
      echo '<input type="hidden" id="a_time" value="' . $_SESSION["a_time"] . '">';
      echo '<input type="hidden" id="a_date" value="' . $_SESSION["a_date"] . '">';

      unset($_SESSION['email']);
      unset($_SESSION['name']);
      unset($_SESSION['a_time']);
      unset($_SESSION['a_date']);
    }
    ?>
  </main>
  <script src="https://smtpjs.com/v3/smtp.js">
  </script>
  <script>
    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;
    var a_time = document.getElementById("a_time").value;
    var a_date = document.getElementById("a_date").value;

    sendEmail(email, name, a_time, a_date);

    function sendEmail(email, name, a_time, a_date) {
      Email.send({
        Host: "smtp.gmail.com",
        Username: "whmsmed@gmail.com",
        Password: "medicalstonks",
        To: email,
        From: "whmsmed@gmail.com",
        Subject: "Appointment reminder",
        Body: `Dear ${name},<br> <br> This is a reminder that your appointment is scheduled on ${a_date} at ${a_time}.`
      }).then(
        message => alert("Reminder sent")
      );
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>