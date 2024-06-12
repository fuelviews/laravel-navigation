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

        $filePath = base_path('routes/web.php');
        $search = "Route::get('/', function () {\n    return view('welcome');\n});";
        $replace = "Route::get('/', function () {\n    return view('welcome');\n})->name('welcome');";

        if (file_exists($filePath)) {
            $fileContents = file_get_contents($filePath);

            if (strpos($fileContents, $search) !== false) {
                $fileContents = str_replace($search, $replace, $fileContents);
                file_put_contents($filePath, $fileContents);
                $this->info('Route updated successfully.');
            } else {
                $this->info('The specified route was not found in the file.');
            }
        } else {
            $this->error('The web.php file does not exist.');
        }

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
