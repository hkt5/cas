<?php


namespace App\Http\Controllers;


use App\Strategies\Login\LoginContext;
use App\Strategies\Login\LoginWithEmailStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{

    private $loginContext;

    public function __construct()
    {

        $this->loginContext = new LoginContext();
    }

    public function loginWithEmail(Request $request) : JsonResponse
    {

        $this->loginContext->setStrategy(new LoginWithEmailStrategy());
        return $this->loginContext->getStrategy()->login($request);
    }
}
