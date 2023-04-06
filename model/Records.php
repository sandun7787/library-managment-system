<?php

class Records
{
    private $id;
    private $bookId;
    private $userId;
    private $bDate;
    private $dDate;
    private $rDate;
    private $penaltyState;

    public function __construct()
    {
    }

    /**
     * @param $id
     * @param $bookId
     * @param $userId
     * @param $bDate
     * @param $dDate
     * @param $rDate
     * @param $penaltyState
     */
    public function __construct_1($id, $bookId, $userId, $bDate, $dDate, $rDate, $penaltyState)
    {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->userId = $userId;
        $this->bDate = $bDate;
        $this->dDate = $dDate;
        $this->rDate = $rDate;
        $this->penaltyState = $penaltyState;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getBDate()
    {
        return $this->bDate;
    }

    /**
     * @param mixed $bDate
     */
    public function setBDate($bDate)
    {
        $this->bDate = $bDate;
    }

    /**
     * @return mixed
     */
    public function getDDate()
    {
        return $this->dDate;
    }

    /**
     * @param mixed $dDate
     */
    public function setDDate($dDate)
    {
        $this->dDate = $dDate;
    }

    /**
     * @return mixed
     */
    public function getRDate()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setRDate($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPenaltyState()
    {
        return $this->penaltyState;
    }

    /**
     * @param mixed $penaltyState
     */
    public function setPenaltyState($penaltyState)
    {
        $this->penaltyState = $penaltyState;
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




}
