<?php

namespace G4\Repository\Exception;

use Exception;
use G4\Repository\ErrorCodes;

class MissingStorageException extends Exception
{

    const MESSAGE = 'Expected at least one storage, none given.';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, ErrorCodes::MISSING_STORAGE_INSTANCE_EXCEPTION);
    }
}