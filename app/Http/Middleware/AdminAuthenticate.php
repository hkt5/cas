<?php

namespace App\Http\Middleware;


use App\User;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AdminAuthenticate {

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed
     * @throws GuzzleException
     */
    public function handle($request, Closure $next) {

        $authorizationHeader = $request->header('X-AUTH');

        $client = new Client(['base_uri' => config('endpoints.auth')]);
        try {
            $client->request('GET', '/auth', ['headers' => ['X-AUTH' => $authorizationHeader]]);

            $userData = json_decode(base64_decode($authorizationHeader), true);

            $user = User::where('updated_at', $userData->updated_at)->where('email', $userData['email'])->first['*'];
            if(is_null($user) || empty($user)){
                return response()->json(
                    ['data' => ['error' => 'You need to be authorized to work with API'],
                        'status' => Response::HTTP_UNAUTHORIZED]
                );
            }

            if($user->is_admin == false) {

                return response()->json(
                    ['data' => ['error' => 'You need to be authorized to work with API'],
                        'status' => Response::HTTP_UNAUTHORIZED]
                );
            }

        } catch (ClientException $e) {

            return response()->json(['data' => ['error' => 'You need to be authorized to work with API'], 'status' => $e->getCode()]);
        }

        return $next($request);
    }
}

