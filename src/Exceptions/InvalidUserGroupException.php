<?php

namespace LiveControls\Groups\Exceptions;

use Exception;
use Throwable;

class InvalidUserGroupException extends Exception
{
    public function __construct(string $usergroup, $code = 0, Throwable $previous = null) {
        parent::__construct('Invalid Usergroup "'.$usergroup.'"', $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}