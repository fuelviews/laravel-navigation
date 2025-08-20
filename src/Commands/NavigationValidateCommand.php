<?php

namespace Fuelviews\Navigation\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class NavigationValidateCommand extends Command
{
    public $signature = 'navigation:validate';

    public $description = 'Validate the navigation configuration';

    public function handle(): int
    {
        $this->info('Validating navigation configuration...');
        $this->newLine();

        $errors = [];
        $warnings = [];
        $navigationItems = config('navigation.navigation', []);

        if (empty($navigationItems)) {
            $errors[] = 'No navigation items found in configuration';
        }

        $positions = [];

        foreach ($navigationItems as $index => $item) {
            $this->validateNavigationItem($item, $index, $errors, $warnings, $positions);
        }

        $this->validateDuplicatePositions($positions, $errors);

        $this->displayResults($errors, $warnings);

        return empty($errors) ? self::SUCCESS : self::FAILURE;
    }

    protected function validateNavigationItem(array $item, int $index, array &$errors, array &$warnings, array &$positions): void
    {
        if (! isset($item['type'])) {
            $errors[] = "Navigation item at index {$index} is missing 'type' field";
        } elseif (! in_array($item['type'], ['link', 'dropdown'])) {
            $errors[] = "Navigation item at index {$index} has invalid type '{$item['type']}'. Must be 'link' or 'dropdown'";
        }

        if (! isset($item['position'])) {
            $errors[] = "Navigation item at index {$index} is missing 'position' field";
        } else {
            $positions[] = $item['position'];
        }

        if (! isset($item['name'])) {
            $errors[] = "Navigation item at index {$index} is missing 'name' field";
        }

        if (($item['type'] ?? '') === 'link') {
            $this->validateLinkItem($item, $index, $errors, $warnings);
        } elseif (($item['type'] ?? '') === 'dropdown') {
            $this->validateDropdownItem($item, $index, $errors, $warnings);
        }
    }

    protected function validateLinkItem(array $item, int $index, array &$errors, array &$warnings): void
    {
        if (! isset($item['route'])) {
            $errors[] = "Link navigation item at index {$index} is missing 'route' field";
        } elseif (! Route::has($item['route'])) {
            $warnings[] = "Route '{$item['route']}' for navigation item at index {$index} does not exist";
        }
    }

    protected function validateDropdownItem(array $item, int $index, array &$errors, array &$warnings): void
    {
        if (! isset($item['links'])) {
            $errors[] = "Dropdown navigation item at index {$index} is missing 'links' field";
        } elseif (! is_array($item['links'])) {
            $errors[] = "Dropdown navigation item at index {$index} 'links' field must be an array";
        } elseif (empty($item['links'])) {
            $warnings[] = "Dropdown navigation item at index {$index} has no links";
        } else {
            foreach ($item['links'] as $linkIndex => $link) {
                if (! isset($link['name'])) {
                    $errors[] = "Dropdown link at index {$linkIndex} for navigation item {$index} is missing 'name' field";
                }
                if (! isset($link['route'])) {
                    $errors[] = "Dropdown link at index {$linkIndex} for navigation item {$index} is missing 'route' field";
                } elseif (! Route::has($link['route'])) {
                    $warnings[] = "Route '{$link['route']}' for dropdown link at index {$linkIndex} does not exist";
                }
            }
        }
    }

    protected function validateDuplicatePositions(array $positions, array &$errors): void
    {
        $duplicates = array_filter(array_count_values($positions), fn ($count) => $count > 1);

        foreach ($duplicates as $position => $count) {
            $errors[] = "Position {$position} is used {$count} times. Positions must be unique.";
        }
    }

    protected function displayResults(array $errors, array $warnings): void
    {
        if (! empty($errors)) {
            $this->error('❌ Validation failed with '.count($errors).' error(s):');
            foreach ($errors as $error) {
                $this->line("  • {$error}");
            }
            $this->newLine();
        }

        if (! empty($warnings)) {
            $this->warn('⚠️  Found '.count($warnings).' warning(s):');
            foreach ($warnings as $warning) {
                $this->line("  • {$warning}");
            }
            $this->newLine();
        }

        if (empty($errors) && empty($warnings)) {
            $this->info('✅ Navigation configuration is valid!');
        } elseif (empty($errors)) {
            $this->info('✅ Navigation configuration is valid (with warnings).');
        }
    }
}
