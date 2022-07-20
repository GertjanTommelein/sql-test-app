<?php
namespace App\Exceptions;

use Exception;

class TestDoesNotExistException extends Exception {
    public function __construct()
    {
        $this->message = 'Test bestaat niet';
    }
}
