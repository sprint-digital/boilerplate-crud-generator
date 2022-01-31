<?php

namespace sprintdigital\BoilerplateCrudGenerator\Commands;

use Illuminate\Console\Command;

class BoilerplateCrudGeneratorCommand extends Command
{
    public $signature = 'boilerplate-crud-generator';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
