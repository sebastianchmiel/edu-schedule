<?php

namespace App\Domain\Exception;

/**
 * global domain exception
 */
class DomainException extends \Exception {
    protected $message = 'Domain exception';
}