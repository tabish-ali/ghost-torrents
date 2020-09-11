<?php

class Users
{

    private $username;
    private $email;
    private $password;
    private $id;
    private $image;


    function __construct($username, $email, $password, $id, $image)
    {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->image = $image;
    }

    public function regUser($username, $email, $password)
    {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getImage()
    {
        return $this->image;
    }
}
