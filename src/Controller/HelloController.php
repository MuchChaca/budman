<?php

namespace App\Controller;


use App\Utils\HTTP;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HelloController extends FOSRestController
{
	/**
	 * @Route("/", name="hello")
     */
    public function indexAction(): Response
    {
        return new JsonResponse([
            'code'  => HTTP::OK,
            'hello' => 'This is a simple example of resource returned by your APIs',
        ]);
    }
}
