<?php

namespace diaz\david\repository;

/**
 * Class UserRepositoryDTO
 * @package diaz\david\repository
 */
class UserRepositoryDTO
{
    /** @var int */
    private $_id;
    /** @var string */
    private $_name;
    /** @var string */
    private $_surname;

    /**
     * @return int
     */
    public function getId()
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
    public function getName()
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
    public function getSurname()
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