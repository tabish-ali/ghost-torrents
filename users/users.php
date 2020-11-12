<?php

class Users
{

    private $username;
    private $email;
    private $password;
    private $id;
    private $image;
    private $admin;


    function __construct($username, $email, $password, $id, $image, $admin)
    {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->image = $image;
        $this->admin = $admin;
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

    public function getAdmin(){

        return $this->admin;
    }

    public function setAdmin(){

    }
}
