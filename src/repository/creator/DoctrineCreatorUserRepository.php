<?php

namespace diaz\david\repository\creator;

use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\UserEntity;
use diaz\david\repository\UserRepositoryDTO;
use Doctrine\ORM\EntityManager;
use Exception;

/**
 * Class DoctrineCreatorUserRepository
 * @package diaz\david\repository\creator
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
     * @param UserRepositoryDTO $dto
     * @throws DataNotStorageException
     */
    public function save(UserRepositoryDTO $dto)
    {
        try {
            $userEntity = $this->_createUserEntity($dto);
            $this->_persistEntity($userEntity);
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