<?php

namespace Validator;

use Request\Product as ProductRequest;
use App;

abstract class ValidatorAbstract
{
    const VALIDATOR_PATH = 'models/Validator/';

    const VALIDATION_CLASSES_PATH = '';

    protected $fullPath;



    public function __construct()
    {
        $this->fullPath = app_path(self::VALIDATOR_PATH . static::VALIDATION_CLASSES_PATH);
    }


    public function validationClasses()
    {
        $classNames = array_diff(scandir($this->fullPath), array('..', '.'));
        $classes = [];

        foreach ($classNames as $name) {
            $classes[] = $this->factory($this->classPath($name));
        }

        return $classes;
    }


    protected function factory($className = '')
    {
        if (! class_exists($className)) {
            App::abort(403, "Classe \"{$className}\" não existe!");
        }

        return new $className();
    }

    protected function classPath($class)
    {
        return sprintf('Validator\\%s\\%s',
            str_replace(DIRECTORY_SEPARATOR, '\\', static::VALIDATION_CLASSES_PATH),
            basename($class, '.php')
        );
    }
}
