<?php declare(strict_types=1);

namespace App\Message;

use App\Controller\Api\Models\Response\UserResponseModel;

class GetUser
{
    private $id;
    private $response;


    public function __construct(UserResponseModel $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse(UserResponseModel $response)
    {
        $this->response = $response;
    }

}
