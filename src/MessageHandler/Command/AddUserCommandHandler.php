<?php declare(strict_types=1);

namespace App\MessageHandler\Command;

use App\DataTransferHelper\DataUtilsFactory;
use App\Entity\User;
use App\Message\AddUser;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddUserCommandHandler implements MessageHandlerInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager  = $entityManager;
    }

    /**
     * @param AddUser $addUser
     * @throws Error
     * @throws Exception
     */
    public function __invoke(AddUser $addUser)
    {
        $user = new User;

        $dataUtils = DataUtilsFactory::create();
        $dataUtils->copyProperties($addUser->getUserDto(), $user);
        $this->entityManager->persist($user);

        $this->entityManager->flush();
    }

}
