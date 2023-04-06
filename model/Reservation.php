<?php

class Reservation
{

    private $reservationId;
    private $bookId;
    private $userId;
    private $reservationDate;
    private $requestedDate;
    private $state;

    public function __construct()
    {
    }

    /**
     * @param $reservationId
     * @param $bookId
     * @param $userId
     * @param $reservationDate
     * @param $requestedDate
     * @param $state
     */
    public function __construct_1($reservationId, $bookId, $userId, $reservationDate, $requestedDate, $state)
    {
        $this->reservationId = $reservationId;
        $this->bookId = $bookId;
        $this->userId = $userId;
        $this->reservationDate = $reservationDate;
        $this->requestedDate = $requestedDate;
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getReservationId()
    {
        return $this->reservationId;
    }

    /**
     * @param mixed $reservationId
     */
    public function setReservationId($reservationId): void
    {
        $this->reservationId = $reservationId;
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param mixed $bookId
     */
    public function setBookId($bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    /**
     * @param mixed $reservationDate
     */
    public function setReservationDate($reservationDate): void
    {
        $this->reservationDate = $reservationDate;
    }

    /**
     * @return mixed
     */
    public function getRequestedDate()
    {
        return $this->requestedDate;
    }

    /**
     * @param mixed $requestedDate
     */
    public function setRequestedDate($requestedDate): void
    {
        $this->requestedDate = $requestedDate;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }




}