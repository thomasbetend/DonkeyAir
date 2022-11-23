<?php

class Promo {
    
   
    public function __construct(private string $airport_name, private int $id_flight, private float $price, private string $img){
     
    }
    
    public function getId_flight(): int 
    {
        return $this->id_flight;
    }

    public function getName(): string 
    {
        return $this->airport_name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImg(): string
    {
        return $this->img;
    }



    }




