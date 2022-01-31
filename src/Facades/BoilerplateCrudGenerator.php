<?php

namespace sprintdigital\BoilerplateCrudGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \sprintdigital\BoilerplateCrudGenerator\BoilerplateCrudGenerator
 */
class BoilerplateCrudGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'boilerplate-crud-generator';
    }
}
