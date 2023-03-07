<?php

class Book
{
    private $isbn;
    private $title;
    private $edition;
    private $price;
    private $year;
    private $publisher;
    private $imageUrl;
    private $author;
    private $category;
    private $rack;
    private $shell;

    public function __construct()
    {
    }

    /**
     * @param $isbn
     * @param $title
     * @param $edition
     * @param $price
     * @param $year
     * @param $publisher
     * @param $imageUrl
     * @param $author
     * @param $category
     * @param $rack
     * @param $shell
     */
    public function __construct_1($isbn, $title, $edition, $price, $year, $publisher, $imageUrl, $author, $category, $rack, $shell)
    {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->edition = $edition;
        $this->price = $price;
        $this->year = $year;
        $this->publisher = $publisher;
        $this->imageUrl = $imageUrl;
        $this->author = $author;
        $this->category = $category;
        $this->rack = $rack;
        $this->shell = $shell;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param mixed $edition
     */
    public function setEdition($edition): void
    {
        $this->edition = $edition;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * @param mixed $rack
     */
    public function setRack($rack): void
    {
        $this->rack = $rack;
    }

    /**
     * @return mixed
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * @param mixed $shell
     */
    public function setShell($shell): void
    {
        $this->shell = $shell;
    }



}
