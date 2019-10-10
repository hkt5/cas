<?php


use App\Helpers\CreateUsersToTests;
use App\Helpers\MockingRequest;
use App\Strategies\Login\LoginContext;
use App\Strategies\Login\LoginWithEmailStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class LoginContextTest extends TestCase
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

    public function testLoginUser(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'email' => $this->existingEmail,
                'password' => $this->existingPassword,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);

        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }

    public function testLoginUserWhenEmailNotExisting(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'email' => $this->notExistingEmail,
                'password' => $this->existingPassword,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":{"email":["The selected email is invalid."]}}';
        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testLoginUserWhenPasswordNotExisting(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'email' => $this->existingEmail,
                'password' => $this->notExistingPassword,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":[]}';
        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testLoginUserWhenEmailFieldIsEmpty(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'password' => $this->existingPassword,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":{"email":["The email field is required."]}}';
        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testLoginUserWhenPasswordFieldIsEmpty(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'email' => $this->existingEmail,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":{"password":["The password field is required."]}}';
        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result->content());
    }

    public function testLoginUserWhenAllFieldsAreEmpty(): void
    {

        // given
        $context = new LoginContext();
        $context->setStrategy(new LoginWithEmailStrategy());
        /** @var LoginWithEmailStrategy $result */
        $strategy = $context->getStrategy();
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''

        ];
        $request = MockingRequest::createRequest($data);
        $response = '{"content":[],"error_messages":{"email":["The email field is required."],"password":["The password field is required."]}}';
        // when
        /** @var Response $result */
        $result = $strategy->login($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result->content());
    }
}
