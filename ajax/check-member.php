<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
if (isset($_POST['query'])) {
    include '../connection/config.php';
    include '../repository/MemberService.php';
    $memberService = new MemberService();

    if ($_POST['query'] != null) {
        $result = $memberService->checkMember();
        $count = $result->rowCount();
        if($count>0) {
            echo'<div style="margin-top: 10px">';
            echo "<span style='color:red'> Member ID taken</span>";
            echo "<script>$('#save').prop('disabled',true);</script>";
            echo'</div>';
        }
        else{
            echo'<div style="margin-top: 10px">';
            echo "<span style='color:green'> Member ID available</span>";
            echo "<script>$('#save').prop('disabled',false);</script>";
            echo'</div>';
        }
    }
}
?>