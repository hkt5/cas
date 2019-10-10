<?php


namespace App\Builders\UserBuilder;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class UserBuilder implements UserBuilderInterface
{

    private $user;

    public function __construct()
    {

        $this->user = new User();
    }

    function buildId(int $id): void
    {

        $this->user->setAttribute('id', $id);
    }

    function buildUuid(string $uuid = null): void
    {

        try {
            if(is_null($uuid)) {
                $this->user->setAttribute('uuid', Uuid::uuid4());
            } else {
                $this->user->setAttribute('uuid', $uuid);
            }
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            $this->user->setAttribute('uuid', null);
        }
    }

    function buildFirstName(string $first_name): void
    {

        $this->user->setAttribute('first_name', $first_name);
    }

    function buildLastName(string $last_name): void
    {

        $this->user->setAttribute('last_name', $last_name);
    }

    function buildEmail(string $email): void
    {

        $this->user->setAttribute('email', strtolower($email));
    }

    function buildPhone(string $phone): void
    {

        $this->user->setAttribute('phone', $phone);
    }

    function buildPassword(string $password): void
    {

        $this->user->setAttribute('password', Hash::make($password));
    }

    function buildIsAdmin(bool $is_admin): void
    {

        $this->user->setAttribute('is_admin', $is_admin);
    }

    function buildIsConfirmed(bool $is_confirmed): void
    {

        $this->user->setAttribute('is_confirmed', $is_confirmed);
    }

    function buildIsActive(bool $is_active): void
    {

        $this->user->setAttribute('is_active', $is_active);
    }

    function buildCreatedAt(Carbon $created_at): void
    {

        $this->user->setAttribute('created_at', $created_at);
    }

    function buildUpdatedAt(Carbon $updated_at): void
    {

        $this->user->setAttribute('updated_at', $updated_at);
    }

    public function getUser(): User
    {

        return $this->user;
    }
}
