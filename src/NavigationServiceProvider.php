<?php

namespace Fuelviews\Navigation;

use Fuelviews\Navigation\Commands\NavigationListCommand;
use Fuelviews\Navigation\Commands\NavigationValidateCommand;
use Fuelviews\Navigation\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\Components\Footer\Footer;
use Fuelviews\Navigation\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\Components\NavigationScroll;
use Fuelviews\Navigation\Components\Spacer;
use Fuelviews\Navigation\Components\TopBar;
use Illuminate\Support\Facades\View;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NavigationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('navigation')
            ->hasConfigFile('navigation')
            ->hasViews('navigation')
            ->publishesServiceProvider('NavigationServiceProvider')
            ->hasViewComponents(
                'navigation',
                NavigationScroll::class,
                TopBar::class,
                Footer::class,
                MobileNavigation::class,
                DesktopNavigation::class,
                DesktopDropdownButton::class,
                Spacer::class
            )
            ->hasCommand(NavigationListCommand::class)
            ->hasCommand(NavigationValidateCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Installing Laravel Navigation package...');
                    })
                    ->publishConfigFile()
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Laravel Navigation has been installed successfully!');
                        $command->info('The service provider is automatically registered via package discovery.');
                    });
            })
            ->sharesDataWithAllViews(
                'navigationConfig',
                fn () => config('navigation')
            );
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton('navigation', function ($app) {
            return new Navigation($app['config']['navigation']);
        });
    }

    public function packageBooted(): void
    {
        View::composer('navigation::*', function ($view) {
            $view->with('navigation', app('navigation'));
        });

        if ($this->app->environment('local')) {
            $this->validateConfiguration();
        }
    }

    protected function validateConfiguration(): void
    {
        $items = config('navigation.navigation', []);

        foreach ($items as $index => $item) {
            if (! isset($item['type'], $item['position'])) {
                report(new \InvalidArgumentException(
                    "Navigation item at index {$index} missing required fields 'type' or 'position'"
                ));
            }
        }
    }

    public function provides(): array
    {
        return ['navigation'];
    }
}
