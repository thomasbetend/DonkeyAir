<?php
class Session 
{

    public static function creation()
    {
        session_start();
        $_SESSION['login'];

    }

}