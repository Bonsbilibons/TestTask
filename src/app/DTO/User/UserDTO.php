<?php

namespace app\DTO\User;

class UserDTO
{
    protected $username;
    protected $phonenumber;

    /**
     * @param $username
     * @param $phonenumber
     */
    public function __construct($username, $phonenumber)
    {
        $this->username = $username;
        $this->phonenumber = $phonenumber;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $phonenumber
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    public function getDataAsArray()
    {
        return[
          'username' => $this->username,
          'phonenumber'=> $this->phonenumber,
        ];
    }
}
