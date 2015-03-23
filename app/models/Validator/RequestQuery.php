<?php

namespace Validator;

use Request\Query as QueryRequest;

class RequestQuery extends ValidatorAbstract
{
    protected $queryClient;

    protected $error = '';

    public function __construct(QueryRequest $queryClient)
    {
        parent::__construct();
        $this->queryClient = $queryClient;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->queryClient)) {
                $this->error = $class->getError();
                return false;
            }
        }

        return true;
    }


    public function getError()
    {
        return $this->error;
    }
}
