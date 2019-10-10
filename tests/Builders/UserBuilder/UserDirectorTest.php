<?php


use App\Builders\UserBuilder\UserDirector;
use Carbon\Carbon;

class UserDirectorTest extends TestCase
{

    public function testUserDirector() : void
    {

        // given
        $user_director = new UserDirector();
        $data = [
            'id' => 1,
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

        // when
        $user_director->constructUser($data);
        $result = $user_director->getResult();

        // then
        $this->assertEquals($data['id'], $result->id);
        $this->assertEquals($data['first_name'], $result->first_name);
        $this->assertEquals($data['last_name'], $result->last_name);
        $this->assertEquals($data['email'], $result->email);
        $this->assertEquals($data['phone'], $result->phone);
        $this->assertEquals($data['is_active'], $result->is_active);
        $this->assertEquals($data['is_admin'], $result->is_admin);
        $this->assertEquals($data['is_confirmed'], $result->is_confirmed);
    }
}
