<?php

namespace Deltatuts\Fixer\Exception;

use Exception;

/**
 * Class InvalidCurrencyCodeException
 * @package Deltatuts\Fixer\Exception
 */
class InvalidCurrencyCodeException extends Exception
{
    /**
     * InvalidCurrencyCodeException constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct(
            "{$value} is not a valid alpha3 currency code",
            400
        );
    }
}
