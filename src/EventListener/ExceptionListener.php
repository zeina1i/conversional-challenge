<?php
namespace App\EventListener;

use App\Exception\BadRequestException;
use App\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof NotFoundException) {
            $response = new JsonResponse(
                [
                    'status' => false,
                    'message' => $exception->getMessage()
                ],
                Response::HTTP_NOT_FOUND
            );
        } elseif ($exception instanceof BadRequestException) {
            $response = new JsonResponse(
                [
                    'status' => false,
                    'message' => $exception->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }  else {
            echo $exception->getMessage();
            die;
            $response = new JsonResponse(
                [
                    'status' => false,
                    'message' => 'internal server error'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $event->setResponse($response);
    }
}
