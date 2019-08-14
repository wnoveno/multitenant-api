<?php
namespace App\Multi\Entity;

use App\Multi\TenantProviderInterface;
use Doctrine\ORM\EntityRepository;

class TenantRepository extends EntityRepository implements TenantProviderInterface
{
    /**
     * @param $tenant
     * @return null|Tenant
     */
    public function getTenant($tenant)
    {
        return $this->findOneByName($tenant);
    }
}
