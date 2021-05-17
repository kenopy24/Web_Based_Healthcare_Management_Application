<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎6 January, ‎2021
Date last edited: 2 March, ‎2021
-->
<?php
session_start();
include('connection/conn.php');

//delete booking patient side

if (isset($_GET['delete_appointment_patient'])) {
    $id = $_GET['ID'];
    $query = "UPDATE appointment SET status = 'Cancelled' WHERE ID = '" . $id . "'";

    if ($db->query($query) === TRUE) {
        $_SESSION['delete_message'] = true;
        header('Location: OutPatient_pages/U_My_appointments.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

//delete booking doctor side
if (isset($_GET['delete_appointment_doctor'])) {
    $id = $_GET['ID'];
    $query = "UPDATE appointment SET status = 'Cancelled' WHERE ID = '" . $id . "'";

    if ($db->query($query) === TRUE) {
        $_SESSION['delete_message'] = true;
        header('Location: Doctor_pages/D_My_appointments.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

//update status doctor side
if (isset($_GET['update_appointmentStatus_doctor'])) {
    $id = $_GET['ID'];
    $query = "UPDATE appointment SET status = 'Completed' WHERE ID = '" . $id . "'";

    if ($db->query($query) === TRUE) {
        $_SESSION['updateStat_message'] = true;
        header('Location: Doctor_pages/D_My_appointments.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

//Sign in validation
if (isset($_POST['login_form'])) {

    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $password . "'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $_SESSION['UID'] = $row['UID'];
        $_SESSION['user'] = true;

        if ($row['usertype'] == 'Patient') {
            header('Location: OutPatient_pages/U_My_appointments.php');
        } else if ($row['usertype'] == 'Doctor') {
            header('Location: Doctor_pages/D_My_appointments.php');
        } else if ($row['usertype'] == 'Admin') {
            header('Location: Admin_pages/Admin_index.php');
        } else if ($row['usertype'] == 'Inventory Supervisor') {
            header('Location: InSupervisor_pages/InventorySupervisorIndex.php');
        } else if ($row['usertype'] == 'Nurse') {
            header('Location: Nurse_pages/nurse_main.php');
        }
    } else {
        $_SESSION['error_login_message'] = true;
        header('Location: login.php');
    }
}

//booking form
if (isset($_POST['booking_form'])) {

    $D_ID = $_POST['doctor'];
    $U_ID = $_SESSION['UID'];
    $A_Date = $_POST['date'];
    $A_Time = $_POST['timeslot'];
    $status = "Active";
    $error = FALSE;

    $sql_c = "SELECT * from appointment where (A_Time='$A_Time' AND A_Date='$A_Date' AND status = 'Active' AND D_ID = '$D_ID')";
    $sql_c1 = "SELECT * from appointment WHERE (A_Time='$A_Time' AND A_Date='$A_Date' AND status = 'Active' AND U_ID = '$U_ID')";

    $res_c = mysqli_query($db, $sql_c);
    $res_c1 = mysqli_query($db, $sql_c1);

    if (mysqli_num_rows($res_c) > 2) {

        $row = mysqli_fetch_assoc($res_c);
        if ($A_Time == isset($row['A_Time'])) {
            $_SESSION['bookedtime'] = true;
            header('Location: OutPatient_pages/U_book_appointment.php');
        }
    } else if (mysqli_num_rows($res_c1) > 0) {

        $row2 = mysqli_fetch_assoc($res_c1);
        if ($U_ID == isset($row2['U_ID'])) {
            $_SESSION['alreadybookedtime'] = true;
            header('Location: OutPatient_pages/U_book_appointment.php');
        }
    } else {
        $query = "INSERT INTO appointment (D_ID, U_ID, A_Date, A_Time, status) VALUES ('$D_ID', '$U_ID', '$A_Date', '$A_Time', '$status')";
        if ($db->query($query) === TRUE) {
            $id = mysqli_insert_id($db);
            $error = FALSE;
            header('Location: OutPatient_pages/U_book_appointment.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
        if ($error !== TRUE) {
            $query2 = "INSERT INTO patient (a_id, UID) VALUES ('$id', '$U_ID')";
            if ($db->query($query2) === TRUE) {
                $_SESSION['message'] = true;
                header('Location: OutPatient_pages/U_book_appointment.php');
            } else {
                echo "Error: " . $query . "<br>" . $db->error;
                exit();
            }
        }
    }
}



//registration form
if (isset($_POST['registration_form'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $PhoneNumber = $_POST['phone_number'];
    $password = md5($_POST['password_confirm']);
    $type = "Patient";

    $sql_u = "SELECT * from users where username='$username'";
    $sql_e = "SELECT * from users where email='$email'";
    $sql_n = "SELECT * from users where name='$name'";
    $sql_ph = "SELECT * from users where PhoneNumber='$PhoneNumber'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    $res_ph = mysqli_query($db, $sql_ph);


    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: register.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: register.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: register.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: register.php');
    } else {

        $query = "INSERT INTO users(username, name, email, PhoneNumber, password, usertype) VALUES ('$username', '$name', '$email', '$PhoneNumber', '$password', '$type')";

        if ($db->query($query) === TRUE) {

            $_SESSION['reg_message'] = true;
            header('Location: login.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//adding doctor form
if (isset($_POST['add_doctor'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $PhoneNumber = $_POST['phone_number'];
    $password = md5($_POST['password']);
    $type = "Doctor";
    $specialism = $_POST['specialism'];
    $Prac_from = $_POST['date'];
    $error = FALSE;

    $sql_u = "SELECT * from users where username='$username'";
    $sql_e = "SELECT * from users where email='$email'";
    $sql_n = "SELECT * from users where name='$name'";
    $sql_ph = "SELECT * from users where PhoneNumber='$PhoneNumber'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    $res_ph = mysqli_query($db, $sql_ph);

    if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Admin_pages/Admin_AddDoc.php');
    } else if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Admin_pages/Admin_AddDoc.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Admin_pages/Admin_AddDoc.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Admin_pages/Admin_AddDoc.php');
    } else {

        $query = "INSERT INTO users(username, name, email, PhoneNumber, password, usertype) VALUES ('$username', '$name', '$email', '$PhoneNumber', '$password', '$type')";

        if ($db->query($query) === TRUE) {

            $id = mysqli_insert_id($db);
            $error = FALSE;
            header('Location: Admin_pages/Admin_AddDoc.php');
        } else {
            $error = TRUE;
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
    if ($error !== TRUE) {
        $query2 = "INSERT INTO doctors (UID, Spec_name, Practicing_from) VALUES ('$id', '$specialism', '$Prac_from')";
        if ($db->query($query2) === TRUE) {

            $_SESSION['Add_doctor_message'] = true;
            header('Location: Admin_pages/Admin_AddDoc.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//adding nurse form
if (isset($_POST['add_nurse'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $PhoneNumber = $_POST['phone_number'];
    $password = md5($_POST['password']);
    $type = "Nurse";
    $specialism = $_POST['specialism'];
    $Prac_from = $_POST['date'];

    $sql_u = "SELECT * from users where username='$username'";
    $sql_e = "SELECT * from users where email='$email'";
    $sql_n = "SELECT * from users where name='$name'";
    $sql_ph = "SELECT * from users where PhoneNumber='$PhoneNumber'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    $res_ph = mysqli_query($db, $sql_ph);


    if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Admin_pages/Admin_AddNurse.php');
    } else if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Admin_pages/Admin_AddNurse.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Admin_pages/Admin_AddNurse.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Admin_pages/Admin_AddNurse.php');
    } else {

        $query = "INSERT INTO users(username, name, email, PhoneNumber, password, usertype) VALUES ('$username', '$name', '$email', '$PhoneNumber', '$password', '$type')";

        if ($db->query($query) === TRUE) {

            $_SESSION['Add_nurse_message'] = true;
            header('Location: Admin_pages/Admin_AddNurse.php');
        } else {

            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//adding inventory supervisor form
if (isset($_POST['add_inventorySupervisor'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $PhoneNumber = $_POST['phone_number'];
    $password = md5($_POST['password']);
    $type = "Inventory Supervisor";
    $specialism = $_POST['specialism'];
    $Prac_from = $_POST['date'];

    $sql_u = "SELECT * from users where username='$username'";
    $sql_e = "SELECT * from users where email='$email'";
    $sql_n = "SELECT * from users where name='$name'";
    $sql_ph = "SELECT * from users where PhoneNumber='$PhoneNumber'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    $res_ph = mysqli_query($db, $sql_ph);

    if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Admin_pages/Admin_AddInvS.php');
    } else if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Admin_pages/Admin_AddInvS.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Admin_pages/Admin_AddInvS.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Admin_pages/Admin_AddInvS.php');
    } else {

        $query = "INSERT INTO users(username, name, email, PhoneNumber, password, usertype) VALUES ('$username', '$name', '$email', '$PhoneNumber', '$password', '$type')";

        if ($db->query($query) === TRUE) {

            $_SESSION['Add_InvS_message'] = true;
            header('Location: Admin_pages/Admin_AddInvS.php');
        } else {

            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//adding medicine form
if (isset($_POST['add_product'])) {

    $s_id = $_POST['supplier_name'];
    $p_code = $_POST['product_code'];
    $p_name = $_POST['product_name'];
    $p_quantity = $_POST['product_quantity'];
    $p_type = $_POST['med_type'];
    $p_description = $_POST['product_description'];


    $sql = "SELECT * from medicine where (product_name='$p_name' or product_code='$p_code');";

    $res = mysqli_query($db, $sql);

    $sql_n = "SELECT * from medicine where product_name='$p_name'";
    $sql_c = "SELECT * from medicine where product_code='$p_code'";

    $res_n = mysqli_query($db, $sql_n);
    $res_c = mysqli_query($db, $sql_c);

    if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORproductN_message'] = true;
        header('Location: InSupervisor_pages/Add_product_inventory.php');
    } else if (mysqli_num_rows($res_c) > 0) {
        $_SESSION['ERRORproductC_message'] = true;
        header('Location: InSupervisor_pages/Add_product_inventory.php');
    } else {

        $query = "INSERT INTO medicine(supplier_id, product_code, product_name, product_quantity, type, product_description) VALUES ('$s_id', '$p_code', '$p_name', '$p_quantity', '$p_type', '$p_description')";

        if ($db->query($query) === TRUE) {

            $_SESSION['Add_product_success'] = true;
            header('Location: InSupervisor_pages/Add_product_inventory.php');
        } else {

            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//adding supplier form
if (isset($_POST['add_supplier'])) {

    $sup_name = $_POST['supplier_name'];
    $sup_address = $_POST['supplier_address'];
    $sup_email = $_POST['supplier_email'];
    $sup_phone = $_POST['supplier_phone_number'];

    $sql_n = "SELECT * from supplier where name='$sup_name'";
    $sql_a = "SELECT * from supplier where address='$sup_address'";
    $sql_ph = "SELECT * from supplier where phone='$sup_phone'";
    $sql_e = "SELECT * from supplier where email='$sup_email'";

    $res_n = mysqli_query($db, $sql_n);
    $res_a = mysqli_query($db, $sql_a);
    $res_ph = mysqli_query($db, $sql_ph);
    $res_e = mysqli_query($db, $sql_e);

    if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORsupplierName_message'] = true;
        header('Location: InSupervisor_pages/Add_supplier_inventory.php');
    } else if (mysqli_num_rows($res_a) > 0) {
        $_SESSION['ERRORSupplieraddress_message'] = true;
        header('Location: InSupervisor_pages/Add_supplier_inventory.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORSupplierphone_message'] = true;
        header('Location: InSupervisor_pages/Add_supplier_inventory.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORSupplieremail_message'] = true;
        header('Location: InSupervisor_pages/Add_supplier_inventory.php');
    } else {

        $query = "INSERT INTO supplier(name, address, phone, email) VALUES ('$sup_name', '$sup_address', '$sup_phone', '$sup_email')";

        if ($db->query($query) === TRUE) {

            $_SESSION['Add_supplier_success'] = true;
            header('Location: InSupervisor_pages/Add_supplier_inventory.php');
        } else {

            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit new medicine amount
if (isset($_POST['edit_product'])) {

    $p_quantity = $_POST['new_amount'];
    $id = $_POST['id'];

    $query = "UPDATE medicine SET product_quantity= '$p_quantity' WHERE id = '" . $id . "'";

    if ($db->query($query) === TRUE) {

        $_SESSION['add_product'] = true;
        header('Location: InSupervisor_pages/InventorySupervisorIndex.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

//edit new supplier 
if (isset($_POST['edit_supplier'])) {

    $s_name = $_POST['new_name'];
    $s_address = $_POST['new_address'];
    $s_phone = $_POST['new_phone'];
    $s_email = $_POST['new_email'];
    $id = $_POST['id'];

    $sql_n = "SELECT * from supplier where name='$s_name' AND id != '" . $id . "'";
    $sql_e = "SELECT * from supplier where email='$s_email' AND id != '" . $id . "'";
    $sql_a = "SELECT * from supplier where address='$s_address' AND id != '" . $id . "'";
    $sql_ph = "SELECT * from supplier where phone='$s_phone' AND id != '" . $id . "'";

    $res_n = mysqli_query($db, $sql_n);
    $res_e = mysqli_query($db, $sql_e);
    $res_a = mysqli_query($db, $sql_a);
    $res_ph = mysqli_query($db, $sql_ph);

    if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORsupplierName_message'] = true;
        header('Location: InSupervisor_pages/Inventory_viewsuppliers.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORSupplieremail_message'] = true;
        header('Location: InSupervisor_pages/Inventory_viewsuppliers.php');
    } else if (mysqli_num_rows($res_a) > 0) {
        $_SESSION['ERRORSupplieraddress_message'] = true;
        header('Location: InSupervisor_pages/Inventory_viewsuppliers.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORSupplierphone_message'] = true;
        header('Location: InSupervisor_pages/Inventory_viewsuppliers.php');
    } else {

        $query = "UPDATE supplier SET name= '$s_name', address= '$s_address', phone= '$s_phone',email='$s_email'  WHERE id = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_suppliers'] = true;
            header('Location: InSupervisor_pages/Inventory_viewsuppliers.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit patient notes 
if (isset($_POST['edit_patient_doctor'])) {

    $p_notes = $_POST['notes'];
    $id = $_POST['id'];

    $query = "UPDATE patient SET note= '$p_notes' WHERE p_id = '" . $id . "'";

    if ($db->query($query) === TRUE) {

        $_SESSION['update_notes'] = true;
        header('Location: Doctor_pages/doctorpatients.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

//edit patient medicine 
if (isset($_POST['edit_patient_medicine'])) {

    $m_id = $_POST['medicine'];
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $error = FALSE;

    $query = "INSERT INTO patient_medication(p_id, med_id, quantity) VALUES('$id','$m_id', '$quantity')";

    if ($db->query($query) === TRUE) {

        $error = FALSE;

        header('Location: Doctor_pages/doctorpatients.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
    if ($error !== TRUE) {
        $query2 = "UPDATE medicine SET product_quantity = product_quantity - '" . $quantity . "' WHERE id = '" . $m_id . "' ";

        if ($db->query($query2) === TRUE) {

            $_SESSION['add_medicine'] = true;
            header('Location: Doctor_pages/doctorpatients.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//delete patient medicine
if (isset($_GET['delete_med'])) {
    $pm_id = $_GET['pm_id'];
    $med_id = $_GET['med_id'];
    $error = FALSE;

    $query = "UPDATE medicine SET product_quantity = product_quantity + (SELECT quantity FROM patient_medication WHERE pm_id = '" . $pm_id . "') WHERE id = '" . $med_id . "' ";


    if ($db->query($query) === TRUE) {

        $error = FALSE;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
    if ($error !== TRUE) {

        $query2 = "DELETE FROM patient_medication WHERE pm_id = '" . $pm_id . "'";

        if ($db->query($query2) === TRUE) {
            $_SESSION['delete_med_message'] = true;

            header('Location: Doctor_pages/deletepatientmed.php?pass_id=1&ID=' . $_SESSION["patient_id"] . '');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//forgot password and send email
if (isset($_POST['forgot_form'])) {
    $email = $_POST['email'];
    $error = FALSE;

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $_SESSION["email"] = $email;
        $time = time();
        $rand_num = rand(1000, 9999);
        $temp_code = md5($email . $time . $rand_num);
        $_SESSION["token"] = $temp_code;
        $error = FALSE;


        header('Location: forgot.php');
    } else {

        $_SESSION['email_check'] = true;

        header('Location: forgot.php');
    }
    if ($error !== TRUE) {

        $query2 = "UPDATE users SET temp_token = '$temp_code' WHERE email = '$email'";

        if ($db->query($query2) === TRUE) {
            header('Location: forgot.php');
        }
    }
}

//reset password
if (isset($_POST['token'])) {
    $token = $_POST['token'];
    $new_password = md5($_POST['new_password']);

    $query = "UPDATE users SET `password` = '$new_password' WHERE temp_token = '$token' ";

    if ($db->query($query) === TRUE) {

        $_SESSION['updatePass_message'] = true;
        header('Location: login.php');
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
        exit();
    }
}

function checkEditProfile($username, $name, $phone, $email, $id, $db)
{
    $sql_u = "SELECT * from users where username='$username' AND UID != '" . $id . "'";
    $sql_e = "SELECT * from users where email='$email' AND UID != '" . $id . "'";
    $sql_n = "SELECT * from users where name='$name' AND UID != '" . $id . "'";
    $sql_ph = "SELECT * from users where PhoneNumber='$phone' AND UID != '" . $id . "'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    $res_ph = mysqli_query($db, $sql_ph);

    return array($res_u, $res_e, $res_n, $res_ph);
}

//edit Inventory profile 
if (isset($_POST['edit_InVprofile'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $phone = $_POST['new_phone'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $id = $_POST['get_UID'];

    list($res_u, $res_e, $res_n, $res_ph) = checkEditProfile($username, $name, $phone, $email, $id, $db);


    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: InSupervisor_pages/Ins_profile.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: InSupervisor_pages/Ins_profile.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: InSupervisor_pages/Ins_profile.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: InSupervisor_pages/Ins_profile.php');
    } else if (empty($password)) {

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: InSupervisor_pages/Ins_profile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    } else {

        $hashed_password = md5($password);

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email', password='$hashed_password' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: InSupervisor_pages/Ins_profile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit doctor profile 
if (isset($_POST['edit_DoCprofile'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $phone = $_POST['new_phone'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $id = $_POST['get_UID'];

    list($res_u, $res_e, $res_n, $res_ph) = checkEditProfile($username, $name, $phone, $email, $id, $db);



    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Doctor_pages/DocProfile.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Doctor_pages/DocProfile.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Doctor_pages/DocProfile.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Doctor_pages/DocProfile.php');
    } else if (empty($password)) {

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Doctor_pages/DocProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    } else {

        $hashed_password = md5($password);

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email', password='$hashed_password' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Doctor_pages/DocProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit nurse profile 
if (isset($_POST['edit_Nurseprofile'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $phone = $_POST['new_phone'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $id = $_POST['get_UID'];

    list($res_u, $res_e, $res_n, $res_ph) = checkEditProfile($username, $name, $phone, $email, $id, $db);

    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Nurse_pages/NurseProfile.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Nurse_pages/NurseProfile.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Nurse_pages/NurseProfile.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Nurse_pages/NurseProfile.php');
    } else if (empty($password)) {

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Nurse_pages/NurseProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    } else {

        $hashed_password = md5($password);

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email', password='$hashed_password' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Nurse_pages/NurseProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit OutPatient profile 
if (isset($_POST['edit_OutPatientprofile'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $phone = $_POST['new_phone'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $id = $_POST['get_UID'];

    list($res_u, $res_e, $res_n, $res_ph) = checkEditProfile($username, $name, $phone, $email, $id, $db);



    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: OutPatient_pages/OutPatientProfile.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: OutPatient_pages/OutPatientProfile.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: OutPatient_pages/OutPatientProfile.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: OutPatient_pages/OutPatientProfile.php');
    } else if (empty($password)) {

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: OutPatient_pages/OutPatientProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    } else {

        $hashed_password = md5($password);

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email', password='$hashed_password' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: OutPatient_pages/OutPatientProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}

//edit AdminProfile profile 
if (isset($_POST['edit_Adminprofile'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $phone = $_POST['new_phone'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $id = $_POST['get_UID'];

    list($res_u, $res_e, $res_n, $res_ph) = checkEditProfile($username, $name, $phone, $email, $id, $db);

    if (mysqli_num_rows($res_u) > 0) {
        $_SESSION['ERRORusername_message'] = true;
        header('Location: Admin_pages/AdminProfile.php');
    } else if (mysqli_num_rows($res_e) > 0) {
        $_SESSION['ERRORemail_message'] = true;
        header('Location: Admin_pages/AdminProfile.php');
    } else if (mysqli_num_rows($res_n) > 0) {
        $_SESSION['ERRORname_message'] = true;
        header('Location: Admin_pages/AdminProfile.php');
    } else if (mysqli_num_rows($res_ph) > 0) {
        $_SESSION['ERRORphoneNumber_message'] = true;
        header('Location: Admin_pages/AdminProfile.php');
    } else if (empty($password)) {

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Admin_pages/AdminProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    } else {

        $hashed_password = md5($password);

        $query = "UPDATE users SET name= '$name',  username='$username', PhoneNumber= '$phone', email='$email', password='$hashed_password' WHERE UID = '" . $id . "'";

        if ($db->query($query) === TRUE) {

            $_SESSION['edit_profile'] = true;
            header('Location: Admin_pages/AdminProfile.php');
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            exit();
        }
    }
}


//send reminder
if (isset($_GET['sendReminder'])) {
    $email = $_GET['email'];
    $A_ID = $_GET['ID'];
    $A_Date = $_GET['A_Date'];
    $A_Time = $_GET['A_Time'];
    $name = $_GET['name'];

    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["a_date"] = $A_Date;
    $_SESSION["a_time"] = $A_Time;

    header('Location: Doctor_pages/D_My_appointments.php');
}
