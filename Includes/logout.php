<?php
session_start();
$link="../login.php";
if (isset($_SESSION["M_ID"])) {
    unset($_SESSION["M_ID"]);
    unset($_SESSION["nav_Name"]);
    unset($_SESSION["nav_Img"]);
    echo '<script>window.location.href = "'.$link.'";</script>';
} elseif (isset($_SESSION["A_ID"])) {
    unset($_SESSION["A_ID"]);
    unset($_SESSION["nav_Name"]);
    unset($_SESSION["nav_Img"]);
    echo '<script>window.location.href = "'.$link.'";</script>';
}else{
    echo "<script>alert('Not logged in')</script>";
    echo '<script>window.location.href = "'.$link.'";</script>';

}
?>