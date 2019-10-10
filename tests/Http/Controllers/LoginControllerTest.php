<?php


use App\Helpers\CreateUsersToTests;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class LoginControllerTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    private $existingEmail = 'jane@doe.com';
    private $notExistingEmail = 'janet@doe.com';
    private $existingPassword = 'P@ssw0rd';
    private $notExistingPassword = 'P@ssw0rd1';

    public function setUp(): void
    {
        parent::setUp();
        $helper = new CreateUsersToTests();
        $helper->createFirstUser();
        $helper->createSecondUser();
    }

    public function testLogin() : void
    {

        // given
        $data = [
            'email' => $this->existingEmail,
            'password' => $this->existingPassword,
        ];

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testLoginWhenEmailNotExisting() : void
    {

        // given
        $data = [
            'email' => $this->notExistingEmail,
            'password' => $this->existingPassword,
        ];
        $response = json_decode('{"content":[],"error_messages":{"email":["The selected email is invalid."]}}', true);

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testLoginWhenPasswordNotExisting() : void
    {

        // given
        $data = [
            'email' => $this->existingEmail,
            'password' => $this->notExistingPassword,
        ];
        $response = json_decode('{"content":[],"error_messages":[]}', true);

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_UNAUTHORIZED);
        $this->seeJson($response);
    }

    public function testLoginWhenEmailFieldIsEmpty() : void
    {

        // given
        $data = [
            'password' => $this->existingPassword,
        ];
        $response = json_decode('{"content":[],"error_messages":{"email":["The email field is required."]}}', true);

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testLoginWhenPasswordFieldIsEmpty() : void
    {

        // given
        $data = [
            'email' => $this->existingEmail,
        ];
        $response = json_decode('{"content":[],"error_messages":{"password":["The password field is required."]}}', true);

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testLoginWhenFiledsAreEmpty() : void
    {

        // given
        $data = [];
        $response = json_decode('{"content":[],"error_messages":{"email":["The email field is required."],"password":["The password field is required."]}}', true);

        // when
        $result = $this->post('/login/email', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }
}
