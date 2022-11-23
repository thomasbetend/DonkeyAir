<?php
class Session 
{

    public static function creation()
    {
        session_start();
    }

    public static function login(User $user) {
        $_SESSION['login'] = $user->getFirstname() . " " . $user->getLastname();
        $_SESSION['id'] = $user->getId();

        $_SESSION['cart'] = array(); 
        $_SESSION['cart_price_total'] = 0;
    }

    public static function loginAdmin(User $admin) {
        $_SESSION['login'] = $admin->getFirstname() . " " . $admin->getLastname();
        $_SESSION['admin'] = "Admin";
        $_SESSION['id'] = $admin->getId();

        $_SESSION['cart'] = array(); 
        $_SESSION['cart_price_total'] = 0;
    }

    public static function destroy()
    {
        $_SESSION = array();
        session_destroy();
        unset($_SESSION);
    }

}