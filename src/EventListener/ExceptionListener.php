<?php

namespace App\EventListener;

use App\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();


        // Customize your response object to display the exception details
        $response = new ApiResponse(null, $exception->getCode(), $exception->getMessage());


        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        $event->allowCustomResponseCode();
        if ($exception instanceof NotFoundHttpException) {
            $response = new ApiResponse(null, $exception->getStatusCode(), '路由有误!请确认路由参数是否正确!', 404);
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_OK);
        }

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}
