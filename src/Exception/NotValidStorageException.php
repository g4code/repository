<?php

namespace G4\Repository\Exception;

use Exception;
use G4\Repository\ErrorCodes;

class NotValidStorageException extends Exception
{

    const MESSAGE = 'Not valid storage instance provided.';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, ErrorCodes::NOT_VALID_STORAGE_EXCEPTION);
    }
}