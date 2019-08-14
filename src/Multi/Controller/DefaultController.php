<?php

namespace App\Multi\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/validate", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if($this->get('doctrine.dbal.tenant_connection')->isConnected())
        {
            $success = true;
        }else {
            $success = false;
        }

        return new JsonResponse(['success'=>$success]);

    }
}
