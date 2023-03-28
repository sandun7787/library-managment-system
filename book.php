<?php
//require("login-check/logincheck_D.php");
include("connection/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LMS-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="Images/favicon.ico"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
<!--    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>-->

    <script>
        $(document).ready(function() {

            $('#addBook').click(function () {
                $('#bookModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#bookModal").on("shown.bs.modal", function () {
                    $('#bookForm')[0].reset();
                    $('.modal-title').html("<i class='fa fa-plus'></i> Add book");
                    $('#action').val('addBook');
                    $('#save').val('Save');
                });
            });
        });
    </script>
</head>
<body id="body-pd">
<?php include("Includes/navbar.php") ?>

<!--Container Main start-->
<div class="main container">
    <h4>Books</h4>
    <div class="col-md-2" align="right">
        <button type="button" id="addBook" class="btn btn-info" title="Add book"><span class="glyphicon glyphicon-plus">Add Book</span></button>
    </div>
    <div id="bookModal" class="modal fade" >
        <div class="modal-dialog">
            <form method="post" id="bookForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Edit book</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="book" class="control-label">Book</label>
                            <input type="text" name="name" id="name" autocomplete="off" class="form-control" placeholder="book name" required/>

                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">ISBN No</label>
                            <input type="text" name="isbn" id="isbn" autocomplete="off" class="form-control" placeholder="isbn name" required/>

                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Edition</label>
                            <input type="text" name="edition" id="edition" autocomplete="off" class="form-control" placeholder="Edition" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Price</label>
                            <input type="number" name="price" id="price" autocomplete="off" class="form-control" placeholder="Price" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Year</label>
                            <input type="number" name="year" id="year" autocomplete="off" class="form-control" placeholder="Year" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Publisher</label>
                            <input type="text" name="publisher" id="publisher" autocomplete="off" class="form-control" placeholder="Publisher" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Image URL</label>
                            <input type="text" name="imgUrl" id="imgUrl" autocomplete="off" class="form-control" placeholder="Image URL" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Author</label>
                            <input type="text" name="author" id="author" autocomplete="off" class="form-control" placeholder="Author" required/>
                        </div>



<!--                        <div class="form-group">-->
<!--                            <label for="author" class="control-label">Author</label>-->
<!--                            <select name="author" id="author" class="form-control">-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php
//                                $authorResult = $book->getAuthorList();
//                                while ($author = $authorResult->fetch_assoc()) {
//                                    ?>
<!--                                    <option value="--><?php //echo $author['authorid']; ?><!--">--><?php //echo $author['name']; ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->


<!--                        <div class="form-group">-->
<!--                            <label for="publisher" class="control-label">Publisher</label>-->
<!--                            <select name="publisher" id="publisher" class="form-control">-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php
//                                $publisherResult = $book->getPublisherList();
//                                while ($publisher = $publisherResult->fetch_assoc()) {
//                                    ?>
<!--                                    <option value="--><?php //echo $publisher['publisherid']; ?><!--">--><?php //echo $publisher['name']; ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="category" class="control-label">Category</label>-->
<!--                            <select name="category" id="category" class="form-control">-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php
//                                $categoryResult = $book->getCategoryList();
//                                while ($category = $categoryResult->fetch_assoc()) {
//                                    ?>
<!--                                    <option value="--><?php //echo $category['categoryid']; ?><!--">--><?php //echo $category['name']; ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="rack" class="control-label">Rack</label>-->
<!--                            <select name="rack" id="rack" class="form-control">-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php
//                                $rackResult = $book->getRackList();
//                                while ($rack = $rackResult->fetch_assoc()) {
//                                    ?>
<!--                                    <option value="--><?php //echo $rack['rackid']; ?><!--">--><?php //echo $rack['name']; ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->


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
                            <input type="text" name="rack" id="rack" autocomplete="off" class="form-control" placeholder="Rack" required/>
                        </div>

                        <div class="form-group">
                            <label for="book" class="control-label">Shell</label>
                            <input type="text" name="shell" id="shell" autocomplete="off" class="form-control" placeholder="Shell" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="bookid" id="bookid" />
                        <input type="hidden" name="action" id="action" value="" />
                        <input type="submit" name="save" id="save" class="btn btn-success" value="Save" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save'])) {
//        echo '<script>console.log("done!")</script>';

        try {
            include 'model/Book.php';
            $book =new Book();
            $isbn=$book->setIsbn($_POST["isbn"]);
            $name=$book->setTitle($_POST["name"]);
            $edition=$book->setEdition($_POST["edition"]);
            $price=$book->setPrice($_POST["price"]);
            $year=$book->setYear($_POST["year"]);
            $publisher=$book->setPublisher($_POST["publisher"]);
            $imgUrl=$book->setImageUrl($_POST["imgUrl"]);
            $author=$book->setAuthor($_POST["author"]);
            $category=$book->setCategory($_POST["category"]);
            $rack=$book->setRack($_POST["rack"]);
            $shell=$book->setShell($_POST["shell"]);

//            Write to db
            try {
                include 'repository/BookService.php';
                $add = new BookService();
                $check=$add->addBook($book);

                if ($check==1){
                    echo "<script> alert('Book added Successfully!');</script>";
                }
                else{
                    echo "<script> alert('Book adding failed!');</script>";
                }
            }
            catch(Exception $ex){
//                echo $ex;
                echo "<script> alert('There is an existing book to this ISBN number! Please check again.');</script>";
            }
        } catch (PDOException $th) {
            echo $th;
        }
    }
}
?>
<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="js/alert.js"></script>

</body>
</html>
