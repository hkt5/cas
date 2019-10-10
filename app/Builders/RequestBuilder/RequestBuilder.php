<?php


namespace App\Builders\RequestBuilder;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class RequestBuilder implements RequestBuilderInterface
{

    private $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    function buildRequest(array $data): void
    {
        $this->request = new Request;
        $this->request->createFormBase(
            SymfonyRequest::create(
                $data['method'], $data['uri'], $data['parameters'], $data['cookies'], $data['files'],
                $data['server'], $data['content']
            )
        );
    }

    function getRequest() : Request
    {

        return $this->request;
    }
}
