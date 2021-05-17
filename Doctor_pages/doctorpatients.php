<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎30 ‎January, ‎2021
Date last edited: 2 March, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');

if ($_SESSION['user'] != true) {

    header("Location: ../login.php");
}
if (isset($_SESSION['update_notes'])) {

    echo '<script>alert("Patient note updated")</script>';
    unset($_SESSION['update_notes']);
}
if (isset($_SESSION['add_medicine'])) {

    echo '<script>alert("Medicine successfully added")</script>';
    unset($_SESSION['add_medicine']);
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

    <title>Patient</title>
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
                <h1>Patient List</h1>
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
        echo '<div class = "table-responsive">';


        if (!empty($_POST['search'])) {

            $search = $_POST['search'];

            $query3 = "SELECT * FROM patient INNER JOIN appointment ON (patient.a_id = appointment.ID) INNER JOIN doctors ON (appointment.D_ID = doctors.ID) INNER JOIN users ON (appointment.U_ID = users.UID) WHERE users.name = '$search' AND doctors.UID = '" . $_SESSION['UID']  . "' AND status = 'Active'";

            $result3 = $db->query($query3);
            if ($result3->num_rows > 0) {
                $num = 1;
                echo '
                <div class = "table-responsive">
                <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Medicines</th>
                    <th scope="col">Appointment Date/Time</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
            ';
                while ($row3 = $result3->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th>' .  $num++ . '</th>';
                    echo '<td>' . $row3['name'] . '</td>';

                    if ($row3['note']) {
                        echo '<td>' . $row3['note'] . '</td>';
                    } else {
                        echo '<td><b>N/A</b></td>';
                    }
                    $query4 = "SELECT * FROM patient_medication INNER JOIN patient ON (patient_medication.p_id = patient.p_id) INNER JOIN medicine ON (patient_medication.med_id = medicine.id) WHERE patient_medication.p_id = $row3[p_id]";

                    $result4 = $db->query($query4);
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            echo '<td>';
                            echo $row4['product_name'] . ' | ' . ' x ' . $row4['quantity'] . ' || ';
                            echo '</td>';
                        }
                    } else {
                        echo '<td><b>N/A</b></td>';
                    }
                    echo '<td>' . $row3['A_Date'] . ' • ' . $row3['A_Time'] . '</td>';

                    echo '<td> <button type="button" onclick="set_id(' . $row3['p_id'] . ')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Modal">Edit Note</button> <button type="button" onclick="set_id2(' . $row3['p_id'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalMeds">Add Medicine </button> <a href="deletepatientmed.php?pass_id=1&ID=' . $row3['p_id'] . '"> <button type="button" class="btn btn-danger">Delete Medicine</button> </td>';
                    echo '</tr>';
                }
            } else {
                echo 'No results available';
            }
        } else {
            $query = "SELECT * FROM patient INNER JOIN appointment ON (patient.a_id = appointment.ID) INNER JOIN doctors ON (appointment.D_ID = doctors.ID) INNER JOIN users ON (appointment.U_ID = users.UID) WHERE doctors.UID = '" . $_SESSION['UID']  . "' AND status = 'Active'";

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
                    <th scope="col">Patient Name</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Medicines</th>
                    <th scope="col">Appointment Date/Time</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
              ';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th>' .  $num++ . '</th>';
                    echo '<td>' . $row['name'] . '</td>';
                    if ($row['note']) {
                        echo '<td>' . $row['note'] . '</td>';
                    } else {
                        echo '<td><b>N/A</b></td>';
                    }
                    $query2 = "SELECT * FROM patient_medication INNER JOIN patient ON (patient_medication.p_id = patient.p_id) INNER JOIN medicine ON (patient_medication.med_id = medicine.id) WHERE patient_medication.p_id = $row[p_id]";

                    $result2 = $db->query($query2);
                    if ($result2->num_rows > 0) {
                        echo '<td>';

                        while ($row2 = $result2->fetch_assoc()) {
                            echo $row2['product_name'] . ' | ' . ' x ' . $row2['quantity'] . ' || ';
                        }
                        echo '</td>';
                    } else {
                        echo '<td><b>N/A</b></td>';
                    }
                    echo '<td>' . $row['A_Date'] . ' • ' . $row['A_Time'] . '</td>';

                    echo '<td> <button type="button" onclick="set_id(' . $row['p_id'] . ')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Modal">Edit Note</button> <button type="button" onclick="set_id2(' . $row['p_id'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalMeds">Add Medicine </button> <a href="deletepatientmed.php?pass_id=1&ID=' . $row['p_id'] . '"> <button type="button" class="btn btn-danger">Delete Medicine</button> </td>';
                    echo '</tr>';
                }
            } else {
                echo '<td><b>You have no patients</b></td>';
            }
            echo '</tbody>
     </table>
      </div>';
        }

        ?>
        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Edit notes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../process.php" method="POST">
                            <input type="hidden" name="edit_patient_doctor" value="">
                            <input type="hidden" name="id" id="inputID" value="">
                            <div class="form-label-group">
                                <label for="text">notes:</label>
                                <input type="text" id="notes" class="form-control" required="" name="notes">
                            </div>
                            <br>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal2 -->
        <div class="modal fade" id="ModalMeds" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Add Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../process.php" method="POST">
                            <input type="hidden" name="edit_patient_medicine" value="">
                            <input type="hidden" name="id" id="inputID2" value="">
                            <div class="form-label-group">
                                <label for="text">Medicine:</label>
                                <select name="medicine" class="form-control" id="medicine" required="required">

                                    <?php
                                    $query3 = "SELECT * FROM medicine";
                                    $result3 = $db->query($query3);

                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {

                                    ?><option value="<?php echo $row3['id'] ?>"><?php echo $row3['product_name'] . " ------ " . $row3['product_description']; ?></option><?php
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                            ?>

                                </select>
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="text">Quantity:</label>
                                <input type="text" id="quantity" class="form-control" required="" name="quantity">
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

        function set_id2(id) {
            document.getElementById("inputID2").value = id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>