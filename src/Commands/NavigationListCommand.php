<?php

namespace Fuelviews\Navigation\Commands;

use Illuminate\Console\Command;

class NavigationListCommand extends Command
{
    public $signature = 'navigation:list';

    public $description = 'List all navigation items configured in the application';

    public function handle(): int
    {
        $navigationItems = app('navigation')->getNavigationItems();

        if ($navigationItems->isEmpty()) {
            $this->info('No navigation items found.');

            return self::SUCCESS;
        }

        $this->info('Navigation Items:');
        $this->newLine();

        $headers = ['Position', 'Type', 'Name', 'Route/Links'];
        $rows = [];

        foreach ($navigationItems as $item) {
            $routeOrLinks = $item['type'] === 'dropdown'
                ? count($item['links'] ?? []).' links'
                : ($item['route'] ?? 'N/A');

            $rows[] = [
                $item['position'] ?? 'N/A',
                $item['type'] ?? 'N/A',
                $item['name'] ?? 'N/A',
                $routeOrLinks,
            ];
        }

        $this->table($headers, $rows);

        return self::SUCCESS;
    }
}