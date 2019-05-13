<?php

namespace App\Controller;

use App\Entity\Schema;
use App\Form\SchemaType;
use App\Repository\SchemaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/schema")
 */
class SchemaController extends AbstractController
{
    /**
     * @Route("/", name="schema_index", methods={"GET"})
     */
    public function index(SchemaRepository $schemaRepository): Response
    {
        return $this->render('schema/index.html.twig', ['schemas' => $schemaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="schema_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $schema = new Schema();
        $form = $this->createForm(SchemaType::class, $schema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($schema);
            $entityManager->flush();

            return $this->redirectToRoute('schema_index');
        }

        return $this->render('schema/new.html.twig', [
            'schema' => $schema,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="schema_show", methods={"GET"})
     */
    public function show(Schema $schema): Response
    {
        return $this->render('schema/show.html.twig', ['schema' => $schema]);
    }

    /**
     * @Route("/{id}/edit", name="schema_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Schema $schema): Response
    {
        $form = $this->createForm(SchemaType::class, $schema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('schema_index', ['id' => $schema->getId()]);
        }

        return $this->render('schema/edit.html.twig', [
            'schema' => $schema,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="schema_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Schema $schema): Response
    {
        if ($this->isCsrfTokenValid('delete'.$schema->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($schema);
            $entityManager->flush();
        }

        return $this->redirectToRoute('schema_index');
    }
}
