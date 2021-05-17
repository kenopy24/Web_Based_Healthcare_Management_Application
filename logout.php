<!-- 
Name: Ang Weng Ken (TP045681)
Date created: ‎‎‎‎‎15 January, ‎2021
Date last edited: 15 January, ‎2021
-->
<?php
session_start();
session_unset();
session_destroy();
header("location:Login.php");
?>