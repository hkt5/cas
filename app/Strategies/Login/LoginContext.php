<?php


namespace App\Strategies\Login;


class LoginContext
{

    private $strategy;

    public function setStrategy(AbstractLoginStrategy $obj) {
        $this->strategy=$obj;
    }
    public function getStrategy() {
        return $this->strategy;
    }
}
