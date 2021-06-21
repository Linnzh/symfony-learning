<?php

namespace App\MessageHandler;

use App\Message\Test;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class TestHandler implements MessageHandlerInterface
{
    public function __invoke(Test $message)
    {
        // do something with your message
        var_dump($message);
    }
}
