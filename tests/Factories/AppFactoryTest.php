<?php


use App\Factories\AppFactory;
use App\Factories\ResponseFacade;

class AppFactoryTest extends TestCase
{

    public function testGetResponseFacade() : void
    {

        // given
        $type = 'response';

        // when
        $response_facade = AppFactory::create($type);

        // then
        $this->assertTrue($response_facade instanceof ResponseFacade);
    }
}
