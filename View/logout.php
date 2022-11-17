<?php
require('header.php');


$_SESSION = array();
session_destroy();
unset($_SESSION);
header('location: home.php');