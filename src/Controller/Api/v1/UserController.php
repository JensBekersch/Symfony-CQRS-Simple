<?php declare(strict_types=1);

namespace App\Controller\Api\v1;

use App\Controller\Api\Models\Request\UserRequestModel;
use App\Form\UserForm;
use App\Message\AddUser;
use App\Message\GetUser;
use Error;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/user")
 */
class UserController extends ApiBaseController
{

    /**
     * @Route("/{id}", methods={"GET"})
     * @param int $id
     * @param GetUser $message
     * @param MessageBusInterface $queryBus
     * @return JsonResponse
     */
    public function getUserResponse(int $id, GetUser $message, MessageBusInterface $queryBus)
    {
        $message->setId($id);
        $queryBus->dispatch($message);

        return $this->createApiResponse([
            'user'=> $message->getResponse()
        ]);
    }

    /**
     * @Route("/", methods={"POST"})
     * @param Request $request
     * @param UserRequestModel $userRequest
     * @param AddUser $message
     * @param MessageBusInterface $messageBus
     * @throws Error
     * @throws Exception
     * @return JsonResponse
     */
    public function setUserRequest(Request $request, UserRequestModel $userRequest, AddUser $message, MessageBusInterface $messageBus) : JsonResponse
    {
        $validatedForm = $this->validateDataAndSubmitForm($request, UserForm::class, $userRequest);

        if ($this->formIsNotValid($validatedForm)) {
            return $this->createApiResponse(['errors' => $this->getErrors($validatedForm)]);
        }

        $message->createUserDto($userRequest);
        $messageBus->dispatch($message);

        return $this->createApiResponse('success', 201);
    }

}
