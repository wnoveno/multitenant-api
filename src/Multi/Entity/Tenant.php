<?php
namespace App\Multi\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Multi\Entity\TenantRepository")
 * @ORM\Table(name="tenant")
 */
class Tenant
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $name;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $dbname;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $username;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $password;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $server;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $active_users;


    /**
     * Tenant constructor.
     * @param string $database
     * @param string $username
     * @param string $password
     * @param string $server
     */
    public function __construct( $name,$database, $username, $password, $server)
    {
        $this->name = $name;
        $this->dbname = $database;
        $this->username = $username;
        $this->password = $password;
        $this->server = $server;
        $this->active_users = 0;
    }

    /**
     * @return mixed
     */
    public function getActiveUsers()
    {
        return $this->active_users;
    }

    /**
     * @param mixed $active_users
     */
    public function setActiveUsers($active_users): void
    {
        $this->active_users = $active_users;
    }


    public static function fromArray($array)
    {
        return new self($array['id'],  $array['name'], $array['database'], $array['username'], $array['password'], $array['server']);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->dbname;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname): void
    {
        $this->dbname = $dbname;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server): void
    {
        $this->server = $server;
    }


}
