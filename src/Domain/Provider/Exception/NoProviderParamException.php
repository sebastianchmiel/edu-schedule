<?php

namespace App\Domain\Provider\Exception;

use App\Domain\Exception\DomainException;

/**
 * Not defined provider param exception
 */
class NoProviderParamException extends DomainException {
    protected $message = 'Not defined provider param exception';
}