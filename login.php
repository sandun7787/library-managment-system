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

//member login


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["btnSubmit"])) {
                        try {
                            $id =$_POST["memberID"];
                            $password = md5($_POST["memberPW"]);
                            include 'repository/MemberService.php';
                            $loginM = new MemberService();
                            $result=$loginM->memberLogin($id, $password);

                            if ($result[0] == $_POST["memberID"]) {
                                $_SESSION["m_id"] = $result[0];
                             
                                echo '<script>window.location.href = "book.php";</script>';
                            } else {
                                echo '<script>alert("Incorrect user ID or password")</script>';
                            }
                        } catch (PDOException $th) {
                            echo $th->getMessage();
                        }
                    }
                }
                error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

                // admin login


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["btnAdmSubmit"])) {
                        try {
                            $id =$_POST["adminID"];
                            $password = md5($_POST["adminPW"]);
                            include 'repository/MemberService.php';
                            $loginM = new MemberService();
                            $result=$loginM->adminLogin($id, $password);

                            if ($result[0] == $_POST["adminID"]) {
                                $_SESSION["a_id"] = $result[0];
                             
                                echo '<script>window.location.href = "book.php";</script>';
                            } else {
                                echo '<script>alert("Incorrect user ID or password")</script>';
                            }
                        } catch (PDOException $th) {
                            echo $th->getMessage();
                        }
                    }
                }
                error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);



                ?>



<!--Container Main end-->
<script src="js/navbar.js"></script>
</body>
</html>
