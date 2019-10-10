<?php


namespace App\Builders\RequestBuilder;


use Illuminate\Http\Request;

class RequestDirector
{

    private $builder;

    public function __construct()
    {
        $this->builder = new RequestBuilder();
    }

    public function constructRequest(array $data) : void
    {

        $this->builder->buildRequest($data);
    }

    public function getResult(): Request
    {

        return $this->builder->getRequest();
    }
}
