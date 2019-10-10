<?php


namespace App\Http\Controllers;


use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request) : JsonResponse
    {

        return $this->authService->auth($request);
    }
}
