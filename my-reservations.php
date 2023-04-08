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
    <h1>Manage My Reservations</h1>

    <!--    <div class="row">-->
    <div class="d-flex flex-row" style="margin: 20px 0px 20px 10px;">
        <div class="p-2">
            <div class="row">
                <div class="feature-title">Search for a book reservation</div>
                <input type="text" class="form-control" id="search" placeholder="Type the book name">
            </div>

            <button type="button" id="viewTable" class="btn btn-primary" style="margin-top: 10px"><span
                    class="glyphicon glyphicon-plus">View All </span></button>
        </div>

        <div class="ml-auto p-2">
            <button type="button" id="addReservation" class="btn btn-success" style="margin: 20px" ><span
                    class="glyphicon glyphicon-plus">Add New Reservation</span></button>
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

<!--popup template for add book-->
<div id="reservationModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="reservationForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="book" class="control-label">Requesting Date</label>
                        <input type="date" name="reqDate" id="reqDate" autocomplete="off" class="form-control"
                               placeholder="requesting date" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Book Name</label>
                        <input type="text" name="name" id="name" autocomplete="off" class="form-control"
                               placeholder="book name"  required/>
                        <span id="check-isbn"></span>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data">
                                <div id="bookCheck"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="bookid" id="bookid"/>
                    <input type="hidden" name="action" id="action" value=""/>
                    <input type="submit" name="save" id="save" class="btn btn-success" value="Save"/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'model/Reservation.php';
    include 'repository/ReservationService.php';
    $res = new Reservation();
    $resS = new ReservationService();

    if (isset($_POST['save'])) {
        try {
            $bookId = $res->setBookId($_SESSION['ResBookId']);
            $userId = $res->setUserId("9563");
            $resDate = $res->setReservationDate(date("Y-m-d") );
            $reqDate = $res->setRequestedDate($_POST["reqDate"]);


            //Write to db
            try {
                $check = $resS->addReservation($res);
                if ($check == 1) {
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Reservation added successfully!',";
                    echo "}).then((result) => {";
                    echo "});";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "<script> alert('Reservation adding failed!');</script>";
                }
            } catch (Exception $ex) {
                echo $ex;
//                echo "<script> alert('There is an existing book to this ISBN number! Please check again.');</script>";
            }
        } catch (PDOException $th) {
            echo $th;
        }

    }

    if (isset($_POST["delRes"])) {

        try {
            $delete=$resS->deleteReservation($_POST["delRes"]);
            if ($delete == 1) {
                echo "<script>";
                echo "$(document).ready(function() {";
                echo "Swal.fire({";
                echo " icon: 'success',";
                echo "text: 'Reservation deleted successfully!',";
                echo "}).then((result) => {";
                echo "});";
                echo "});";
                echo "</script>";
            } else {
                echo "<script> alert('failed!');</script>";
            }
        } catch (PDOException $th) {
//            echo $th->getMessage();
        }
    }
}
?>
<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {

        $('#addReservation').click(function () {
            $('#reservationModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#reservationModal").on("shown.bs.modal", function () {
                $('#reservationForm')[0].reset();
                $('.modal-title').html(" Add Reservation");
                $('#save').val('Save');
            });
        });

        //filter available books for reservation form
        $("#name").keyup(function () {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'ajax/check-books-for-reservation.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        $('#bookCheck').html(data);
                        $('#bookCheck').css('display', 'block');
                        $('#viewTable').css('display', 'block');

                    }
                });
            } else {
                $('#bookCheck').css('display', 'none');
            }
        });

        //get the full table
        $.ajax({
            url: 'ajax/get-my-reservations.php',
            method: 'POST',
            dataType: "html",
            data: "query=",

            success: function (data) {
                $('#result').html(data);
                $('#result').css('display', 'block');
                $('#viewTable').css('display', 'none');
            }
        });

        // filter table
        $("#search").keyup(function () {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'ajax/get-my-reservations.php',
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

</script>
</body>
</html>
