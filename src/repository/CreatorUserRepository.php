<?php

namespace diaz\david\repository;

/**
 * Interface CreatorUserRepository
 * @package diaz\david\repository
 */
interface CreatorUserRepository
{
    /**
     * @param UserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function save(UserRepositoryDTO $dto);
}