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
    <title>LMS - Manage Books</title>
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
    <h1>Manage Books</h1>

    <!--    <div class="row">-->
    <div class="d-flex flex-row" style="margin: 20px 0px 20px 10px;">
        <div class="p-2">
            <div class="row">
                <div class="feature-title">Search for a book</div>
                <input type="text" class="form-control" id="search" placeholder="Type the book name">
            </div>

            <button type="button" id="viewTable" class="btn btn-primary" style="margin-top: 10px"><span
                        class="glyphicon glyphicon-plus">View All </span></button>
        </div>

        <div class="ml-auto p-2">
            <button type="button" id="addBook" class="btn btn-success" style="margin: 20px" title="Add book"><span
                        class="glyphicon glyphicon-plus">Add New Book</span></button>
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
<div id="bookModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="bookForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="book" class="control-label">ISBN No</label>
                        <input type="text" name="isbn" id="isbn" autocomplete="off" class="form-control"
                               placeholder="isbn name" oninput="checkIsbn()" required/>
                        <span id="check-isbn"></span>

                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Book</label>
                        <input type="text" name="name" id="name" autocomplete="off" class="form-control"
                               placeholder="book name" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Edition</label>
                        <input type="text" name="edition" id="edition" autocomplete="off" class="form-control"
                               placeholder="Edition" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Price</label>
                        <input type="number" name="price" id="price" autocomplete="off" class="form-control"
                               placeholder="Price" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Year</label>
                        <input type="number" name="year" id="year" autocomplete="off" class="form-control"
                               placeholder="Year" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Publisher</label>
                        <input type="text" name="publisher" id="publisher" autocomplete="off" class="form-control"
                               placeholder="Publisher" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Image URL</label>
                        <input type="text" name="imgUrl" id="imgUrl" autocomplete="off" class="form-control"
                               placeholder="Image URL" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Author</label>
                        <input type="text" name="author" id="author" autocomplete="off" class="form-control"
                               placeholder="Author" required/>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Category</label>
                        <select class="form-control" id="category" name="category"/>
                        <option value="" selected disabled>Select</option>
                        <option value="">Science</option>
                        <option value="Enable">Maths</option>
                        <option value="Enable">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Rack</label>
                        <input type="text" name="rack" id="rack" autocomplete="off" class="form-control"
                               placeholder="Rack" required/>
                    </div>
                    <div class="form-group">
                        <label for="book" class="control-label">Shell</label>
                        <input type="text" name="shell" id="shell" autocomplete="off" class="form-control"
                               placeholder="Shell" required/>
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
    if (isset($_POST['save'])) {
        try {
            include 'model/Book.php';
            $book = new Book();
            $isbn = $book->setIsbn($_POST["isbn"]);
            $name = $book->setTitle($_POST["name"]);
            $edition = $book->setEdition($_POST["edition"]);
            $price = $book->setPrice($_POST["price"]);
            $year = $book->setYear($_POST["year"]);
            $publisher = $book->setPublisher($_POST["publisher"]);
            $imgUrl = $book->setImageUrl($_POST["imgUrl"]);
            $author = $book->setAuthor($_POST["author"]);
            $category = $book->setCategory($_POST["category"]);
            $rack = $book->setRack($_POST["rack"]);
            $shell = $book->setShell($_POST["shell"]);

            //Write to db
            try {
                include 'repository/BookService.php';
                $add = new BookService();
                $check = $add->addBook($book);

                if ($check == 1) {
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Book details saved successfully!',";
                    echo "}).then((result) => {";
                    echo "});";
                    echo "});";
                    echo "</script>";
                } else {
                    echo "<script> alert('Book adding failed!');</script>";
                }
            } catch (Exception $ex) {
                echo $ex;
//                echo "<script> alert('There is an existing book to this ISBN number! Please check again.');</script>";
            }
        } catch (PDOException $th) {
            echo $th;
        }

    }

    if (isset($_POST["viewBook"])) {
            $_SESSION["bookId"] =$_POST["viewBook"];
        echo '<script>window.location.href = "book-info.php";</script>';
    }
}
?>
<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {

        $('#addBook').click(function () {
            $('#bookModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#bookModal").on("shown.bs.modal", function () {
                $('#bookForm')[0].reset();
                $('.modal-title').html(" Add book");
                $('#save').val('Save');
            });
        });

        //get the full table
        $.ajax({
            url: 'ajax/get-book-table.php',
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
                    url: 'ajax/get-book-table.php',
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

        function checkIsbn() {
        $.ajax({
            url: "ajax/check-isbn.php",
            data: 'isbn=' + $("#isbn").val(),
            type: "POST",
            success: function (data) {
                $("#check-isbn").html(data);
            }
        });
    }
</script>
</body>
</html>
