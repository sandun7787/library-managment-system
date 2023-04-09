<?php
session_start();
include("connection/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SACK-LMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="Images/favicon.ico"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body id="body-pd">
<?php include("Includes/navbar.php") ?>

<!--Container Main start-->
<div class="main container">
    <h4>Main Components</h4>

    <form method="post">
        <input type="submit" name="click">

    </form>
</div>
<!--<input type="hidden" id="loginStatus" value="--><?php //if(isset($_SESSION["M_ID"]) || isset($_SESSION["A_ID"])){echo "true";}?><!--">-->

<!--Container Main end-->
<script src="js/navbar.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['click'])) {
        if (isset($_SESSION["A_ID"])) {
            echo $_SESSION["A_ID"];
        }else{
            echo "no a";
        }
        if (isset($_SESSION["M_ID"])) {
            echo $_SESSION["M_ID"];
        }
        else{
            echo "no m";
        }
    }
}
//if (isset($_SESSION["M_ID"]) || isset($_SESSION["A_ID"])) {
//    echo "<script>";
//    echo "$(document).ready(function() {";
//    echo "Swal.fire({";
//    echo " icon: 'success',";
//    echo "text: 'Login successfully!',";
//    echo "}).then((result) => {";
////    echo "window.location.href = 'dashboard.php'";
//    echo "});";
//    echo "});";
//    echo "</script>";
//
//}


error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>