<?php

namespace App\MessageHandler;

use App\Message\TestMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class TestHandler implements MessageHandlerInterface
{
    private $entityManager;

    // Handler 类支持依赖注入
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // 魔术方法 __invoke() 只传入一个参数：该 Handler 类绑定的 Message 实例
    public function __invoke(TestMessage $message)
    {
        // do something with your message

        $this->entityManager->beginTransaction();

        $entity = $message->generateTestEntity();
        $entity->setName(__CLASS__);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $this->entityManager->commit();
    }
}
