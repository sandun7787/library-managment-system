<?php
include '../connection/config.php';
$conn = getCon();
$query = "SELECT `name` FROM book WHERE isbn='" . $_POST["isbn"] . "'";
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
    echo "<span style='color:red'> Invalid ISBN</span>";
    echo "<script>$('#saveRec').prop('disabled',true);</script>";
    echo'</div>';
}
?>