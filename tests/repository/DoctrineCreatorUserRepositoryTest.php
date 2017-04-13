<?php

namespace diaz\david\tests\repository;

use diaz\david\repository\CreatorUserRepositoryDTO;
use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\DoctrineCreatorUserRepository;
use diaz\david\repository\UserEntity;
use diaz\david\tests\fake\FakeEntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

/**
 * 1. El repositorio debe guardar correctamente
 * 2. Si el repositorio no puede guardar levanta un DataNotStoreException
 */

/**
 * Class DoctrineCreatorUserRepositoryTest
 * @package diaz\david\tests\repository
 */
class DoctrineCreatorUserRepositoryTest extends TestCase
{
    /** @var DoctrineCreatorUserRepository */
    private $_repository;
    /** @var FakeEntityManager */
    private $_entityManager;

    /** @test */
    public function repositoryMustStorageCorrectly()
    {
        $dto = new CreatorUserRepositoryDTO();
        $dto->setName('David');
        $dto->setSurname('Díaz');
        $this->_repository->save($dto);
        $expected = new UserEntity();
        $expected->setId(1);
        $expected->setName('David');
        $expected->setSurname('Díaz');
        $this->assertEquals($expected, $this->_findEntityById(1));

        $dto = new CreatorUserRepositoryDTO();
        $dto->setName('Pepe');
        $dto->setSurname('Lopez');
        $this->_repository->save($dto);
        $expected = new UserEntity();
        $expected->setId(2);
        $expected->setName('Pepe');
        $expected->setSurname('Lopez');
        $this->assertEquals($expected, $this->_findEntityById(2));
    }

    /**
     * @param int $id
     * @return UserEntity
     */
    private function _findEntityById(int $id): UserEntity
    {
        $this->_entityManager->clear();
        $entity = $this->_entityManager->getRepository(UserEntity::class)->find($id);
        return $entity;
    }

    /** @test */
    public function whenRepositoryCanNotStorageThenThrowDataNotStorageException()
    {
        $this->_entityManager->setThrowException(true);
        $dto = new CreatorUserRepositoryDTO();
        $dto->setName('Pepe');
        $dto->setSurname('Lopez');

        try {
            $this->_repository->save($dto);
            $this->fail('Should Throw DataNotStorageException');
        } catch (DataNotStorageException $e) {
            $this->assertTrue(true);
        }

        $this->_entityManager->setThrowException(false);

        try {
            $this->_repository->save($dto);
            $this->assertTrue(true);
        } catch (DataNotStorageException $e) {
            $this->fail('Should\'t Throw DataNotStorageException');
        }
    }

    /**
     *
     */
    protected function setUp()
    {
        $paths = [UserEntity::class];
        $configuration = Setup::createAnnotationMetadataConfiguration($paths, [
            true, null, null, true
        ]);
        $this->_entityManager = new FakeEntityManager($configuration);
        $this->_repository = new DoctrineCreatorUserRepository($this->_entityManager);
        $tool = new SchemaTool($this->_entityManager);
        $classMetadata = $this->_entityManager->getClassMetadata(UserEntity::class);
        $tool->createSchema([$classMetadata]);
    }
}
