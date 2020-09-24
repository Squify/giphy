<?php

/*
	App : espace de noms défini par défaut > composer.json
		App : dossier src
		Controller : dossier src/Controller
*/
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
	private RequestStack $requestStack;
	private Request $request;

	public function __construct(RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
		$this->request = $this->requestStack->getCurrentRequest();
	}

	/**
	 * @Route("/", name="homepage.index")
	*/
	public function index():Response
	{
		return $this->render('homepage/index.html.twig');
	}
}

