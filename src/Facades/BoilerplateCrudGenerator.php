<?php

namespace Sprintdigital\BoilerplateCrudGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sprintdigital\BoilerplateCrudGenerator\BoilerplateCrudGenerator
 */
class BoilerplateCrudGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'boilerplate-crud-generator';
    }
}
