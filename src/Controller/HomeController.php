<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/home', name: 'app_home')]
    public function index(CallApiService $CallApiService): Response
    {
        $getData = $CallApiService->getAllData();
        $datas = $getData["data"];
        return $this->render('home/index.html.twig', compact('datas'));
    }
}
