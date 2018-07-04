<?php


class StringValidator implements Validator {
        private $minLength;
        private $maxLength;

        function __construct() {
            $this->minLength = 0;
            $this->maxLength = 255;
        }

        function setMinLength(int $length){
            $this->minLength = max(0, $length);
            return $this;
        }

        function setMaxLength(int $length){
            $this->maxLength = max(1, $length);
            return $this;
        }

        function isValid(string $value){
            $len = strlen($value);
            return $this->minLength <= $len && $len <= $this->maxLength;
        }
    }
