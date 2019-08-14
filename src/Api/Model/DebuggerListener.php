<?php
namespace App\Api\Model;

use App\Multi\Connection\Wrapper;
use App\Multi\TenantProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class DebuggerListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        error_log(print_r($request->getContent(),true));
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        error_log(print_r($response,true));
    }
}
