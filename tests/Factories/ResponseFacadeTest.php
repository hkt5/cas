<?php


use App\Factories\ResponseFacade;
use App\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\WithoutEvents;

class ResponseFacadeTest extends TestCase
{

    use WithoutEvents;

    public function testResponseFacade() : void
    {

        // given
        $instance = ResponseFacade::getInstance();
        $request = $this->getMockBuilder('Illuminate\Http\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $user = $this->getMockBuilder('App\User')->getMock();
        $response = [
            'content' => [], 'error_message' => []
        ];

        // when
        $result = $instance->createResponse(
            [], [], Response::HTTP_OK, [], [
                'request' => $request, 'user' => $user, 'user_info' => '', 'reason' => '', 'message' => 'message'
            ]
        );

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals($response, json_decode($result->content(), true));
    }
}
