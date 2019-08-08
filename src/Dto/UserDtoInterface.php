<?php declare(strict_types=1);

namespace App\Dto;

interface UserDtoInterface
{
    public function getId() : int;

    public function setId(int $id) : UserDtoInterface;

    public function getFirstName() : string;

    public function setFirstName(string $firstName) : UserDtoInterface;

    public function getLastName() : string;

    public function setLastName(string $lastName) : UserDtoInterface;

    public function getNickname() : string;

    public function setNickname(string $nickname) : UserDtoInterface;
}
