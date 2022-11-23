<?php

require('../Security/Security.class.php');
require('../Connection/Session.class.php');

Session::creation();
Security::isloggedIn($_SESSION);

foreach($_SESSION['cart'] as $key=>$element){
    if($element['flight'] === intval($_GET['id'])){
        unset($_SESSION['cart'][$key]);
    }
}

header('location:/cart');
exit;