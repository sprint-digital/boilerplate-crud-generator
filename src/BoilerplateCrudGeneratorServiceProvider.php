<?php

namespace Sprintdigital\BoilerplateCrudGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Sprintdigital\BoilerplateCrudGenerator\Commands\BoilerplateCrudGeneratorCommand;
use Sprintdigital\BoilerplateCrudGenerator\Commands\BoilerplateStubCommand;

class BoilerplateCrudGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('boilerplate-crud-generator')
            // ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_boilerplate-crud-generator_table')
            ->hasCommand(BoilerplateCrudGeneratorCommand::class)
            ->hasCommand(BoilerplateStubCommand::class);
    }
}
