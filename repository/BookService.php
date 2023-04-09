<?php
session_start();

interface IBook
{
    public function addBook(Book $book);
    public function getBook($bookId);
    public function updateBook(Book $book);
    public function deleteBook($bookId);
    public function getAllBooks();
    public function getFilteredBooks();
    public function bookCount($isbn);
    public function getBookIds($isbn);
    public function checkBook();
    public function checkIsbn();


}

class BookService implements IBook
{


    public function addBook(Book $book)
    {
        try {
            $conn = getCon();

            $isbn = $book->getIsbn();
            $name = $book->getTitle();
            $edition = $book->getEdition();
            $price = $book->getPrice();
            $year = $book->getYear();
            $publisher = $book->getPublisher();
            $imgUrl = $book->getImageUrl();
            $author = $book->getAuthor();
            $category = $book->getCategory();
            $rack = $book->getRack();
            $shell = $book->getShell();
            $noc = $book->getNumOfBooks();

            $x = 1;
            while ($x <= $noc) {
                $query = "INSERT INTO `book`(`isbn`, `name`, `edition`, `price`, `year`, `pub`, `imgUrl`, `author`, `cat`, `rack`, `shell`)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                $st = $conn->prepare($query);

                $st->bindValue(1, $isbn, PDO::PARAM_STR);
                $st->bindValue(2, $name, PDO::PARAM_STR);
                $st->bindValue(3, $edition, PDO::PARAM_STR);
                $st->bindValue(4, $price, PDO::PARAM_STR);
                $st->bindValue(5, $year, PDO::PARAM_STR);
                $st->bindValue(6, $publisher, PDO::PARAM_STR);
                $st->bindValue(7, $imgUrl, PDO::PARAM_STR);
                $st->bindValue(8, $author, PDO::PARAM_STR);
                $st->bindValue(9, $category, PDO::PARAM_STR);
                $st->bindValue(10, $rack, PDO::PARAM_STR);
                $st->bindValue(11, $shell, PDO::PARAM_STR);
                $st->execute();
                $x++;
            }
            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function getBook($bookId)
    {
        $conn = getCon();
        $query = "SELECT `isbn`, `name`, `edition`, `price`, `year`, `pub`, `imgUrl`, `author`, `cat`, `rack`, `shell`,`bookId` FROM `book` WHERE `bookId` =$bookId ";
        $result = $conn->query($query);
        return $result;
    }

    public function updateBook(Book $book)
    {
        try {
            $conn = getCon();

            $bookId = $book->getBookId();
            $isbn = $book->getIsbn();
            $name = $book->getTitle();
            $edition = $book->getEdition();
            $price = $book->getPrice();
            $year = $book->getYear();
            $publisher = $book->getPublisher();
            $imgUrl = $book->getImageUrl();
            $author = $book->getAuthor();
            $category = $book->getCategory();
            $rack = $book->getRack();
            $shell = $book->getShell();


            $query = "UPDATE `book` SET `name`=?,`edition`=?,`price`=?,`year`=?,`pub`=?,`imgUrl`=?,`author`=?,`cat`=?,`rack`=?,`shell`=? WHERE `isbn` = $isbn";

            $st = $conn->prepare($query);
            $st->bindValue(1, $name, PDO::PARAM_STR);
            $st->bindValue(2, $edition, PDO::PARAM_STR);
            $st->bindValue(3, $price, PDO::PARAM_STR);
            $st->bindValue(4, $year, PDO::PARAM_STR);
            $st->bindValue(5, $publisher, PDO::PARAM_STR);
            $st->bindValue(6, $imgUrl, PDO::PARAM_STR);
            $st->bindValue(7, $author, PDO::PARAM_STR);
            $st->bindValue(8, $category, PDO::PARAM_STR);
            $st->bindValue(9, $rack, PDO::PARAM_STR);
            $st->bindValue(10, $shell, PDO::PARAM_STR);
            $st->execute();

            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function deleteBook($bookId)
    {
        try {
            $conn = getCon();
            $query = "DELETE FROM `book` WHERE `bookId` =$bookId";
            $st = $conn->query($query);
            $st->execute();
            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function getAllBooks()
    {
        $conn = getCon();
        $query = "SELECT `imgUrl`, `name`, `isbn`, `author`, `cat`,`edition`, `price`, `year`, `pub`,  `rack`, `shell`,`bookid` FROM `book`";
        return $conn->query($query);
    }

    public function getFilteredBooks()
    {
        $conn = getCon();
        $query = "SELECT `imgUrl`, `name`, `isbn`, `author`, `cat`,`edition`, `price`, `year`, `pub`,  `rack`, `shell`,`bookid` 
                    FROM `book` WHERE name LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);
    }

    public function bookCount($isbn)
    {
        $conn = getCon();
        $query = "SELECT `isbn`, `name`,`bookId` 
                    FROM `book` WHERE `isbn` =$isbn ";
        $result = $conn->query($query);
        $count = $result->rowCount();
        return $count;
    }

    public function getBookIds($isbn)
    {
        $conn = getCon();
        $query = "SELECT `isbn`, `name`,`bookId` 
                    FROM `book` WHERE `isbn` =$isbn ";
        $result = $conn->query($query);
        $ids = array();
        foreach ($result as $row) {
            array_push($ids, $row[2]);
        }
        return $ids;
    }

    public function checkBook()
    {
        $conn = getCon();
        $query = "SELECT `name` FROM book WHERE bookId='{$_POST['query']}%'";
        return $conn->query($query);
    }

    public function checkIsbn()
    {
        $conn = getCon();
        $query = "SELECT `name` FROM book WHERE isbn='" . $_POST["isbn"] . "'";
        return $conn->query($query);
    }
}
