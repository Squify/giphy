<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use App\Repository\GifRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /*public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }*/

	private CategoryRepository $categoryRepository;
	private GifRepository $gifRepository;

	public function __construct(CategoryRepository $categoryRepository, GifRepository $gifRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->gifRepository = $gifRepository;
	}

	/*
		getFunctions : créer une fonction personalisée dans twig
	*/
    public function getFunctions(): array
    {
		/*
			paramètres:
				nom de la fonction dans twig
				nom de la méthode php reliée à la fonction
		*/
        return [
            new TwigFunction('get_categories', [$this, 'getCategories']),
            new TwigFunction('get_gif', [$this, 'getGif']),
        ];
    }

    public function getCategories():array
    {
		/*
			doctrine: 2 branches
				repository : essentiellement à faire des SELECT
				EntityManager : UPDATE, INSERT et DELETE
			
			méthodes de sélection des repository
				find: récupération d'une entité par son id
				findAll : array d'entités
				findBy : array d'entités avec conditions
				findOneBy : une entité avec conditions
		*/
		$results = $this->categoryRepository->findAll();
		return $results;

    }

    public function getGif():array
    {
		$results = $this->gifRepository->findAll();
		return $results;
    }
}
