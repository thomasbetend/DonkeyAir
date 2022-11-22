<?php

class UserController
{
    public static function getLogin()
    {
        include("./View/login.php");
    }

    public static function getLogout()
    {
        header("location:../accueil");
    }

    public static function getSignup()
    {
        include("./View/signup.php");
    }

}