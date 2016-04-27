<?php

namespace Droid\Plugin\Service\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use RuntimeException;

abstract class BaseServiceCommand extends Command
{
    public function configure()
    {
        $this
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the service'
            )
        ;
    }
    
    private function executableExists($cmd)
    {
        $returnVal = shell_exec("which $cmd");
        return (empty($returnVal) ? false : true);
    }
    
    protected function serviceAction($name, $action, OutputInterface $output)
    {
        if (!$this->executableExists('service')) {
            throw new RuntimeException(
                "service command not available on this platform or for the current user (need sudo?)"
            );
        }
        
        $cmd = 'service';
        $cmd .= ' ' . $name . ' ' . $action;
        $process = new Process($cmd);
        $output->writeLn($process->getCommandLine());
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        $output->write($process->getOutput());
    }
}
