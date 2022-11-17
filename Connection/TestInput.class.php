<?php

class Input 
{
    public static function test(array $data)
    {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        $data= strtolower($data);
        return $data;
    }
}