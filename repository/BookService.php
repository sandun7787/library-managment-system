<?php
session_start();

interface IBook
{
    public function addBook(Doctor $doctor);
    public function getBook($nic);
    public function updateBook(Doctor $doctor);
    public function deleteBook($doctorId);
    public function getAllBooks();

}

class BookService implements IBook{

    public function addBook(Doctor $doctor)
    {
        // TODO: Implement addBook() method.
    }

    public function getBook($nic)
    {
        // TODO: Implement getBook() method.
    }

    public function updateBook(Doctor $doctor)
    {
        // TODO: Implement updateBook() method.
    }

    public function deleteBook($doctorId)
    {
        // TODO: Implement deleteBook() method.
    }

    public function getAllBooks()
    {
        // TODO: Implement getAllBooks() method.
    }
}
