<?php


use App\Helpers\CreateUsersToTests;
use App\Helpers\MockingRequest;
use App\States\AuthState;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class AuthStateTest extends TestCase
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

        // given
        $state = new AuthState();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $result = $state->setState($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testUserNotExists() : void
    {

        // given
        $state = new AuthState();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $user = User::find(1);
        $user->id = 5;
        $request = MockingRequest::createRequest($data);
        $request->headers->add(['X-AUTH' => base64_encode(json_encode($user))]);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $result = $state->setState($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testSessionTimeout() : void
    {

        // given
        $state = new AuthState();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $user = User::find(1);
        $user->updated_at = \Carbon\Carbon::create('2000', '01', '01');
        $user->update();
        $request = MockingRequest::createRequest($data);
        $request->headers->add(['X-AUTH' => base64_encode(json_encode($user))]);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $state->setState($request);
        $result = $state->getState();

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testSessionActive() : void
    {

        // given
        $state = new AuthState();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $user = User::find(1);
        $request = MockingRequest::createRequest($data);
        $request->headers->add(['X-AUTH' => base64_encode(json_encode($user))]);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $state->setState($request);
        $result = $state->getState();

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
