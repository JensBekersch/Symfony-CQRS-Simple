<?php declare(strict_types=1);

namespace App\Controller\Api\Models\Request;


use App\Controller\Api\Models\RequestModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserRequestModel implements RequestModelInterface
{
    /**
     * @Assert\NotBlank(message="Bitte geben Sie einen Vornamen an!")
     */
    private $firstName;
    /**
     * @Assert\NotBlank(message="Bitte geben Sie einen Nachnamen an!")
     */
    private $lastName;
    /**
     * @Assert\NotBlank(message="Bitte geben Sie einen Nicknamen an!")
     */
    private $nickname;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }

}
