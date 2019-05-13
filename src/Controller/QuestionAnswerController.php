<?php

namespace App\Controller;

use App\Entity\QuestionAnswer;
use App\Form\QuestionAnswerType;
use App\Repository\QuestionAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/question_answer")
 */
class QuestionAnswerController extends AbstractController
{

    /**
     * @Route("/new/qr", name="question_answer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $userId = $this->getUser()->getId();

        $questionAnswer = new QuestionAnswer();
        $form = $this->createForm(QuestionAnswerType::class, $questionAnswer);
        $form->handleRequest($request);
        //$domain = $form->get('domain')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // $file stores the uploaded PDF file
           /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file*/
           /*
           if($form->get('imgpath')->getData()){
             $file = $form->get('imgpath')->getData();



             $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

             // Move the file to the directory where brochures are stored
             try {
                 $file->move(
                     $this->getParameter('images_directory'),
                     $fileName
                 );
             } catch (FileException $e) {
                 // ... handle exception if something happens during file upload
             }

             // instead of its contents
             $questionAnswer->setImgpath("img/".$fileName);
           }
           */
           $date = new \DateTime();
           $questionAnswer->setdate_created($date->format('Y-m-d'));

           $domain = $request->query->get('domain');
           $questionAnswer->setDomain($domain);

           $questionAnswer->setOwnerId($userId);

           // ... persist the $$questionAnswer variable or any other work

            $entityManager->persist($questionAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('question_answer_index', ['domain'=> $domain]);
        }

        return $this->render('question_answer/new.html.twig', [
            'question_answer' => $questionAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{domain}", name="question_answer_index", methods={"GET"})
     */
    public function index(QuestionAnswerRepository $questionAnswerRepository, Request $request, $domain): Response
    {
      $listDomains = $this->findDomainsByUser();

      if($domain == "all")
      {
        return $this->render('question_answer/index.html.twig', [
            'question_answers' => $this->findQuestionAnswersByUser(),
            'listDomains' => $listDomains,
            'domain' => $domain,
        ]);
      }
      else
      {
      //  $time = '2013-11-26 01:24:34'; //Assign your variable of datetime.
  // may be it is like : $time = $staffResults['staff_registered'];
  //echo  date("Y-m-d", strtotime($time));

        $question_answers = $this->findQuestionAnswersByDomainByUser($domain);
      //  print("<pre>".print_r($question_answers[0].,true)."</pre>");die;
        return $this->render('question_answer/index.html.twig', [
            'question_answers' => $question_answers,
            'listDomains' => $listDomains,
            'domain' => $domain,
        ]);
      }

    }

    /**
     * @Route("/{id}", name="question_answer_show", methods={"GET"})
     */
    public function show(QuestionAnswer $questionAnswer): Response
    {
        return $this->render('question_answer/show.html.twig', [
            'question_answer' => $questionAnswer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="question_answer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuestionAnswer $questionAnswer): Response
    {
        $form = $this->createForm(QuestionAnswerType::class, $questionAnswer);
        $form->handleRequest($request);
        $domain = $form->get('domain')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $referer = $request->headers->get('referer');

            return $this->redirectToRoute('question_answer_index', ['domain'=> $domain]);
        }

        return $this->render('question_answer/edit.html.twig', [
            'question_answer' => $questionAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="question_answer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, QuestionAnswer $questionAnswer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionAnswer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questionAnswer);
            $entityManager->flush();
        }
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
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

    public function findQuestionAnswersByUser(): array
    {
      //to display all
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $userId = $this->getUser()->getId();

      $entityManager = $this->getDoctrine()->getManager();
      $conn = $entityManager->getConnection();

      $sql = "SELECT * FROM question_answer WHERE owner_id = $userId";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      shuffle($result);

      return $result;
    }

    public function findQuestionAnswersByDomainByUser($domain): array
    {
      //to display user's QR by domain
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $userId = $this->getUser()->getId();

      $entityManager = $this->getDoctrine()->getManager();
      $conn = $entityManager->getConnection();

      $sql = "SELECT * FROM question_answer WHERE domain = '$domain' and owner_id = $userId";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      shuffle($result);

      return $result;
    }

    /**
     * @Route("/try", name="question_answer_try", methods={"GET","POST"})
     */
    public function ajaxTries(Request $request)
    {

      $id_row = $request->get('id_row');
      $id_tag = $request->get('id_tag');

      //var_dump($id_row);die;
      $entityManager = $this->getDoctrine()->getManager();
      $conn = $entityManager->getConnection();

      $sql = "SELECT * FROM question_answer where id = :id_row";
      $stmt = $conn->prepare($sql);
      $stmt->execute(['id_row' => $id_row]);
      $result = $stmt->fetchAll();

      if($id_tag == "try-fail")
      {
        $newFail = $result[0]['fail'] + 1;
        $sql = "UPDATE question_answer SET fail = :newFail WHERE id = :id_row";
        $stmt =  $conn->prepare($sql);
        $stmt->execute(['newFail' => $newFail, 'id_row' => $id_row]);

        return new JsonResponse($newFail);
      }
      else
      {
        $newSuccess = $result[0]['success'] + 1;
        $sql = "UPDATE question_answer SET success = :newSuccess WHERE id = :id_row";
        $stmt =  $conn->prepare($sql);
        $stmt->execute(['newSuccess' => $newSuccess, 'id_row' => $id_row]);

        return new JsonResponse($newSuccess);      }
      // returns an array of arrays (i.e. a raw data set)
    //var_dump($result[0]['success']);die;

    }
}
