<?php

namespace diaz\david\tests\repository\updater;

use diaz\david\repository\DataNotStorageException;
use diaz\david\repository\updater\DoctrineUpdaterUserRepository;
use diaz\david\repository\UserEntity;
use diaz\david\repository\UserRepositoryDTO;
use diaz\david\tests\fake\FakeEntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

/**
 * 1. El repositorio debe actualizar el usuario cocrrectamente
 * 2. El repositorio solo debe actualizar los datos que se le envian
 * 3. Si el repositorio no puede actualizar lanza un DataNotStorageException
 */

/**
 * Class DoctrineUpdaterUserRepositoryTest
 * @package diaz\david\tests\repository\updater
 */
class DoctrineUpdaterUserRepositoryTest extends TestCase
{
    /** @var DoctrineUpdaterUserRepository */
    private $_repository;
    /** @var FakeEntityManager */
    private $_entityManager;

    /** @test */
    public function repositoryMustUpdateCorrectly()
    {
        $this->_addUserEntity('David', 'Díaz');
        $dto = new UserRepositoryDTO();
        $dto->setId(1);
        $dto->setName('Pepe');
        $dto->setSurname('Lopez');
        $this->_repository->update($dto);
        $expected = new UserEntity();
        $expected->setId(1);
        $expected->setName('Pepe');
        $expected->setSurname('Lopez');
        $this->assertEquals($expected, $this->_findUserEntityById(1));

        $this->_addUserEntity('Manolito', 'Gafotas');
        $dto = new UserRepositoryDTO();
        $dto->setId(2);
        $dto->setName('Laura');
        $dto->setSurname('Gomez');
        $this->_repository->update($dto);
        $expected = new UserEntity();
        $expected->setId(2);
        $expected->setName('Laura');
        $expected->setSurname('Gomez');
        $this->assertEquals($expected, $this->_findUserEntityById(2));
    }

    /**
     * @param string $name
     * @param string $surname
     */
    private function _addUserEntity(string $name, string $surname)
    {
        $userEntity = new UserEntity();
        $userEntity->setName($name);
        $userEntity->setSurname($surname);
        $this->_entityManager->persist($userEntity);
        $this->_entityManager->flush();
        $this->_entityManager->clear();
    }

    /**
     * @param int $id
     * @return null|object
     */
    private function _findUserEntityById(int $id)
    {
        return $this->_entityManager->getRepository(UserEntity::class)->find($id);
    }

    /** @test */
    public function repositoryNotUpdateAttributesNull()
    {
        $this->_addUserEntity('David', 'Díaz');
        $dto = new UserRepositoryDTO();
        $dto->setId(1);
        $dto->setName('Pepe');
        $this->_repository->update($dto);
        $expected = new UserEntity();
        $expected->setId(1);
        $expected->setName('Pepe');
        $expected->setSurname('Díaz');
        $this->assertEquals($expected, $this->_findUserEntityById(1));

        $this->_addUserEntity('Manolito', 'Gafotas');
        $dto = new UserRepositoryDTO();
        $dto->setId(2);
        $dto->setSurname('Gomez');
        $this->_repository->update($dto);
        $expected = new UserEntity();
        $expected->setId(2);
        $expected->setName('Manolito');
        $expected->setSurname('Gomez');
        $this->assertEquals($expected, $this->_findUserEntityById(2));
    }

    /** @test */
    public function whenRepositoryCanNotUpdateThenThrowDataNotStorageException()
    {
        $this->_addUserEntity('Manolito', 'Gafotas');
        $dto = new UserRepositoryDTO();
        $dto->setId(1);
        $dto->setName('Pepe');
        $dto->setSurname('Lopez');

        $this->_entityManager->setThrowException(true);
        try {
            $this->_repository->update($dto);
            $this->fail('Should Throw DataNotStorageException');
        } catch (DataNotStorageException $e) {
            $this->assertTrue(true);
        }

        $this->_entityManager->setThrowException(false);

        try {
            $this->_repository->update($dto);
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
        $this->_repository = new DoctrineUpdaterUserRepository($this->_entityManager);
        $tool = new SchemaTool($this->_entityManager);
        $classMetadata = $this->_entityManager->getClassMetadata(UserEntity::class);
        $tool->createSchema([$classMetadata]);
    }


}
