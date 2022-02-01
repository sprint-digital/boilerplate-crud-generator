<?php

namespace sprintdigital\BoilerplateCrudGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use sprintdigital\BoilerplateCrudGenerator\Commands\BoilerplateCrudGeneratorCommand;
use sprintdigital\BoilerplateCrudGenerator\Commands\BoilerplateStubCommand;

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
