<?php

namespace App\Http\Middleware;


use App\Services\AuthService;
use App\User;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Authenticate {

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed
     * @throws GuzzleException
     */
    public function handle($request, Closure $next) {

        $authService = new AuthService();
        $result = $authService->auth($request);
        if($result->status() == Response::HTTP_UNAUTHORIZED){

            return $result;
        }

        return $next($request);
    }
}

