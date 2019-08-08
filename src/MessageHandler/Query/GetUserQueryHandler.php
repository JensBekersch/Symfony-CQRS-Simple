<?php declare(strict_types=1);

namespace App\MessageHandler\Query;

use App\DataTransferHelper\DataUtilsFactory;
use App\Controller\Api\Models\Response\UserResponseModel;
use App\Message\GetUser;
use App\Repository\UserRepository;
use Error;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetUserQueryHandler implements MessageHandlerInterface
{

    private $userRepository;
    private $responseModel;

    public function __construct(UserRepository $userRepository, UserResponseModel $responseModel)
    {
        $this->userRepository = $userRepository;
        $this->responseModel = $responseModel;
    }

    /**
     * @param GetUser $selectedUser
     * @throws Error
     * @throws Exception
     */
    public function __invoke(GetUser $selectedUser)
    {
        $selectedUser->setResponse($this->query($selectedUser->getId()));
    }

    /**
     * @param int $id
     * @return UserResponseModel
     * @throws Error
     * @throws Exception
     */
    public function query(int $id) {
        $dataUtils = DataUtilsFactory::create();
        $user = $this->userRepository->find($id);
        $dataUtils->copyProperties($user, $this->responseModel);

        return $this->responseModel;
    }

}
