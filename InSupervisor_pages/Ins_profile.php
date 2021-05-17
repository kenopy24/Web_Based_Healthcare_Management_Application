<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎10 February, ‎2021
Date last edited: 10 February, ‎2021
-->
<!DOCTYPE html>
<?php

session_start();

include('../connection/conn.php');
if ($_SESSION['user'] != true) {

    header("Location: ../login.php");
}

if(isset($_SESSION['ERRORemail_message'])){
      
    echo '<script>alert("Email already exist")</script>';
    unset($_SESSION['ERRORemail_message']);
}

if(isset($_SESSION['ERRORusername_message'])){
    
    echo '<script>alert("Username already exist")</script>';
    unset($_SESSION['ERRORusername_message']);
}

if(isset($_SESSION['ERRORname_message'])){
    
    echo '<script>alert("Name already exist")</script>';
    unset($_SESSION['ERRORname_message']);
}

if(isset($_SESSION['ERRORphoneNumber_message'])){
    
    echo '<script>alert("Phone Number already exist")</script>';
    unset($_SESSION['ERRORphoneNumber_message']);
}

if (isset($_SESSION['edit_profile'])) {

    echo '<script>alert("Profile updated")</script>';
    unset($_SESSION['edit_profile']);
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

    <title>My Profile</title>
    <style>

    </style>
</head>

<body>
    <?php
    include_once('../Navbars/InvSNavbar.php');
    ?>
    <main>

        <?php

        $query = "SELECT * FROM users WHERE UID = '" . $_SESSION['UID'] . "'";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                        <div class="mx-auto" style="width: 500px;">
                        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 450px;">
                            <div class="text-center mb-4">
                                <h1>My Profile</h1>
                            </div>
                            <div class="form-label-group">
                                <h5>Name:</h5>
                                <input type="text" id="name" class="form-control" name="name" value="' . $row['name'] . '"readonly>
                            </div>
                            <br>
                            <div class="form-label-group">
                                <h5>Username:</h5>
                                <input type="text" id="username" class="form-control" name="username" value="' . $row['username'] . '"readonly>
                            </div>
                            <br>
                            <div class="form-label-group">
                                <h5>Email:</h5>
                                <input type="text" id="email" class="form-control" name="email" value="' . $row['email'] . '" readonly>
                            </div>
                            <br>
                            <div class="form-label-group">
                                <h5>Phone Number:</h5>
                                <input type="text" id="PhoneNumber" class="form-control" name="PhoneNumber" value="' . $row['PhoneNumber'] . '" readonly>
                            </div>
                            <br>
                            <div class="col text-center">
                            <button type="button" onclick="setValue()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</button>
                            </div>         
                        </div>
                    </div>
                ';
            }
        }
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
                            <input type="hidden" name="edit_InVprofile" value="">

                            <input type="hidden" name="get_UID" value="<?php echo $_SESSION['UID'] ?>">

                            <div class="form-label-group">
                                <label for="text">Name:</label>
                                <input type="text" id="new_name" class="form-control" name="new_name" pattern="^[a-zA-Z]{2,}(?: [a-zA-Z]+){0,6}$" title="Integers are not allowed">
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="text">Username:</label>
                                <input type="text" id="new_username" class="form-control" name="new_username">
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="text">Email:</label>
                                <input type="email" id="new_email" class="form-control" name="new_email">
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="text">Phone Number:</label>
                                <input type="text" id="new_phone" class="form-control" name="new_phone" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title="Only numbers are allowed/No spaces/Exp:0123456789">
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="text">New Password:</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number">
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
        var inputname = document.querySelector('#new_name')
        var inputusername = document.querySelector('#new_username')
        var inputemail = document.querySelector('#new_email')
        var inputphone = document.querySelector('#new_phone')

        function setValue() {
            inputname.value = document.querySelector(`#name`).value
            inputusername.value = document.querySelector(`#username`).value
            inputemail.value = document.querySelector(`#email`).value
            inputphone.value = document.querySelector(`#PhoneNumber`).value
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>