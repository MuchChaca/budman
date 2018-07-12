<?php

namespace App\Controller;

use App\Entity\User;
use App\Utils\Roles;
use App\Form\UserType;
use App\Form\HTTP;
use App\Event\EmailRegistrationUserEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RegistrationController extends FOSRestController
{
    /**
     * @Route(path="/api/register", name="registration")
     * @Method("POST")
     */
    public function postRegisterAction(Request $request): JsonResponse
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles([Roles::BASIC]);
            $em = $this->getDoctrine()->getManager();

            $event = new EmailRegistrationUserEvent($user);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(EmailRegistrationUserEvent::NAME, $event);

            $em->persist($user);
            $em->flush();

            return new JsonResponse(['status' => 'ok', 'code' => HTTP::OK]);
        }

        throw new HttpException(HTTP::BAD_REQUEST, "Invalid data");
    }
}
