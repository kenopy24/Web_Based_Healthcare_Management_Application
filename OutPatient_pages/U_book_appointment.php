<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎12 January, ‎2021
Date last edited: 1 March, ‎2021
-->
<!DOCTYPE html>
<?php
  
  session_start();
  include('../connection/conn.php');
  if($_SESSION['user'] != true){
    
    header("Location: ../login.php");
  }
  if(isset($_SESSION['message'])){
    
    echo '<script>alert("Appointment booking successful")</script>';
    unset($_SESSION['message']);
  }
  if(isset($_SESSION['bookedtime'])){
    
    echo '<script>alert("Appointment slot is full, please select another time slot.")</script>';
    unset($_SESSION['bookedtime']);
  }
  if(isset($_SESSION['alreadybookedtime'])){
    
    echo '<script>alert("You have already made an appointment, with the selected timeslot.")</script>';
    unset($_SESSION['alreadybookedtime']);
  }
  
 
  
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css" >
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
  <link rel="icon" href="../pictures/WHMAicon.png" type="image/x-icon">
  
  <title>Book appointment</title>
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
  <div class="mx-auto" style="width: 500px;">    
    <div class="shadow p-3 mb-5 bg-white rounded" style="width: 500px;" > 
        <form action="../process.php" method="POST">
            <input type="hidden" name="booking_form" value="">
            <div class="text-center mb-4">
                <h1>Appointment form</h1>
            </div>

            <label for="doctor">
							Doctors:
					  </label>
						<select name="doctor" class="form-control" id="doctor"  required="required">
						  
              <?php
                  $query= "SELECT * FROM users INNER JOIN doctors ON (users.UID = doctors.UID) WHERE usertype = 'Doctor'";
                  $result = $db->query($query);

                  if ($result->num_rows > 0) {
                    echo '<option value="" disabled selected>Select doctor</option>';
                    while($rows = $result->fetch_assoc()){

                      ?><option value="<?php echo $rows['ID'] ?>"><?php echo $rows['name']." ------ ".$rows['Spec_name']; ?></option><?php
                    }
                  }
              ?>
              
						</select>
            
            <label for="date-input" class="col-2 col-form-label">Date</label>
            <div class="col-10">
                <input class="form-control" type="date" id="date-input" name="date">
            </div>
            <br>
            <label for="timeslot" class="form-label">Time slot:</label>
            <select name="timeslot" class="form-control" id="timeslot" required="required" >
            <option value="" disabled selected>Select time slot</option>
              <option value="9:00 AM - 9:30 AM">9:00 AM - 9:30 PM</option>
              <option value="9:30 AM - 10:00 AM">9:30 AM - 10:00 AM</option>
              <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
              <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
              <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
              <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
              <option value="1:00 PM - 1:30 PM">1:00 PM - 1:30 PM</option>
              <option value="1:30 PM - 2:00 PM">1:30 PM - 2:00 PM</option>
              <option value="2:00 PM - 2:30 PM">2:00 PM - 2:30 PM</option>
              <option value="2:30 PM - 3:00 PM">2:30 PM - 3:00 PM</option>
              <option value="3:00 PM - 3:30 PM">3:00 PM - 3:30 PM</option>
              <option value="3:30 PM - 4:00 PM">3:30 PM - 4:00 PM</option>
              <option value="4:00 PM - 4:30 PM">4:00 PM - 4:30 PM</option>
              <option value="4:30 PM - 5:00 PM">4:30 PM - 5:00 PM</option>
              <option value="5:00 PM - 5:30 PM">5:00 PM - 5:30 PM</option>
              <option value="5:30 PM - 6:00 PM">5:30 PM - 6:00 PM</option>
            </select>
            <br>
            <div class="wrapper" >
                  <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
    </div>
  </div>
  </main>
  
 
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>