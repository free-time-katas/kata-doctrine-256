<?php

namespace diaz\david\repository;

/**
 * Interface CreatorUserRepository
 * @package diaz\david\repository
 */
interface CreatorUserRepository
{
    /**
     * @param CreatorUserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function save(CreatorUserRepositoryDTO $dto);
}