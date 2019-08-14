<?php
namespace App\Multi\Listener;

use App\Multi\Connection\Wrapper;
use App\Multi\TenantProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class TenantListener
{
    /** @var  Wrapper */
    private $connection;

    /** @var  TenantProviderInterface */
    private $tenantProvider;

    /**
     * TenantListener constructor.
     * @param Wrapper $connection
     * @param TenantProviderInterface $tenantProvider
     */
    public function __construct(Wrapper $connection, TenantProviderInterface $tenantProvider)
    {
        $this->connection = $connection;
        $this->tenantProvider = $tenantProvider;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $host = $event->getRequest()->getHttpHost();

        $url = explode(".", $host);
        $tenant_name = $url[0];

        $tenant = $this->tenantProvider->getTenant($tenant_name);

        if ($tenant != null) {
            $this->connection->forceSwitch($tenant->getServer(), $tenant->getDatabase(), $tenant->getUsername(), $tenant->getPassword());

        }
    }
}
