<?php

class Field {

    private $validator;

    function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    function isValid(string $value) {
        return $this->validator->isValid($value);
    }
}
