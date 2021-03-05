<?php

namespace App\Controller;

use App\Form\CalculatorType;
use App\Service\SyntaxParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function calculate(Request $request, SyntaxParser $syntaxParser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $resultat = $syntaxParser->parse($data['operation']);
        } catch (\Throwable $th) {
            //throw $th;
            // TODO
        }

        return new JsonResponse($resultat);
    }
}
