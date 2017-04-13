<?php

namespace diaz\david\repository;

use Doctrine\ORM\EntityManager;
use Exception;

/**
 * Class DoctrineCreatorUserRepository
 * @package diaz\david\repository
 */
class DoctrineCreatorUserRepository implements CreatorUserRepository
{
    /** @var EntityManager */
    private $_entityManager;

    /**
     * DoctrineCreatorUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    /**
     * @param CreatorUserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function save(CreatorUserRepositoryDTO $dto)
    {
        try {
            $userEntity = $this->_createUserEntity($dto);
            $this->_persistEntity($userEntity);
        } catch (Exception $e) {
            throw new DataNotStorageException();
        }
    }

    /**
     * @param CreatorUserRepositoryDTO $dto
     * @return UserEntity
     */
    private function _createUserEntity(CreatorUserRepositoryDTO $dto): UserEntity
    {
        $userEntity = new UserEntity();
        $userEntity->setName($dto->getName());
        $userEntity->setSurname($dto->getSurname());
        return $userEntity;
    }

    /**
     * @param UserEntity $userEntity
     */
    private function _persistEntity(UserEntity $userEntity)
    {
        $this->_entityManager->persist($userEntity);
        $this->_entityManager->flush();
    }
}