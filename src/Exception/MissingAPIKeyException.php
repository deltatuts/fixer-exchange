<?php

namespace Deltatuts\Fixer\Exception;

/**
 * Class MissingAPIKeyException
 * @package Deltatuts\Fixer\Exception
 */
class MissingAPIKeyException extends \Exception
{
    /**
     * MissingAPIKeyException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            "You need to specify a non empty API key",
            400,
            null
        );
    }
}
