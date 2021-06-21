<?php

namespace App\Controller\Test;

use App\Message\TestMessage;
use App\Response\ApiResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Routing\Annotation\Route;

class MessengerController extends AbstractController
{
    /**
     * @Route("/test/messenger/create", name="test_messenger_create")
     */
    public function create(MessageBusInterface $messageBus, EntityManagerInterface $entityManager): ApiResponse
    {
        $entityManager->getConnection()->beginTransaction();

        $message = new TestMessage(__CLASS__);
        // Ref: https://symfonycasts.com/screencast/messenger/stamps-envelopes
        $envelope = $messageBus->dispatch($message, [
            new DelayStamp(15000)
        ]);// 如果开启 async 异步（php bin/console messenger:setup-transports），这部分内容将在消费（php bin/console messenger:consume -vv）时调用

        $test = $message->generateTestEntity();

        $entityManager->persist($test);
        $entityManager->flush();

        $entityManager->commit();

        return new ApiResponse($envelope);
    }
}
