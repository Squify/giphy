<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private RequestStack $requestStack;
    private Request $request;
    private CategoryRepository $categoryRepository;
    private GifRepository $gifRepository;

    public function __construct(RequestStack $requestStack, CategoryRepository $categoryRepository, GifRepository $gifRepository)
    {
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();
        $this->categoryRepository = $categoryRepository;
        $this->gifRepository = $gifRepository;
    }

    /**
     * @Route("/search", name="search.index")
     */
    public function index(): Response
    {
        $search = $this->request->query->get('search');
        $result = $this->gifRepository->getBySearch($search)->getResult();

        return $this->render('search/index.html.twig', [
            'search' => $search,
            'result' => $result
        ]);
    }
}