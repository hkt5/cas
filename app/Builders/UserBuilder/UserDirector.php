<?php


namespace App\Builders\UserBuilder;


use App\User;

class UserDirector implements UserConstructor, Result
{

    private $builder;

    public function __construct()
    {
        $this->builder = new UserBuilder();
    }

    public function constructUser(array $data = []) : void
    {

        if(isset($data['id'])) {
            $this->builder->buildId($data['id']);
        }
        $this->builder->buildUuid($data['uuid']);
        $this->builder->buildFirstName($data['first_name']);
        $this->builder->buildLastName($data['last_name']);
        $this->builder->buildEmail($data['email']);
        $this->builder->buildPhone($data['phone']);
        $this->builder->buildPassword($data['password']);
        $this->builder->buildIsAdmin($data['is_admin']);
        $this->builder->buildIsActive($data['is_active']);
        $this->builder->buildIsConfirmed($data['is_confirmed']);
        $this->builder->buildCreatedAt($data['created_at']);
        $this->builder->buildUpdatedAt($data['updated_at']);
    }

    public function getResult(): User
    {

        return $this->builder->getUser();
    }
}
