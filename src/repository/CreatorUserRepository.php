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
     */
    public function save(CreatorUserRepositoryDTO $dto);
}