<?php
class Session 
{

    public static function creation()
    {
        session_start();
    }

    public static function login(User $user) {
        $_SESSION['login'] = $user->getFirstname() . " " . $user->getLastname();
    }

    public static function destroy()
    {
        $_SESSION = array();
        session_destroy();
        unset($_SESSION);
        header('location: index.php');
    }

}