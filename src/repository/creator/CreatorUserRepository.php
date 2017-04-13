<?php

namespace diaz\david\repository\creator;

use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\UserRepositoryDTO;

/**
 * Interface CreatorUserRepository
 * @package diaz\david\repository\creator
 */
interface CreatorUserRepository
{
    /**
     * @param UserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function save(UserRepositoryDTO $dto);
}