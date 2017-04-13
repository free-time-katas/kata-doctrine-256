<?php

namespace diaz\david\repository;

/**
 * Class DataNotStorageException
 * @package diaz\david\repository
 */
class DataNotStorageException extends \Exception
{
    /**
     * DataNotStorageException constructor.
     */
    public function __construct()
    {
        parent::__construct('Data Not Storage');
    }
}