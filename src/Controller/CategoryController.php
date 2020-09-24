<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
	private CategoryRepository $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}
	/**
	 * @Route("/category/{categorySlug}", name="category.index")
	*/
	public function index(string $categorySlug):Response
	{
		$category = $this->categoryRepository->findOneBy([
			'slug' => $categorySlug
		]);

		$subcategories = $this->categoryRepository
			->getSubCategoriesByMainCategorySlug($categorySlug)
			->getResult()
		;

		return $this->render('category/index.html.twig', [
			'category' => $category,
			'subcategories' => $subcategories,
		]);
	}

	/**
	 * @Route("/category/{categorySlug}/{subcategorySlug}", name="category.subcategory")
	*/
	public function subcategory(string $categorySlug, string $subcategorySlug):Response
	{
		$subcategory = $this->categoryRepository->findOneBy([
			'slug' =>$subcategorySlug
		]);

		return $this->render('category/subcategory.html.twig', [
			'subcategory' => $subcategory
		]);
	}
}

