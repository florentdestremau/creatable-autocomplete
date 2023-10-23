<?php

namespace App\Controller;

use App\Entity\Attribute;
use App\Form\AttributeType;
use App\Repository\AttributeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attribute')]
class AttributeController extends AbstractController
{
    #[Route('/', name: 'app_attribute_index', methods: ['GET'])]
    public function index(AttributeRepository $attributeRepository): Response
    {
        return $this->render('attribute/index.html.twig', [
            'attributes' => $attributeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_attribute_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $attribute = new Attribute();
        $form = $this->createForm(AttributeType::class, $attribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($attribute);
            $entityManager->flush();

            if ($request->query->get('ajax')) {
                return $this->json([
                    'id' => $attribute->getId(),
                    'name' => $attribute->getName(),
                ]);
            }

            return $this->redirectToRoute('app_attribute_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('attribute/new.html.twig', [
            'attribute' => $attribute,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attribute_show', methods: ['GET'])]
    public function show(Attribute $attribute): Response
    {
        return $this->render('attribute/show.html.twig', [
            'attribute' => $attribute,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_attribute_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Attribute $attribute, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AttributeType::class, $attribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_attribute_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('attribute/edit.html.twig', [
            'attribute' => $attribute,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attribute_delete', methods: ['POST'])]
    public function delete(Request $request, Attribute $attribute, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attribute->getId(), $request->request->get('_token'))) {
            $entityManager->remove($attribute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_attribute_index', [], Response::HTTP_SEE_OTHER);
    }
}
