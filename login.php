<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include("connection/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SACK-LMS</title>


<!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->

<!--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->

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


    <div class="login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Member Login</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your ID *" value="" name="memberID" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" value="" name="memberPW" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" name="btnSubmit"/>
                    </div>
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                <h3>Admin Login</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your ID *" value="" name="adminID" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" value="" name="adminPW" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" name="btnAdmSubmit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include 'repository/MemberService.php';
$memberService = new MemberService();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //member login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnSubmit"])) {
            try {
                $id =$_POST["memberID"];
                $password = md5($_POST["memberPW"]);
                $result=$memberService->memberLogin($id, $password);
                if ($result[0]== $_POST["memberID"]) {
                    $_SESSION["M_ID"] =$result[0];
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Login successfully!',";
                    echo "}).then((result) => {";
                    echo "window.location.href = 'dashboard.php'";
                    echo "});";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'warning',";
                    echo "text: 'Incorrect user name or password',";
                    echo "}).then((result) => {";
                    echo "});";
                    echo "});";
                    echo "</script>";
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }
    }

    // admin login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnAdmSubmit"])) {
            try {
                $id =$_POST["adminID"];
                $password = md5($_POST["adminPW"]);
                $result=$memberService->adminLogin($id, $password);
                if ($result[0] == $_POST["adminID"]) {
                    $_SESSION["A_ID"] = $result[0];
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Login successfully!',";
                    echo "}).then((result) => {";
                    echo "window.location.href = 'dashboard.php'";
                    echo "});";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'warning',";
                    echo "text: 'Incorrect user name or password',";
                    echo "}).then((result) => {";
                    echo "});";
                    echo "});";
                    echo "</script>";
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }
    }
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
}

if (isset($_SESSION["M_ID"])) {
    $result = $memberService->getMember($_SESSION["M_ID"]);
    foreach ($result as $row) {
        $_SESSION["nav_Name"]=$row[1];
        $_SESSION["nav_Img"]=$row[6];
    }
}
else {
    $_SESSION["nav_Name"]="Admin";
    $_SESSION["nav_Img"]="https://cdn3.iconfinder.com/data/icons/user-group-black/100/user-process-512.png";
}
?>



<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
