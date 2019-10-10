<?php


use App\Helpers\CreateUsersToTests;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class AuthControllerTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;


    public function setUp(): void
    {
        parent::setUp();
        $helper = new CreateUsersToTests();
        $helper->createFirstUser();
        $helper->createSecondUser();
    }

    public function testAuthorizationHeaderNotExists() : void
    {

        // when
        $result = $this->get('/auth');

        // then
        $result->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function testUserNotExisting() : void
    {

        // given
        $user = User::find(1);
        $user->id = 5;

        // when
        $result = $this->get('/auth', ['X-AUTH' => base64_encode(json_encode($user))]);

        // then
        $result->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function testSessionTimeout() : void
    {

        // given
        $user = User::find(1);
        $user->updated_at = Carbon::create('2000', '01', '01');
        $user->update();

        // when
        $result = $this->get('/auth', ['X-AUTH' => base64_encode(json_encode($user))]);

        // then
        $result->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function testSessionActive() : void
    {

        // given
        $user = User::find(1);

        // when
        $result = $this->get('/auth', ['X-AUTH' => base64_encode(json_encode($user))]);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
