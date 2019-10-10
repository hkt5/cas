<?php


namespace App\States;


use App\Factories\AppFactory;
use App\Factories\ResponseFacade;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthState
{

    private $appFactory;
    private $details = [];

    public $state;

    public function __construct()
    {

        $this->appFactory = AppFactory::create('response');
    }

    public function getState() : JsonResponse
    {

        if($this->state == false) {

            return $this->appFactory->createResponse(
                [], [], Response::HTTP_UNAUTHORIZED, [], [
                    'request' => $this->details['request'], 'user' => $this->details['user'], 'user_info' => 'Unathorized',
                    'reason' => 'Not authorize.', 'message' => 'Token expired.'
                ]
            );
        } else {

            return $this->appFactory->createResponse(
                [], [], Response::HTTP_OK, ['X-AUTH' => base64_encode(json_encode($this->details['user']))], [
                    'request' => $this->details['request'], 'user' => $this->details['user'], 'user_info' => 'Authorize',
                    'reason' => 'User has been authorized.', 'message' => 'User authorize.'
                ]
            );
        }
    }

    public function setState(Request $request) : ?JsonResponse {

        try {

            $this->setStatusOfState($request);
            return null;
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return $this->appFactory->createResponse(
                [], [], Response::HTTP_UNAUTHORIZED, [], [
                    'request' => $request, 'user' => null, 'user_info' => 'Unathorized', 'reason' => 'Not authorize.',
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    private function setStatusOfState(Request $request) : void
    {

        $header = $request->headers->get('X-AUTH');
        $userData = json_decode(base64_decode($header), true);
        $this->details['user'] = User::where('uuid', $userData['uuid'])->where('id', $userData['id'])->first(["*"]);
        $this->details['request'] = $request;
        /** @var Carbon $last_update */
        $last_update = $this->details['user']->updated_at;
        $now = Carbon::now();
        $difference = $now->diffInMinutes($last_update);
        if($difference > 15) {

            $this->state = false;
        } else {

            $this->details['user']->updated_at = Carbon::now();
            $this->details['user']->update();
            $this->state = true;
        }
    }
}
