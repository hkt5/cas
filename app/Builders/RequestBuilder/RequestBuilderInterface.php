<?php


namespace App\Builders\RequestBuilder;


interface RequestBuilderInterface
{

    function buildRequest(array $data): void;
}
