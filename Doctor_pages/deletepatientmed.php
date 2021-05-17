<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎30 ‎January, ‎2021
Date last edited: 23 ‎February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();
include('../connection/conn.php');

if ($_SESSION['user'] != true) {

    header("Location: ../login.php");
}
if (isset($_SESSION['delete_med_message'])) {

    echo '<script>alert("Patient medicine deleted")</script>';
    unset($_SESSION['delete_med_message']);
}

if (isset($_GET['pass_id'])) {
    $id = $_GET["ID"];
    $_SESSION["patient_id"] = $id;
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

    <title>Delete Medicine</title>
    <style>

    </style>
</head>

<body>
    <?php
    include_once('../Navbars/DoctorNavbar.php');
    ?>

    <main>
        <div class="text-center mb-4">
            <h1>Delete patient medicine</h1>
        </div>
        <?php

        $query = "SELECT * FROM patient_medication INNER JOIN medicine ON(patient_medication.med_id = medicine.id) WHERE p_id = '$id'";

        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $num = 1;
            echo '
                <div class = "table-responsive">
                <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
            ';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<th>' .  $num++ . '</th>';
                echo '<td>' . $row['product_name'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td> <a href="../process.php?delete_med=1&pm_id=' . $row['pm_id'] . '&med_id= ' . $row['med_id'] . '& medicine_id=' . $row['id'] . '"> <button type="button" class="btn btn-secondary">Delete Medicine</button> </td>';
                echo '</tr>';
            }
        } else {
            echo '<b>No medicine is available to delete, please return to My Patients tab</b>';
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