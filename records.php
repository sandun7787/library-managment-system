<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
//require("login-check/logincheck_D.php");
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

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body id="body-pd">
<?php include("Includes/navbar.php") ?>

<!--Container Main start-->
<div class="main container">
    <h1>Manage Borrowing Records</h1>

    <!--    <div class="row">-->
    <div class="d-flex flex-row" style="margin: 20px 0px 20px 10px;">
        <div class="p-2">
            <div class="row">
                <div class="feature-title">Search for a record</div>
                <input type="text" class="form-control" id="search" placeholder="Type the member ID">
            </div>

            <button type="button" id="viewTable" class="btn btn-primary" style="margin-top: 10px"><span
                    class="glyphicon glyphicon-plus">View All </span></button>
        </div>

        <div class="ml-auto p-2">
            <button type="button" id="addRecord" class="btn btn-success" style="margin: 20px" ><span
                    class="glyphicon glyphicon-plus">Add New Record</span></button>
        </div>
        <div class="ml-auto p-2" style="margin-left: 0px !important">
            <button type="button" id="viewOldRec" class="btn btn-primary" style="margin: 20px" onclick="window.location.href='old-records.php';" ><span
                        class="glyphicon glyphicon-plus">View Old Records</span></button>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data">
                <div id="result"></div>
            </form>
        </div>
    </div>
</div>

<!--popup template for add record-->
<div id="recordModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="recordForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="book" class="control-label">Book ID</label>
                        <input type="text" name="bookId" id="bookId" autocomplete="off" class="form-control"
                               placeholder="book id" oninput="getBook()" required/>
                        <span id="get-book"></span>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Member ID</label>
                        <input type="text" name="memberId" id="memberId" autocomplete="off" class="form-control"
                               placeholder="book name" oninput="getMember()" required/>
                        <span id="get-member"></span>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Borrow Date</label>
                        <input type="date" name="bDate" id="bDate" autocomplete="off" class="form-control" value="<?php echo $current_date = date("Y-m-d"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Due Date</label>
                        <input type="date" name="dDate" id="dDate" autocomplete="off" class="form-control"value="<?php echo $due_date = date('Y-m-d', strtotime($current_date . ' + 14 days')); ?>" disabled>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value=""/>
                    <input type="submit" name="saveRec" id="saveRec" class="btn btn-success" value="Save"/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
include 'repository/RecordService.php';
include 'model/Records.php';
$record = new Records();
$rec = new RecordService();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['saveRec'])) {
        try {

            $bookId = $record->setBookId($_POST["bookId"]);
            $name = $record->setUserId($_POST["memberId"]);
            $bDate = $record->setBDate($current_date);
            $dDate = $record->setDDate($due_date);



            //Write to db
            try {

                $check = $rec->addRecord($record);

                if ($check == 1) {
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Record saved successfully!',";
                    echo "}).then((result) => {";
                    echo "});";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "<script> alert('Record adding failed!');</script>";
                }
            } catch (Exception $ex) {
                echo $ex;
            }
        } catch (PDOException $th) {
            echo $th;
        }

    }

    if (isset($_POST["confirm"])) {
        $check = $rec->confirm($_POST["confirm"]);
        if ($check == 1) {
            echo "<script>";
            echo "$(document).ready(function() {";
            echo "Swal.fire({";
            echo " icon: 'success',";
            echo "text: 'Book received successfully!',";
            echo "}).then((result) => {";
            echo "});";
            echo "});";
            echo "</script>";
        } else {
            echo "<script> alert('Book receive failed!');</script>";
        }
    }
    if (isset($_POST["deleteRec"])) {
        $check = $rec->deleteRecord($_POST["deleteRec"]);
        if ($check == 1) {
            echo "<script>";
            echo "$(document).ready(function() {";
            echo "Swal.fire({";
            echo " icon: 'success',";
            echo "text: 'Record deleted successfully!',";
            echo "}).then((result) => {";
            echo "});";
            echo "});";
            echo "</script>";
        } else {
            echo "<script> alert('Book receive failed!');</script>";
        }
    }
}
//?>
<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {

        $('#addRecord').click(function () {
            $('#recordModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#recordModal").on("shown.bs.modal", function () {
                $('#recordForm')[0].reset();
                $('.modal-title').html(" Add record");
                $('#save').val('Save');
            });
        });

        //get the full table
        $.ajax({
            url: 'ajax/get-records-table.php',
            method: 'POST',
            dataType: "html",
            data: "query=",

            success: function (data) {
                $('#result').html(data);
                $('#result').css('display', 'block');
                $('#viewTable').css('display', 'none');
            }
        });

        //filter table
        $("#search").keyup(function () {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'ajax/get-records-table.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        $('#result').html(data);
                        $('#result').css('display', 'block');
                        $('#viewTable').css('display', 'block');

                    }
                });
            } else {
                $('#result').css('display', 'none');
            }
        });

        // reload table by button
        $('#viewTable').click(function () {
            window.location.reload();
        });

    });

    function getBook() {
        $.ajax({
            url: "ajax/get-book.php",
            data: 'bookId=' + $("#bookId").val(),
            type: "POST",
            success: function (data) {
                $("#get-book").html(data);
            }
        });
    }

    function getMember() {
        $.ajax({
            url: "ajax/get-member.php",
            data: 'memberId=' + $("#memberId").val(),
            type: "POST",
            success: function (data) {
                $("#get-member").html(data);
            }
        });
    }
</script>
</body>
</html>
