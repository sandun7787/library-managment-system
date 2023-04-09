<?php
session_start();
$link="./login.php";
if(!isset($_SESSION["M_ID"]))
{
    echo '<script>window.location.href = "'.$link.'";</script>';
}
?>