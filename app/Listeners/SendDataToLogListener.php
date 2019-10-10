<?php


namespace App\Listeners;


use App\Events\LogEvent;
use App\Events\RegisterLogEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class SendDataToLogListener
{

    public function handle(LogEvent $logEvent) {

        $client = new Client(['base_uri' => config('endpoints.logs')]);
        $url = "create";
        try {
            $client->request('POST', $url, [
                'json' =>
                    [
                        'user' => $logEvent->user,
                        'base_path' => $logEvent->base_path,
                        'client_ip' => $logEvent->client_ip,
                        'host' => $logEvent->host,
                        'query_string' => $logEvent->query_string,
                        'user_info' => $logEvent->user_info,
                        'reason' => $logEvent->reason,
                        'message' => $logEvent->message,
                    ],
            ]);

        } catch (ClientException $e) {

            Log::alert($e->getMessage());
        }
    }
}
