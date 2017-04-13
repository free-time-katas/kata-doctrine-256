<?php

namespace diaz\david\repository;

/**
 * Class CreatorUserRepositoryDTO
 * @package diaz\david\repository
 */
class CreatorUserRepositoryDTO
{
    /** @var string */
    private $_name;
    /** @var string */
    private $_surname;

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