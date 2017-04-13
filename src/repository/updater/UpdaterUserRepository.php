<?php

namespace diaz\david\repository\updater;

use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\UserRepositoryDTO;

/**
 * Interface UpdaterUserRepository
 * @package diaz\david\repository\updater
 */
interface UpdaterUserRepository
{
    /**
     * @param UserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function update(UserRepositoryDTO $dto);
}