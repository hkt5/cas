<?php


namespace App\Builders\UserBuilder;


use App\User;

class RegisterUserDirector implements UserConstructor, Result
{

    private $builder;

    public function __construct()
    {
        $this->builder = new UserBuilder();
    }

    public function constructUser(array $data = []) : void
    {

        $this->builder->buildFirstName($data['first_name']);
        $this->builder->buildLastName($data['last_name']);
        $this->builder->buildEmail($data['email']);
        $this->builder->buildPhone($data['phone']);
        $this->builder->buildPassword($data['password']);
    }

    public function getResult(): User
    {

        return $this->builder->getUser();
    }
}
