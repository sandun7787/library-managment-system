<?php

class Student
{
    private $studentId;
    private $name;
    private $email;
    private $no;
    private $state;
    private $password;

    public function __construct()
    {
    }

    /**
     * @param $studentId
     * @param $name
     * @param $email
     * @param $no
     * @param $state
     * @param $password
     */
    public function __construct_1($studentId, $name, $email, $no, $state, $password)
    {
        $this->studentId = $studentId;
        $this->name = $name;
        $this->email = $email;
        $this->no = $no;
        $this->state = $state;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * @param mixed $no
     */
    public function setNo($no)
    {
        $this->no = $no;
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
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}
