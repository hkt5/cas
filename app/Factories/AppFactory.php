<?php


namespace App\Factories;


abstract class AppFactory
{

    public static function create($type) {
        switch ($type) {

            case 'response':
                return ResponseFacade::getInstance();
                break;
        }
    }
}
