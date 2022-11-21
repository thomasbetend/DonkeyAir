<?php

class Airport 
{
    private ?int $id;
    private ?string $airport_name;

    public static function createdFromSqlRow (array $row): self
    {
        $airport = new self();
        $airport->id = $row['id_airport'];
        $airport->airport_name = $row['airport_name'];

        return $airport;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getName(): string 
    {
        return $this->airport_name;
    }
}


