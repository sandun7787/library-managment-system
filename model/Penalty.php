<?php

class Penalty
{
    private $id;
    private $isbn;
    private $userId;
    private $recordId;
    private $state;

    public function __construct()
    {
    }

    /**
     * @param $id
     * @param $isbn
     * @param $userId
     * @param $recordId
     * @param $state
     */
    public function __construct_1($id, $isbn, $userId, $recordId, $state)
    {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->userId = $userId;
        $this->recordId = $recordId;
        $this->state = $state;
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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * @param mixed $recordId
     */
    public function setRecordId($recordId): void
    {
        $this->recordId = $recordId;
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
