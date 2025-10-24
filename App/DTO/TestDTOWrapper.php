<?php

namespace App\DTO;
use App\Entity\User;
class TestDTOWrapper{

    public static function wrappUserToTestDTO(User $user) 
    {
        return new TestDTO($user->getEmail(), $user->getImgProfil());
    }
}