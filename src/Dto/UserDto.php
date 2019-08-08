<?php declare(strict_types=1);

namespace App\Dto;

class UserDto implements UserDtoInterface
{
    private $id;
    private $firstName;
    private $lastName;
    private $nickname;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : UserDtoInterface
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName) : UserDtoInterface
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName) : UserDtoInterface
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname) : UserDtoInterface
    {
        $this->nickname = $nickname;

        return $this;
    }

}
