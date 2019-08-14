<?php

namespace App\Api\Entity;

use App\Api\Entity\Traits\HasGeneratedIDTrait;
use App\Api\Entity\Traits\TimestampableTrait;

abstract class BaseEntity
{
    use HasGeneratedIDTrait;
    use TimestampableTrait;

    public function __construct()
    {
        $this->initHasGeneratedID();
        $this->initTimestampable();
    }

    public function toData()
    {
        $data = new \stdClass();
        $this->dataHasGeneratedID($data);
        $this->dataTimestampable($data);

        return $data;
    }
}
