<?php

namespace App\Domain\Provider\Api\Exception;

use App\Domain\Exception\DomainException;

/**
 * Failed connection to api
 */
class ConnectionFailedException extends DomainException {
    protected $message = 'Connection failed';
}