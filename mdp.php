<?php

$mdp = 'Admin';

echo password_hash($mdp, PASSWORD_DEFAULT) . "<br>";

var_dump(DateTime::createFromFormat("Y-m-d H:i:s", "2022-12-18 19:05:00"));