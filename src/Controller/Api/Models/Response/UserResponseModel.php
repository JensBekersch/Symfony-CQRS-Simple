<?php declare(strict_types=1);

namespace App\Controller\Api\Models\Response;

use App\Controller\Api\Models\RequestModelInterface;

class UserResponseModel implements RequestModelInterface
{
    private $id;
    private $firstName;
    private $lastName;
    private $nickname;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : RequestModelInterface
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName) : RequestModelInterface
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName) : RequestModelInterface
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname) : RequestModelInterface
    {
        $this->nickname = $nickname;

        return $this;
    }

}
