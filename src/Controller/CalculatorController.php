<?php

namespace App\Controller;

use App\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    
    #[Route("/", name: "homepage")]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CalculatorType::class);

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/calculate", name: "calculator")]
    public function calculate(): JsonResponse
    {
        return new JsonResponse("mande");
    }
}
