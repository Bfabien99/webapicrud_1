<?php

namespace App\Controller;

use App\Form\ApiType;
use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    #[Route('/home', name: 'app_home')]
    public function index(CallApiService $CallApiService): Response
    {
        $getData = $CallApiService->getAllData();
        $datas = $getData["data"];
        return $this->render('home/index.html.twig', compact('datas'));
    }

    #[Route('/add', name: 'app_ajout')]
    public function add(CallApiService $CallApiService, Request $request): Response
    {
        $message = "";
        $form = $this->createForm(ApiType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dd($form->getData());
            $postData = $CallApiService->postData($form->getData());
            $datas = $postData;
            
            if($datas["status"]){
                $message =  $datas["message"];
            }
        }
        return $this->render('home/add.html.twig',[
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

    #[Route('/show/{id}', name: 'app_show')]
    public function show(CallApiService $CallApiService, $id) {
        $getData = $CallApiService->getData($id);
        $data = $getData["data"];
        return $this->render('home/show.html.twig', compact('data'));
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit(CallApiService $CallApiService, $id, Request $request) {
        $message = "";

        $getData = $CallApiService->getData($id);
        $data = $getData["data"];
        $data['image_url'] = $data['imageUrl'];
        $form = $this->createForm(ApiType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $formData = $form->getData();
            unset($formData['id']);
            unset($formData['imageUrl']);
            $formData;
            // $formData["image_url"] = $formData["imageUrl"];
            // unset($formData["imageUrl"]);

            $postData = $CallApiService->editData($formData,$id);
            $datas = $postData;
            if($datas){
                $message =  $datas["message"];
            }
        }


        return $this->render('home/edit.html.twig',[
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(CallApiService $CallApiService, $id) {
        $getData = $CallApiService->deleteData($id);
        $data = $getData["data"];
        return $this->redirectToRoute('app_home');
    }
}
