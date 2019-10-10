<?php


use App\Helpers\CreateUsersToTests;
use App\Helpers\MockingRequest;
use App\Services\AuthService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class AuthServiceTest extends TestCase
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
        $service = new AuthService();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $result = $service->auth($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testUserNotExists() : void
    {

        // given
        $service = new AuthService();
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
        $result = $service->auth($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testSessionTimeout() : void
    {

        // given
        $service = new AuthService();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $user = User::find(1);
        $user->updated_at = Carbon::create('2000', '01', '01');
        $user->update();
        $request = MockingRequest::createRequest($data);
        $request->headers->add(['X-AUTH' => base64_encode(json_encode($user))]);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $result = $service->auth($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testSessionActive() : void
    {

        // given
        $service = new AuthService();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $user = User::find(1);
        $request = MockingRequest::createRequest($data);
        $request->headers->add(['X-AUTH' => base64_encode(json_encode($user))]);
        $response = '{"content":[],"error_messages":[]}';

        // when
        $result = $service->auth($request);

        // then
        $this->assertTrue($result instanceof JsonResponse);
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }
}
