<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
include("connection/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SACK-LMS</title>
    <!--    --><?php //include("Includes/head.php");?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="Images/favicon.ico"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body id="body-pd">
<?php include("Includes/navbar.php");?>
<?php
$id = $_SESSION['bookId'];
include 'repository/BookService.php';
include 'model/Book.php';
$bookS = new BookService();
$book=new Book();
try {

    $result=$bookS->getBook($id);

    foreach ($result as $row) {
        $isbn =$row[0];
        $title=$row[1];
        $edition=$row[2];
        $price=$row[3];
        $year=$row[4];
        $publisher=$row[5];
        $imageUrl=$row[6];
        $author=$row[7];
        $category=$row[8];
        $rack=$row[9];
        $shell=$row[10];
    }
} catch (PDOException $th) {
    echo $th->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save'])) {

        try {
            $isbn=$book->setIsbn($id);
            $name=$book->setTitle($_POST['title']);
            $edition=$book->setEdition($_POST['edition']);
            $price=$book->setPrice($_POST['price']);
            $year=$book->setYear($_POST['year']);
            $publisher=$book->setPublisher($_POST['publisher']);
            $imgUrl=$book->setImageUrl($_POST['imgUrl']);
            $author=$book->setAuthor($_POST['author']);
            $category=$book->setCategory($_POST['category']);
            $rack=$book->setRack($_POST['rack']);
            $shell=$book->setShell($_POST['shell']);

            //  Write to db
            try {
                $check=$bookS->updateBook($book);
                if ($check==1){
                    echo "<script>";
                    echo "$(document).ready(function() {";
                    echo "Swal.fire({";
                    echo " icon: 'success',";
                    echo "text: 'Book details updated successfully!',";
                    echo "}).then((result) => {";
                    echo "window.history.back();";
                    echo "});";
                    echo "});";
                    echo "</script>";
                }
                else{
                    echo "<script> alert(' Failed!');</script>";
                }
            }
            catch(Exception $ex){
                echo $ex;
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {

        try {
            $delete=$bookS->deleteBook($id);
            if ($delete==1){
                try {
                    $delete = $bookS->deleteBook($id);
                    if ($delete == 1) {
                        echo "<script>";
                        echo "$(document).ready(function() {";
                        echo "Swal.fire({";
                        echo " icon: 'success',";
                        echo "text: 'Book deleted successfully!',";
                        echo "}).then((result) => {";
                        echo "window.location.href = 'book.php'";
                        echo "});";
                        echo "});";
                        echo "</script>";
                    } else {
                        echo "<script> alert('failed!');</script>";
                    }
                } catch (PDOException $th) {
                    echo $th->getMessage();
                }
            }
            else{
                echo "<script> alert('failed!');</script>";
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>

<!--Container Main start-->
<div class="main container">

    <div class="row">
        <div class="col-md-4" style="margin: auto">
<!--            <img src="https://via.placeholder.com/200x300" alt="Book Cover" class="img-fluid book-cover">-->
            <img src="<?php echo $imageUrl;?>" alt="Book Cover" class="img-fluid book-cover">
        </div>
        <div class="col-md-8">
            <h1 class="mb-4">Book Details</h1>
            <form method="post" enctype="multipart/form-data" action="" class="book-form">
                <div class="row mb-3">
                    <label for="isbn" class="col-sm-3 col-form-label">ISBN</label>
                    <div class="col-sm-9">
                        <label for="isbn" class="col-sm-3 col-form-label" name="isbn"><?php echo $isbn;?></label>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="book-name" class="col-sm-3 col-form-label">Book Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="book-name" name="title" value="<?php echo $title;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author" class="col-sm-3 col-form-label">Author</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="author" name="author" value="<?php echo $author;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="category" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="category" name="category" disabled>
                            <option value="Science" <?php if($category=="Science"){ echo ' selected="selected"';}?>>Science</option>
                            <option value="Mathematics"  <?php if($category=="Mathematics"){ echo ' selected="selected"';}?>>Mathematics</option>
                            <option value="Social Studies"  <?php if($category=="Social Studies"){ echo ' selected="selected"';}?>>Social Studies</option>
                            <option value="Language Arts"  <?php if($category=="Language Arts"){ echo ' selected="selected"';}?>>Language Arts</option>
                            <option value="Business and Careers"  <?php if($category=="Business and Careers"){ echo ' selected="selected"';}?>>Business and Careers</option>
                            <option value="Health and Physical Education"  <?php if($category=="Health and Physical Education"){ echo ' selected="selected"';}?>>Health and Physical Education</option>
                            <option value="Technology and Engineering"  <?php if($category=="Technology and Engineering"){ echo ' selected="selected"';}?>>Technology and Engineering</option>
                            <option value="Arts and Humanities"  <?php if($category=="Arts and Humanities"){ echo ' selected="selected"';}?>>Arts and Humanities</option>
                            <option value="English"  <?php if($category=="English"){ echo ' selected="selected"';}?>>English</option>
                            <option value="World Languages"  <?php if($category=="World Languages"){ echo ' selected="selected"';}?>>World Languages</option>
                            <option value="Civics and Government"  <?php if($category=="Civics and Government"){ echo ' selected="selected"';}?>>Civics and Government</option>
                            <option value="Media and Communications"  <?php if($category=="Media and Communications"){ echo ' selected="selected"';}?>>Media and Communications</option>
                            <option value="Psychology and Sociology"  <?php if($category=="Psychology and Sociology"){ echo ' selected="selected"';}?>>Psychology and Sociology</option>
                            <option value="Philosophy and Ethics"  <?php if($category=="Philosophy and Ethics"){ echo ' selected="selected"';}?>>Philosophy and Ethics</option>
                            <option value="Education and Teaching"  <?php if($category=="Education and Teaching"){ echo ' selected="selected"';}?>>Education and Teaching</option>
                            <option value="Law and Legal Studies"  <?php if($category=="Law and Legal Studies"){ echo ' selected="selected"';}?>>Law and Legal Studies</option>
                            <option value="Religion and Theology"  <?php if($category=="Religion and Theology"){ echo ' selected="selected"';}?>>Religion and Theology</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edition" class="col-sm-3 col-form-label">Edition</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edition" name="edition" value="<?php echo $edition;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="publisher" class="col-sm-3 col-form-label">Publisher</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $publisher;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rack-number" class="col-sm-3 col-form-label">Year</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="year" name="year" value="<?php echo $year;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="shelf-number" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rack-number" class="col-sm-3 col-form-label">Rack Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="rack-number" name="rack" value="<?php echo $rack;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="shelf-number" class="col-sm-3 col-form-label">Shelf Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="shelf-number" name="shell" value="<?php echo $shell;?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="shelf-number" class="col-sm-3 col-form-label">Image URL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="imgUrl" value="<?php echo $imageUrl;?>" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" id="edit-btn">Update Book</button>
                        <input type="submit" class="btn btn-success d-none" id="save-btn" value="Save" name="save">
                        <input type="submit" class="btn btn-danger" id="delete-btn" value="Delete Book" name="delete">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back to Previous Page</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Container Main end-->
<script src="js/navbar.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(function () {
        $('#edit-btn').click(function () {
            $('input').prop('disabled', false);
            $('#category').prop('disabled', false);
            $('#edit-btn').addClass('d-none');
            $('#save-btn').removeClass('d-none');
        });
    });
</script>
</body>
</html>
