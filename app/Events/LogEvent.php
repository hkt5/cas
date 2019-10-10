<?php


namespace App\Events;


class LogEvent
{

    public $user;
    public $base_path;
    public $client_ip;
    public $host;
    public $query_string;
    public $user_info;
    public $reason;
    public $message;

    /**
     * LogEvent constructor.
     * @param $user
     * @param $base_path
     * @param $client_ip
     * @param $host
     * @param $query_string
     * @param $user_info
     * @param $reason
     * @param $message
     */
    public function __construct($user, $base_path, $client_ip, $host, $query_string, $user_info, $reason, $message)
    {
        $this->user = $user;
        $this->base_path = $base_path;
        $this->client_ip = $client_ip;
        $this->host = $host;
        $this->query_string = $query_string;
        $this->user_info = $user_info;
        $this->reason = $reason;
        $this->message = $message;
    }


}
