<?php

namespace sprintdigital\BoilerplateCrudGenerator\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class BoilerplateCrudGeneratorCommand extends Command
{
    public $signature = 'make:crud {name} {--m|migrate} {--force}';

    public $description = 'Create a new CRUD based on name.';

    public function handle(): int
    {
        // Transform l5b:crud command parameter to singular lowercase
        $name = Str::lower(Str::snake(Str::singular($this->argument('name'))));

        info($name);

        $this->comment($name);

        // Add - Model
        // Add - Attribute
        // Add - Scope
        // Add - Relationship
        // Add - Repository
        
        // Add - Migration
        // Add - Seeder
        // Modify - Database seeder? maybe

        // GraphQL
        // Add - model.graphql
        // Add - Validators
        // Add - Query?
        // Add - Mutations?

        // Test
        // Add Test


        $this->comment('All done');

        return self::SUCCESS;
    }
}
