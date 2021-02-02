<?php

namespace App\Controller;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

  /**
   * @Route("/test.{_format}", name="api_test", format="json", options={"expose"=true})
   * @param Request $request
   * @return Response
   */
  public function index(Request $request): Response
  {
      $total = 20;
      $shown = 10;
      $row = isset($_POST['start']) ? intval($_POST['start']) : 0;

      if (!$this->session->has('users')) {
          $users = [];
          for ($i = 0; $i < $total; $i++) {
              $faker = Factory::create('fr_FR');
              $users[] = ['first_name' => $faker->firstName, 'last_name' => $faker->lastName];
          }
          $this->session->set('users', $users);
      }

      $users = array_slice(
          $this->session->get('users'),
          $row,
          $row + $shown
      );

      return JsonResponse::fromJsonString(json_encode([
          "draw" => $shown,
          "iTotalRecords" => $total,
          "iTotalDisplayRecords" => $total,
          "aaData" => $users
      ]));
  }

}
