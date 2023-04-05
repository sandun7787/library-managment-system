<?php
include '../connection/config.php';
$conn = getCon();
$query = "SELECT `id`, `name` FROM member WHERE id='" . $_POST["memberId"] . "'";
$result = $conn->query($query);
$count = $result->rowCount();
if($count>0) {
    foreach ($result as $row) {
        echo'<div style="margin-top: 10px">';
        echo "<span style='color:green'>  ".$row['name']."</span>";
        echo "<script>$('#saveRec').prop('disabled',false);</script>";
        echo'</div>';
    }
}
else{
    echo'<div style="margin-top: 10px">';
    echo "<span style='color:red'> Invalid Member</span>";
    echo "<script>$('#saveRec').prop('disabled',true);</script>";
    echo'</div>';
}
?>