<?php declare(strict_types=1);

namespace App\Message;

use App\Controller\Api\Models\Request\UserRequestModel;
use App\Controller\Api\Models\Response\UserResponseModel;
use App\DataTransferHelper\DataUtilsFactory;
use App\Dto\UserDtoInterface;
use Error;
use Exception;

class AddUser
{
    private $userDto;
    /**
     * @var UserResponseModel
     */
    private $userResponse;

    /**
     * AddUser constructor.
     * @param UserDtoInterface $userDto
     * @param UserResponseModel $userResponse
     */
    public function __construct(
        UserDtoInterface $userDto,
        UserResponseModel $userResponse
    ) {
        $this->userDto     = $userDto;
        $this->userResponse = $userResponse;
    }

    public function getUserDto()
    {
        return $this->userDto;
    }

    /**
     * @param UserRequestModel $requestModel
     * @throws Error
     * @throws Exception
     */
    public function createUserDto(UserRequestModel $requestModel)
    {
        $dataUtils = DataUtilsFactory::create();
        $dataUtils->copyProperties($requestModel, $this->userDto);
    }

}
