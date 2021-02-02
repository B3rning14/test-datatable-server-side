<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    public function __construct()
    {

    }

  /**
   * @Route("/", name="index_index")
   * @param Request $request
   * @return Response
   */
  public function index(Request $request)
  {
    return $this->render('pages/index.html.twig', []);
  }

}
