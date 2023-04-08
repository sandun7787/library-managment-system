<?php
include '../connection/config.php';
$conn = getCon();
$query = "SELECT `name` FROM member WHERE id='" . $_POST["memberId"] . "'";
$result = $conn->query($query);
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
?>