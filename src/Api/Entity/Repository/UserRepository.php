<?php
namespace App\Api\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{

    public function loadUserByUsername($usernameOrEmail)
    {
        $em = $this->getEntityManager('tenant');
        $result = $em->createQuery('SELECT u FROM Api:User u  WHERE u.username = :query OR u.email = :query')
            ->setParameter('query', $usernameOrEmail)
            ->getOneOrNullResult();
        return $result;
    }
}