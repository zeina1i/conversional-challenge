<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class JsonBodyParserListener
{
    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if (!$this->isJsonRequest($request)) {
            return;
        }
        $content = $request->getContent();
        if (empty($content)) {
            return;
        }
        if (!$this->transformJsonBody($request)) {
            $response = Response::create(
                json_encode([
                    'status' => false,
                    'message' => 'Unable to parse json request.'
                ]),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
            $event->setResponse($response);
        }
    }

    private function isJsonRequest(Request $request): bool
    {
        return 'json' === $request->getContentType();
    }
    private function transformJsonBody(Request $request): bool
    {
        $data = json_decode((string) $request->getContent(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return false;
        }
        if (null === $data) {
            return true;
        }
        $request->request->replace($data);
        return true;
    }
}
