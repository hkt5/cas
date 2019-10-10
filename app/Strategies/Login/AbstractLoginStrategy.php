<?php


namespace App\Strategies\Login;


use Illuminate\Http\Request;

interface AbstractLoginStrategy
{

    public function login(Request $request);
}
