<?php


namespace App\Factories;


use App\Events\LogEvent;
use Illuminate\Http\JsonResponse;

class ResponseFacade
{

    private static $instance = null;

    public static function getInstance() : ResponseFacade
    {

        if(self::$instance == null) {

            self::$instance = new self();
        }

        return self::$instance;
    }

    public function createResponse(
        array $content, array $error_messages, string $status_code, array $headers, array $params
    ) : JsonResponse
    {

        $this->createEvent($params);
        return response()->json(['content' => $content, 'error_messages' => $error_messages], $status_code, $headers);
    }

    private function createEvent(array $parameters) : void
    {

        event(
            new LogEvent(
                json_encode($parameters['user']), $parameters['request']->getBasePath(),
                $parameters['request']->getClientIp(), $parameters['request']->getHost(),
                $parameters['request']->getQueryString(), $parameters['user_info'], $parameters['reason'],
                $parameters['message']
            )
        );
    }
}
