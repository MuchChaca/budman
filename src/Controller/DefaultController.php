<?php

namespace App\Controller;

use App\Entity\User;
use App\Utils\JsonResp;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
	public function register(Request $request, UserPasswordEncoderInterface $encoder) : JsonResp
	{
		// Response
		$resp = new JsonResp();

		$u = new User();

		try {
			$data = json_decode(
				$request->getContent(),
				true
			);
	
			$em = $this->getDoctrine()->getManager();
			$username = $data['_username'];
			$password = $data['_password'];
	
			$user = new User($username);
			$user->setPassword($encoder->encodePassword($user, $password));
	
			$em->persist($user);
			$em->flush();

			// response success
			return $resp->created(['data' => $user]);

		} catch (UniqueConstraintViolationException $duplicate) {
			// response if duplicate login
			return $resp->conflict(["message" => "Duplicate login"]);

		} catch (Exception $ex) {
			// reponse any unexpected error
			$msg = ($this->get('kernel')->isDebug() ? $ex->getMessage : 'Try again later');
			return $resp->internal($msg);

		}
		// response default
		return $resp->badRequest();
	}

	public function api()
	{
		// return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
		$resp = new JsonResp();
		return $resp->ok();
	}
}
