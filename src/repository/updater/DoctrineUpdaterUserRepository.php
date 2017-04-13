<?php

namespace diaz\david\repository\updater;

use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\UserEntity;
use diaz\david\repository\UserRepositoryDTO;
use Doctrine\ORM\EntityManager;
use Exception;

/**
 * Class DoctrineUpdaterUserRepository
 * @package diaz\david\repository\updater
 */
class DoctrineUpdaterUserRepository implements UpdaterUserRepository
{
    /** @var EntityManager */
    private $_entityManager;

    /**
     * DoctrineUpdaterUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    /**
     * @param UserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function update(UserRepositoryDTO $dto)
    {
        try {
            $userEntity = $this->_createUserEntity($dto);
            $this->_entityManager->persist($userEntity);
            $this->_entityManager->flush();
        } catch (Exception $e) {
            throw new DataNotStorageException();
        }
    }

    /**
     * @param UserRepositoryDTO $dto
     * @return UserEntity
     */
    private function _createUserEntity(UserRepositoryDTO $dto): UserEntity
    {
        /** @var UserEntity $userEntity */
        $userEntity = $this->_entityManager->getRepository(UserEntity::class)->find($dto->getId());
        if (!empty($dto->getName())) {
            $userEntity->setName($dto->getName());
        }
        if (!empty($dto->getSurname())) {
            $userEntity->setSurname($dto->getSurname());
        }
        return $userEntity;
    }
}