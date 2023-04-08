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
    <h1>Manage Members</h1>

    <!--    <div class="row">-->
    <div class="d-flex flex-row" style="margin: 20px 0px 20px 10px;">
        <div class="p-2">
            <div class="row">
                <div class="feature-title">Search for members</div>
                <input type="text" class="form-control" id="search" placeholder="Type the member name">
            </div>

            <button type="button" id="viewTable" class="btn btn-primary" style="margin-top: 10px"><span
                        class="glyphicon glyphicon-plus">View All </span></button>
        </div>

        <div class="ml-auto p-2">
            <button type="button" id="addMember" class="btn btn-success" style="margin: 20px" title="Add member"><span
                        class="glyphicon glyphicon-plus">Add New member</span></button>
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

<!--popup template for add member-->
<div id="memberModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="MemberForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i>Add Member</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="member" class="control-label">Member Id</label>
                        <input type="text" name="memberId" id="memberId" autocomplete="off" class="form-control"
                               placeholder="MemberID" oninput="checkMemberId()" required/>
                        <span id="check-member"></span>
                    </div>
                    <div class="form-group">
                        <label for="member" class="control-label">Name</label>
                        <input type="text" name="name" id="name" autocomplete="off" class="form-control"
                               placeholder="Member Name" required/>
                    </div>
                    <div class="form-group">
                        <label for="member" class="control-label">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" class="form-control"
                               placeholder="email" required/>
                    </div>
                    <div class="form-group">
                        <label for="member" class="control-label">Mobile Number</label>
                        <input type="number" name="mobileNo" id="mobileNo" autocomplete="off" class="form-control"
                               placeholder="Mobile Number" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Image URL</label>
                        <input type="text" name="imgUrl" id="imgUrl" autocomplete="off" class="form-control"
                               placeholder="Image URL" required/>
                    </div>
                </div>
                <div class="modal-footer">
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
    if (isset($_POST['save'])) try {
        include 'model/Member.php';
        $member = new Member();
        $memberid = $member->setMemberId($_POST["memberId"]);
        $name = $member->setName($_POST["name"]);
        $email = $member->setEmail($_POST["email"]);
        $mobilenumber = $member->setNo($_POST["mobileNo"]);
        $imgUrl = $member->setImgUrl($_POST["imgUrl"]);
        $password=$member->setPassword("1234");


        //Write to db
        try {
            include 'repository/MemberService.php';
            $add = new MemberService();
            $check = $add->addDetails($member);

            if ($check == 1) {
                echo "<script>";
                echo "$(document).ready(function() {";
                echo "Swal.fire({";
                echo " icon: 'success',";
                echo "text: 'Member details saved successfully!',";
                echo "}).then((result) => {";
                echo "});";
                echo "});";
                echo "</script>";
            } else {
                echo "<script> alert('Member adding failed!');</script>";
            }
        } catch (Exception $ex) {
            echo $ex;
//                echo "<script> alert('There is an existing Member to this Member id! Please check again.');</script>";
        }
    } catch (PDOException $th) {
        echo $th;
    }

    if (isset($_POST["changeState"])) {
        include 'repository/MemberService.php';
        $state = new MemberService();
        $valueArr = explode(',', $_POST["changeState"]);

        echo $valueArr[1];
        if ($valueArr[1]==1){
            $check = $state->ChangeStatus($valueArr[0],"inactive");
            if ($check == 1) {
                echo "<script>";
                echo "$(document).ready(function() {";
                echo "Swal.fire({";
                echo " icon: 'success',";
                echo "text: 'State changed to inactive successfully!',";
                echo "}).then((result) => {";
                echo "});";
                echo "});";
                echo "</script>";
            } else {
                echo "<script> alert(' failed!');</script>";
            }

        }else if($valueArr[1]==2){
            $check = $state->ChangeStatus($valueArr[0],"active");
            if ($check == 1) {
                echo "<script>";
                echo "$(document).ready(function() {";
                echo "Swal.fire({";
                echo " icon: 'success',";
                echo "text: 'State changed to active successfully!',";
                echo "}).then((result) => {";
                echo "});";
                echo "});";
                echo "</script>";
            } else {
                echo "<script> alert('failed!');</script>";
            }
        }

    }
}
?>
<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {

        $('#addMember').click(function () {
            $('#memberModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#memberModal").on("shown.bs.modal", function () {
                $('#memberForm')[0].reset();
                $('.modal-title').html("Add member");
                $('#save').val('Save');
            });
        });

        //get the full table
        $.ajax({
            url: 'ajax/get-member-table.php',
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
                    url: 'ajax/get-member-table.php',
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

        function checkMemberId() {
        $.ajax({
            url: "ajax/check-member.php",
            data: 'memberId=' + $("#memberId").val(),
            type: "POST",
            success: function (data) {
                $("#check-member").html(data);
            }
        });
    }
</script>
</body>
</html>
