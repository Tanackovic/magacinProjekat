<?php

class NumberValidator implements Validator {

    private $isSigned;
    private $integerLength;
    private $isReal;
    private $maxDecimalDigits;

    public function __construct() {
        $this->isSigned = false;
        $this->isReal = false;
        $this->integerLength = 10;
        $this->maxDecimalDigits = 3;
    }

    public function setInteger() {
        $this->isReal = false;
        return $this;
    }

    public function setDecimal() {
        $this->isReal = true;
        return $this;
    }

    public function setSigned() {
        $this->isSigned = true;
        return $this;
    }

    public function setUnsigned() {
        $this->isSigned = false;
        return $this;
    }

    public function setIntegerLength(int $length) {
        $this->integerLength = max(1, $length);
        return $this;
    }

    public function setMaxDecimalDigits(int $maxDigits) {
        $this->maxDecimalDigits = max(0, $maxDigits);
        return $this;
    }

    public function isValid(string $value) {
        $pattern = '/^';

        if ($this->isSigned === true) {
            $pattern .= '\-?';
        }

        $pattern .= '[1-9][0-9]{0,' . ($this->integerLength - 1) . '}';

        if ($this->isReal === true) {
            $pattern .= '.[0-9]{0,' . $this->maxDecimalDigits . '}';
        }

        $pattern .= '$/';
        return preg_match($pattern, $value);
    }

}
