<?php

class Notifications
{

    private $notifications = array();

    public function setNotification($n)
    {
        array_push($this->notifications, $n);
    }

    public function getNotification()
    {
        return $this->notifications;
    }
}
