<?php

namespace Validator;

use Request\Search as SearchRequest;

class RequestSearch extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/Search';

    protected $requestSearch;

    protected $error = '';

    public function __construct(SearchRequest $requestSearch)
    {
        parent::__construct();
        $this->requestSearch = $requestSearch;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestSearch)) {
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
