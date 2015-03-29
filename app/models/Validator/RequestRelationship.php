<?php

namespace Validator;

use Request\Relationship as RelationshipRequest;

class RequestRelationship extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/Relationship';

    protected $requestRelationship;

    protected $error = '';

    public function __construct(RelationshipRequest $requestRelationship)
    {
        parent::__construct();
        $this->requestRelationship = $requestRelationship;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestRelationship)) {
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
