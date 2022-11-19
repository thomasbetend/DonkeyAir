<?php

class TestInput 
{
    public static function test($data)
    {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        $data= strtolower($data);
        return $data;
    }
}