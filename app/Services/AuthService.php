<?php


namespace App\Services;


use App\States\AuthState;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthService
{

    private $authState;

    public function __construct()
    {

        $this->authState = new AuthState();
    }

    public function auth(Request $request) : JsonResponse
    {

        $setState = $this->authState->setState($request);
        if($setState instanceof JsonResponse){

            return $setState;
        }

        return $this->authState->getState();
    }
}
