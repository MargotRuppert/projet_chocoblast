<?php
namespace App\DTO;

class TestDTO
{
    
    public function __construct(
        public string $email,
        public string $img
    )
    {
        $this->email = $email;
        $this->img = $img;
    }
} 