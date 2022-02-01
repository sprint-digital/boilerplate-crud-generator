<?php

namespace sprintdigital\BoilerplateCrudGenerator\Commands;

use Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BoilerplateCrudGeneratorCommand extends Command
{
    public $signature = 'make:crud {name} {--force}';

    public $description = 'Create a new CRUD based on name.';

    public $modelName = '';

    public function handle(): int
    {
        // Transform l5b:crud command parameter to singular lowercase
        $name = Str::lower(Str::snake(Str::singular($this->argument('name'))));

        $this->modelName = ucfirst(Str::camel($name));

        // Create Model "Name.php"
        $this->model($name, $this->modelName, 'make-model.stub');

        // Create Attribute Trait "NameAttribute.php"
        $this->attribute($name, "{$this->modelName}Attribute", 'make-attribute.stub');

        // Create Relationship Trait "NameRelationship.php"
        $this->relationship($name, "{$this->modelName}Relationship", 'make-relationship.stub');

        // Create Scope Trait "NameScope.php"
        $this->scope($name, "{$this->modelName}Scope", 'make-scope.stub');

        // Create Repository "NameRepository.php"
        $this->repository($name, "{$this->modelName}Repository", 'make-repository.stub');

        // Create Migration "{date}_create_names_table.php"
        $this->migration($name, date('Y_m_d_His_') . "create_" . Str::plural($name) . "_table", 'make-migration.stub');

        // Create Seeder "NameSeeder.php"
        $this->seeder($name, "{$this->modelName}Seeder", 'make-seeder.stub');

        // Create GraphQL "name.graphql"
        $this->graphql($name, $name, 'make-graphql.stub');

        // Create GraphQL Validator "CreateNameInputValidator.php"
        $this->graphqlValidator($name, "Create{$this->modelName}InputValidator", 'make-graphql-validator.stub');

        // Create GraphQL Validator "UpdateNameInputValidator.php"
        $this->graphqlValidator($name, "Update{$this->modelName}InputValidator", 'make-graphql-validator.stub');

        // Create GraphQL Query "NameQuery.php"
        $this->graphqlQuery($name, "{$this->modelName}Query", 'make-graphql-query.stub');

        // Create GraphQL Validator "NameMutation.php"
        $this->graphqlMutation($name, "{$this->modelName}Mutation", 'make-graphql-mutation.stub');

        // Create Test "NameTest.php"
        $this->test($name, "{$this->modelName}Test", 'make-test.stub');

        $this->comment('All done');

        return self::SUCCESS;
    }

    protected function model($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\Models',
            'attribute' => "{$this->modelName}Attribute",
            'scope' => "{$this->modelName}Scope",
            'relationship' => "{$this->modelName}Relationship",
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Model ' . $stubParams['name'] . Artisan::output());
    }

    protected function attribute($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\Models\Traits\Attributes',
            'attribute' => "{$this->modelName}Attribute",
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Attribute ' . $stubParams['name'] . Artisan::output());
    }

    protected function relationship($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\Models\Traits\Relationships',
            'relationship' => "{$this->modelName}Relationship",
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Relationship ' . $stubParams['name'] . Artisan::output());
    }

    protected function scope($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\Models\Traits\Scopes',
            'scope' => "{$this->modelName}Scope",
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Scope ' . $stubParams['name'] . Artisan::output());
    }

    protected function repository($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\Repositories',
            'model' => $this->modelName,
            'repository' => "{$this->modelName}Repository",
            'variable' => $key,
            'label' => Str::plural($key),
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Repository ' . $stubParams['name'] . Artisan::output());
    }

    protected function migration($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\..\database\migrations',
            'class' => "Create" . ucfirst(Str::plural(Str::camel($key))) . "Table",
            'table' => Str::plural($key),
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        // If no migration with name "*create_names_table.php" exists then create it
        if (! glob(database_path() . "/migrations/*create_" . Str::plural($key) . "_table.php")) {
            Artisan::call('make:stub', $stubParams);
            $this->comment('Migration ' . $stubParams['name'] . Artisan::output());
        } else {
            $this->comment('A migration file for the table ' . Str::plural($key) . " already exists!\n");
        }
    }

    protected function seeder($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\..\database\seeders',
            'seeder' => "{$this->modelName}Seeder",
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Seeder ' . $stubParams['name'] . Artisan::output());
    }

    protected function graphql($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\..\graphql\models',
            'label' => Str::plural($key),
            'variable' => Str::camel($key),
            'graphql' => true,
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Graphql ' . $stubParams['name'] . Artisan::output());
    }

    protected function graphqlValidator($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\GraphQL\Validators',
            'class' => $name,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Graphql Validator ' . $stubParams['name'] . Artisan::output());
    }

    protected function graphqlQuery($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\GraphQL\Queries',
            'class' => $name,
            'variable' => Str::camel($key),
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Graphql Query ' . $stubParams['name'] . Artisan::output());
    }

    protected function graphqlMutation($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\GraphQL\Mutations',
            'class' => $name,
            'variable' => Str::camel($key),
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Graphql Mutation ' . $stubParams['name'] . Artisan::output());
    }

    protected function test($key, $name, $stub)
    {
        $stubParams = [
            'name' => $name,
            'stub' => __DIR__ . '/Stubs/' . $stub,
            'namespace' => '\..\tests\Feature',
            'class' => $name,
            'label' => Str::plural($key),
            'variable' => Str::camel($key),
            'model' => $this->modelName,
            '--force' => $this->hasOption('force') ? $this->option('force') : false,
        ];

        Artisan::call('make:stub', $stubParams);
        $this->comment('Test ' . $stubParams['name'] . Artisan::output());
    }
}
