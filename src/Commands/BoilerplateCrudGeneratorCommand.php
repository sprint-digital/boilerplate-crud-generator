<?php

namespace sprintdigital\BoilerplateCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BoilerplateCrudGeneratorCommand extends Command
{
    public $signature = 'make:crud {name}';

    public $description = 'Create a new CRUD based on name.';

    public function handle(): int
    {
        // Transform l5b:crud command parameter to singular lowercase
        $name = Str::lower(Str::snake(Str::singular($this->argument('name'))));

        info($name);

        $this->comment($name);
        $this->comment('All done');

        return self::SUCCESS;
    }
}
