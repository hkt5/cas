<?php

namespace App\Helpers;

use App\Builders\UserBuilder\UserDirector;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class CreateUsersToTests
{

    public function createFirstUser()  : void
    {

        try {
            $user_director = new UserDirector();
            $data = [
                'id' => 1,
                'uuid' => Uuid::uuid4(),
                'first_name' => 'john',
                'last_name' => 'doe',
                'email' => 'john@doe.com',
                'phone' => '000-000-000',
                'password' => 'P@ssw0rd',
                'is_active' => true,
                'is_confirmed' => true,
                'is_admin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user_director->constructUser($data);
            $result = $user_director->getResult();
            $result->save();
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
        }
    }

    public function createSecondUser()  : void
    {

        try {
            $user_director = new UserDirector();
            $data = [
                'id' => 2,
                'uuid' => Uuid::uuid4(),
                'first_name' => 'jane',
                'last_name' => 'doe',
                'email' => 'jane@doe.com',
                'phone' => '000-000-001',
                'password' => 'P@ssw0rd',
                'is_active' => true,
                'is_confirmed' => true,
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user_director->constructUser($data);
            $result = $user_director->getResult();
            $result->save();
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
        }
    }
}
