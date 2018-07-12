<?php

namespace App\Controller;

use App\Utils\HTTP;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
	 /**
	  * @Route("/", name="category_index", methods="GET")
	  */
	 public function index(CategoryRepository $categoryRepository): Response
	 {
		  return $this->render('category/index.html.twig', ['categories' => $categoryRepository->findAll()]);
	 }

	 /**
	  * @Route("/new", name="category_new", methods="POST")
	  */
	 public function new(Request $request): JsonResponse
	 {
			$code = HTTP::NO_RESPONSE; // default code
			$msg = '';

			$category;
			try {
				$category = new Category();
				$form = $this->createForm(CategoryType::class, $category);
				$form->handleRequest($request);
	 
				if ($form->isSubmitted() && $form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($category);
					$em->flush();
				}
				$code = HTTP::CREATED;
		  } catch (Exception $ex) {
				$code = HTTP::INTERNAL_ERROR;
				$msg = $ex->getMessage();
		  }

		  return new JsonResponse([
				'code'		=> $code,
				'message'	=> $msg,
				'data'		=> ['category' => $category],
		  ]);
	 }

	 /**
	  * @Route("/{id}", name="category_show", methods="GET")
	  */
	 public function show(Category $category): Response
	 {
		  return $this->render('category/show.html.twig', ['category' => $category]);
	 }

	 /**
	  * @Route("/{id}/edit", name="category_edit", methods="POST")
	  */
	 public function edit(Request $request, Category $category): Response
	 {
		  $form = $this->createForm(CategoryType::class, $category);
		  $form->handleRequest($request);

		  if ($form->isSubmitted() && $form->isValid()) {
				$this->getDoctrine()->getManager()->flush();

				return $this->redirectToRoute('category_edit', ['id' => $category->getId()]);
		  }

		  return $this->render('category/edit.html.twig', [
				'category' => $category,
				'form' => $form->createView(),
		  ]);
	 }

	 /**
	  * @Route("/{id}", name="category_delete", methods="DELETE")
	  */
	 public function delete(Request $request, Category $category): Response
	 {
		  if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
				$em = $this->getDoctrine()->getManager();
				$em->remove($category);
				$em->flush();
		  }

		  return $this->redirectToRoute('category_index');
	 }
}
