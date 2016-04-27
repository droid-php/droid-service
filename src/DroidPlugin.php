<?php

namespace Droid\Plugin\Service;

class DroidPlugin
{
    public function __construct($droid)
    {
        $this->droid = $droid;
    }
    
    public function getCommands()
    {
        $commands = [];
        $commands[] = new \Droid\Plugin\Service\Command\ServiceStartCommand();
        $commands[] = new \Droid\Plugin\Service\Command\ServiceStopCommand();
        $commands[] = new \Droid\Plugin\Service\Command\ServiceReloadCommand();
        $commands[] = new \Droid\Plugin\Service\Command\ServiceRestartCommand();
        return $commands;
    }
}
