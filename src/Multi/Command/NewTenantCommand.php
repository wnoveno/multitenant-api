<?php
namespace App\Multi\Command;

use App\Multi\Entity\Tenant;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Datetime;

class NewTenantCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        //Create cron task to run php app/console catalyst:payroll:generate per day
        $this->setName('api:new-tenant')
            ->setDescription('create new tenant')
            ->addArgument('name', InputArgument::REQUIRED, '');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $em = $container->get('doctrine')->getEntityManager();
        $conn = $em->getConnection('doctrine');
        $name = $input->getArgument('name');

        $tenant = new Tenant($name, "multi_".$name , $conn->getUsername(), $conn->getPassword(), $conn->getHost());

        $em->persist($tenant);
        $em->flush();

    }
}
