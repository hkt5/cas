<?php


namespace App\Builders\UserBuilder;


use App\User;

interface Result
{

    public function getResult(): User;
}
