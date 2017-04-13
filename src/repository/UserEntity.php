<?php

namespace diaz\david\repository;

/**
 * Class UserEntity
 * @package diaz\david\repository
 * @Entity
 * @Table(name="user")
 */
class UserEntity
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue
     * @var int
     */
    private $_id;
    /**
     * @Column(name="name", type="string")
     * @var string
     */
    private $_name;
    /**
     * @Column(name="surname", type="string")
     * @var string
     */
    private $_surname;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->_surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname)
    {
        $this->_surname = $surname;
    }
}