<?php


namespace App\Strategies\Login;


use App\Factories\AppFactory;
use App\Factories\ResponseFacade;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class LoginWithEmailStrategy implements AbstractLoginStrategy
{

    public $rules = [
        'email' => 'required|email|max:255|exists:users,email',
        'password' => 'required|string|max:255'
    ];

    public function login(Request $request)
    {
        $factory = AppFactory::create('response');
        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()) {
            return $this->validatorFailsResponse($request, $validator, $factory);
        }

        $user = User::where('email', $request->get('email'))->first(["*"]);
        if(!Hash::check($request->get('password'), $user->password)){

            return $this->badPasswordResponse($request, $user, $factory, $validator);
        } else {

            return $this->authResponse($request, $user, $factory);
        }
    }
    private function authResponse(Request $request, User $user, ResponseFacade $factory): JsonResponse
    {

        $params = [
            'request' => $request,
            'user' => $user,
            'user_info' => 'User logged.',
            'reason' => 'Login correct.',
            'message' => 'User logged'
        ];
        try {
            $user->uuid = Uuid::uuid4();
            $user->updated_at = Carbon::now();
            return $factory->createResponse(
                ['user' => $user], [], Response::HTTP_OK, ['X-AUTH' => base64_encode($user)], $params
            );
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return $factory->createResponse(
                ['user' => $user], [], Response::HTTP_UNAUTHORIZED, ['X-AUTH' => base64_encode($user)], $params
            );
        }
    }

    private function badPasswordResponse(Request $request, $user, ResponseFacade $factory, \Illuminate\Contracts\Validation\Validator $validator): JsonResponse
    {
        $params = [
            'request' => $request,
            'user' => $user,
            'user_info' => 'Login error',
            'reason' => 'Login incorrect.',
            'message' => 'Bad email or password.'
        ];
        return $factory->createResponse(
            [], $validator->errors()->toArray(), Response::HTTP_UNAUTHORIZED, [], $params
        );
    }

    private function validatorFailsResponse(Request $request, \Illuminate\Contracts\Validation\Validator $validator, ResponseFacade $factory): JsonResponse
    {
        $params = [
            'request' => $request,
            'user' => [],
            'user_info' => 'Validation error',
            'reason' => $validator->errors(),
            'message' => 'Bad validation.'
        ];
        return $factory->createResponse(
            [], $validator->errors()->toArray(), Response::HTTP_BAD_REQUEST, [], $params
        );
    }
}
