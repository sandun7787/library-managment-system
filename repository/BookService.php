<?php
session_start();

interface IBook
{
    public function addBook(Book $book);
    public function getBook($isbn);
    public function updateBook(Book $book);
    public function deleteBook($isbn);
    public function getAllBooks();

}

class BookService implements IBook{


    public function addBook(Book $book)
    {
        try {
            $conn = getCon();

            $isbn=$book->getIsbn();
            $name=$book->getTitle();
            $edition=$book->getEdition();
            $price=$book->getPrice();
            $year=$book->getYear();
            $publisher=$book->getPublisher();
            $imgUrl=$book->getImageUrl();
            $author=$book->getAuthor();
            $category=$book->getCategory();
            $rack=$book->getRack();
            $shell=$book->getShell();


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

            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }
    }

    public function getBook($isbn)
    {
        $conn = getCon();
        $query = "SELECT `isbn`, `name`, `edition`, `price`, `year`, `pub`, `imgUrl`, `author`, `cat`, `rack`, `shell` FROM `book` WHERE `isbn` =$isbn ";
        $result = $conn->query($query);
        return $result;
        // TODO: Implement getBook() method.
    }

    public function updateBook(Book $book)
    {
        try {
            $conn = getCon();

            $isbn=$book->getIsbn();
            $name=$book->getTitle();
            $edition=$book->getEdition();
            $price=$book->getPrice();
            $year=$book->getYear();
            $publisher=$book->getPublisher();
            $imgUrl=$book->getImageUrl();
            $author=$book->getAuthor();
            $category=$book->getCategory();
            $rack=$book->getRack();
            $shell=$book->getShell();

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
        // TODO: Implement updateBook() method.
    }

    public function deleteBook($isbn)
    {
        try {
            $conn = getCon();
            $query = "DELETE FROM `book` WHERE `isbn` =$isbn";
            $st= $conn->query($query);
            $st->execute();
            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }

        // TODO: Implement deleteBook() method.
    }

    public function getAllBooks()
    {
        $conn=getCon();
        $query = "SELECT `imgUrl`, `name`, `isbn`, `author`, `cat` FROM `book`";
        $result = $conn->query($query);
        return $result;
         // TODO: Implement getAllBooks() method.
    }
}
