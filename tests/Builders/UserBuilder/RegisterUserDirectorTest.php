<?php


use App\Builders\UserBuilder\RegisterUserDirector;
use Illuminate\Support\Facades\Hash;

class RegisterUserDirectorTest extends TestCase
{

    public function testRegisterUserDirector() : void
    {

        // given
        $data = [
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'john@doe.com',
            'phone' => '000-000-000',
            'password' => 'P@ssw0rd',
        ];
        $userBuilder = new RegisterUserDirector();

        // when
        $userBuilder->constructUser($data);
        $result = $userBuilder->getResult();

        // then
        $this->assertEquals($data['first_name'], $result->first_name);
        $this->assertEquals($data['last_name'], $result->last_name);
        $this->assertEquals($data['email'], $result->email);
        $this->assertEquals($data['phone'], $result->phone);
        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}
