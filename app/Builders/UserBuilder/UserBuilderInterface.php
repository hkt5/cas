<?php


namespace App\Builders\UserBuilder;


use Carbon\Carbon;

interface UserBuilderInterface
{

    function buildId(int $id) : void;

    function buildUuid(string $uuid = null) : void;

    function buildFirstName(string $first_name) : void;

    function buildLastName(string $last_name) : void;

    function buildEmail(string $email) : void;

    function buildPhone(string $phone) : void;

    function buildPassword(string $password) : void;

    function buildIsAdmin(bool $is_admin) : void;

    function buildIsConfirmed(bool $is_confirmed) : void;

    function buildIsActive(bool $is_active) : void;

    function buildCreatedAt(Carbon $created_at) : void;

    function buildUpdatedAt(Carbon $created_at) : void;
}
