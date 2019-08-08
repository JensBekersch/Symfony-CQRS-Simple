<?php declare(strict_types=1);

namespace App\Controller\Api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ApiBaseController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serializer->serialize($data, 'json');

        return new JsonResponse($json, $statusCode, [], true);
    }

    protected function validateDataAndSubmitForm(Request $request, $userForm, $userRequest)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm($userForm, $userRequest);
        $form->submit($data);

        return $form;
    }

    protected function formIsNotValid($form)
    {
        /**@var FormInterface $form */
        return $form->isValid() === false ? true : false;
    }

    protected function getErrors($form)
    {
        $errors = array();

        /**@var FormInterface $form */
        foreach ($form->all() as $childForm) {
            $errors = $this->getErrorIfInstanceOfFormInterface($errors, $childForm);
        }

        return $errors;
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        foreach ($form->getErrors() as $error) {
            return $error->getMessage();
        }

        return null;
    }

    private function addChildFormErrors($errors, $childForm)
    {
        if ($childError = $this->getErrorsFromForm($childForm)) {
            /**@var FormInterface $childForm */
            $errors[$childForm->getName()] = $childError;
        }

        return $errors;
    }

    private function getErrorIfInstanceOfFormInterface($errors, $childForm)
    {
        if ($childForm instanceof FormInterface) {
            $errors = $this->addChildFormErrors($errors, $childForm);
        }

        return $errors;
    }

}
