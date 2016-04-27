<?php

namespace Droid\Plugin\Service\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class ServiceReloadCommand extends BaseServiceCommand
{
    public function configure()
    {
        $this->setName('service:reload')
            ->setDescription('Reload a service');
        parent::configure();
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $this->serviceAction($name, 'reload', $output);
    }
}
