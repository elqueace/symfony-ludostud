<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game_index", methods={"GET"})
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', ['games' => $gameRepository->findAll()]);
    }

    /**
     * @Route("/new", name="game_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('game_index');
        }

        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_show", methods={"GET"})
     */
    public function play(Game $game): Response
    {
        return $this->render('game/schemator.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/crop/{id}", name="crop", methods={"GET"})
     */
    public function crop(Game $game): Response
    {
        return $this->render('game/crop.html.twig', ['game' => $game,'controller_name' => 'GameController']);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Game $game): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index', ['id' => $game->getId()]);
        }

        return $this->render('game/edit.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    /**
     * @Route("/games/list", name="games", methods={"GET"})
     */
    public function games(): Response
    {
        $listDomains = $this->findDomainsByUser();
        //dd($listDomains[0]["domain"]);
        return $this->render('game/games.html.twig',[
          'listDomains' => $listDomains,
        ]);
    }

    public function findDomains(): array
    {
      $entityManager = $this->getDoctrine()->getManager();

      $conn = $entityManager->getConnection();

      $sql = "SELECT DISTINCT domain FROM question_answer";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      // returns an array of arrays (i.e. a raw data set)
      return $result;
    }

    public function findDomainsByUser(): array
    {
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $userId = $this->getUser()->getId();

      $entityManager = $this->getDoctrine()->getManager();
      $conn = $entityManager->getConnection();

      $sql = "SELECT DISTINCT domain FROM question_answer WHERE owner_id = $userId";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      // returns an array of arrays (i.e. a raw data set)
      return $result;
    }
}
