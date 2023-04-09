<?php
include '../connection/config.php';
$conn = getCon();
include '../repository/BookService.php';
    $bookService = new BookService();
    $result = $bookService->checkIsbn();
    $count = $result->rowCount();
    if($count>0) {
            echo'<div style="margin-top: 10px">';
            echo "<span style='color:red'> ISBN number taken</span>";
            echo "<script>$('#save').prop('disabled',true);</script>";
            echo'</div>';
    }
    else{
        echo'<div style="margin-top: 10px">';
        echo "<span style='color:green'> ISBN available</span>";
        echo "<script>$('#save').prop('disabled',false);</script>";
        echo'</div>';
    }
?>