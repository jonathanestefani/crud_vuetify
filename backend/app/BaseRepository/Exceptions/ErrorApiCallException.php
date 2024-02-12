<?php

namespace App\BaseRepository\Exceptions;

use Exception;

class ErrorApiCallException extends Exception
{
    protected $message = "";
}
