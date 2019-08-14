<?php

namespace App\Api\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasGeneratedIDTrait
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="guid", unique=true)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function resetId()
    {
        $this->id = null;
    }

    protected function initHasGeneratedID()
    {
    }

    public function dataHasGeneratedID(&$data)
    {
        $data->_id = $this->id;
    }
}
