<?php

namespace App\Api\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
use App\Api\Entity\User;

trait TimestampableTrait
{
    /**
     * @var \DateTime $date_create
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $date_create;

    /**
     * @var \DateTime $date_update
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $date_update;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Api\Entity\User")
     * @ORM\JoinColumn(name="user_create_id", referencedColumnName="id")
     */
    protected $user_create;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Api\Entity\User")
     * @ORM\JoinColumn(name="user_update_id", referencedColumnName="id")
     */
    protected $user_update;

    public function getDateCreate()
    {
        return $this->date_create;
    }

    public function getDateCreateFormatted()
    {
        if ($this->date_create != null) {
            return $this->date_create->format('m/d/Y');
        }
        $this->date_create = new DateTime();
        return $this->date_create->format('m/d/Y');
    }

    public function getDateUpdate()
    {
        return $this->date_update;
    }

    public function getDateUpdateFormatted()
    {
        if ($this->date_update != null) {
            return $this->date_update->format('m/d/Y');
        }
        $this->date_create = new DateTime();
        return $this->date_create->format('m/d/Y');
    }

    public function setUserCreate(User $user)
    {
        $this->user_create = $user;

        return $this;
    }

    public function getUserCreate()
    {
        return $this->user_create;
    }

    public function setUserUpdate(User $user)
    {
        $this->user_update = $user;

        return $this;
    }

    public function getUserUpdate()
    {
        return $this->user_update;
    }

    public function initTimestampable()
    {
        $this->date_create = new DateTime();
        $this->date_update = new DateTime();
    }

    protected function dataTimestampable(&$data)
    {
        $data->date_create = $this->date_create->format('Y-m-d H:i:s');
        $data->date_update = $this->date_update->format('Y-m-d H:i:s');
    }

    protected function dataTrackCreate(&$data)
    {
        $data->date_create = $this->date_create->format('Y-m-d H:i:s');
        $data->user_create = $this->user_create;
    }

    protected function dataTrackUpdate(&$data)
    {
        $data->date_update = $this->date_update->format('Y-m-d H:i:s');
        $data->user_create = null != $this->user_update ? $this->user_update->toData() : null;
        // $data->user_update = $this->date_update->format('Y-m-d H:i:s');
    }
}