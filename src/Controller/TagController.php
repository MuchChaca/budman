<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Utils\HTTP;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TagController extends FOSRestController
{
	/**
	 * @Route("/api/tag/register", name="tag_index", methods="GET")
	 */
	public function index(TagRepository $tagRepository): Response
	{
		return $this->render('tag/index.html.twig', ['tags' => $tagRepository->findAll()]);
	}

	/**
	 * @Route(path="/api/tag/new", name="tag_new", methods={"POST"})
	 */
	public function new(Request $request): Response
	{
		// default 
		$code = HTTP::NOT_MODIFIED;
		$msg = '';
		$exception = '';

		$tag = null;

		try {
			$tag = new Tag();
			$form = $this->createForm(TagType::class, $tag);
			// echo $form->getData
			$form->handleRequest($request);

			// current datetime
			$curr = new \DateTime();
			$tag->setDateCreation($curr);
			$tag->setLastUpdated($curr);

			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($tag);
				$em->flush();
				
				// success
				$code = HTTP::CREATED;
				
			} else {
				// non valid form
				$code = HTTP::BAD_REQUEST;
			}
		} catch (Exception $ex) {
			// Unsuspected error
			$code = HTTP::INTERNAL_ERROR;
			$exception = $ex->getMessage();
		}
		
		// Response
		$ctnt = [
			'data'			=> ['tag' => $tag],
			'exceptions'	=> $exception
		];

		$response = new Response();
		$response->setContent(json_encode($ctnt));
		$response->headers->set('Content-Type', 'application/json');
		$response->setStatusCode($code, HTTP::MESSAGE($code));

		return $response;
	}

	/**
	 * @Route("/api/tag/{id}", name="tag_show", methods="GET")
	 */
	public function show(Tag $tag): Response
	{
		
		$exception = '';
		// Response
		$ctnt = [
			'data'			=> ['tag' => $tag],
			'exceptions'	=> $exception
		];
		if ($tag) {
			$code = HTTP::OK;
		} else {
			$code = HTTP::NOT_FOUND;
		}
		$response = new Response();
		$response->setContent(json_encode($ctnt));
		$response->headers->set('Content-Type', 'application/json');
		$response->setStatusCode($code, HTTP::MESSAGE($code));

		return $response;
	}

	/**
	 * @Route("/api/tag/edit/{id}", name="tag_edit", methods="POST")
	 */
	public function edit(Request $request, Tag $tag): Response
	{
		// default 
		$code = HTTP::NOT_MODIFIED;
		$msg = '';
		$exception = '';

		$tag->setLastUpdated(new \DateTime());

		try {
			$form = $this->createForm(TagType::class, $tag);
			$form->handleRequest($request);

			if ($form->isValid()) {
				$this->getDoctrine()->getManager()->flush();
				// success
				$code = HTTP::OK;
			} else {
				$code = HTTP::NOT_MODIFIED;
			}
		} catch (Exception $ex) {
			// Unsuspected error
			$code = HTTP::INTERNAL_ERROR;
			$exception = $ex->getMessage();
		}


		// Response
		$ctnt = [
			'data'			=> ['tag' => $tag],
			'exceptions'	=> $exception
		];

		$response = new Response();
		$response->setContent(json_encode($ctnt));
		$response->headers->set('Content-Type', 'application/json');
		$response->setStatusCode($code, HTTP::MESSAGE($code));

		return $response;
	}

	/**
	 * @Route("api/tag/{id}", name="tag_delete", methods="DELETE")
	 */
	public function delete(Request $request, Tag $tag): Response
	{
		// default 
		$code = HTTP::NOT_MODIFIED;
		$msg = '';
		$exception = '';

		// $tag->setLastUpdated(new \DateTime());

		try {
			// if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
				$em = $this->getDoctrine()->getManager();
				$em->remove($tag);
				$em->flush();

				$code = HTTP::OK;
			// }
		} catch (Exception $ex) {
			// Unsuspected error
			$code = HTTP::INTERNAL_ERROR;
			$exception = $ex->getMessage();
		}

		// Response
		$ctnt = [
			'exceptions'	=> $exception
		];

		$response = new Response();
		$response->setContent(json_encode($ctnt));
		$response->headers->set('Content-Type', 'application/json');
		$response->setStatusCode($code, HTTP::MESSAGE($code));

		return $response;
	}
}
