<?php
namespace App\Multi;

interface TenantProviderInterface
{
    public function getTenant($tenant);
}
