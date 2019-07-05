<?php


namespace App\Exceptions;


use Exception;
use Throwable;

class EcommerceException extends Exception
{

    public function __construct($message = "", array $parameters = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct(MessageException::getMessage($message, $parameters), $code, $previous);
    }
}