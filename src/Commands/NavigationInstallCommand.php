<?php

namespace Fuelviews\Navigation\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class NavigationInstallCommand extends Command
{
    protected $signature = 'navigation:install';

    protected $description = 'Install packages and dependencies';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $packages = [
            'ralphjsmit/laravel-glide' => '^1.2',
        ];

        $requireCommand = 'composer require';
        foreach ($packages as $package => $version) {
            $requireCommand .= " {$package}:{$version}";
        }

        $this->info('Installing packages...');

        $this->runShellCommand($requireCommand);

        $this->info('Packages installed successfully.');
    }

    private function runShellCommand($command)
    {
        $process = Process::fromShellCommandline($command);

        // Set the input to the process's standard input, allowing for interaction
        $process->setTty(Process::isTtySupported());

        // Run the process
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}