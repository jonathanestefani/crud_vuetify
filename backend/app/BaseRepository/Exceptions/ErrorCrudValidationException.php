<?php

namespace App\BaseRepository\Exceptions;

use Exception;

class ErrorCrudValidationException extends Exception
{
    protected $message = "";
}
