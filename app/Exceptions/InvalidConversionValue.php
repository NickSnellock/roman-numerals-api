<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidConversionValue extends Exception
{
    protected $message = 'Invalid value to convert';
}
