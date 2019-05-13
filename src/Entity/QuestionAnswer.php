<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionAnswerRepository")
 */
class QuestionAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * //@Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     */
    private $imgpath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $success;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date_created;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $owner_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getImgpath(): ?string
    {
        return $this->imgpath;
    }

    public function setImgpath(?string $imgpath): self
    {
        $this->imgpath = $imgpath;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getSuccess(): ?int
    {
        return $this->success;
    }

    public function setSuccess(?int $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getFail(): ?int
    {
        return $this->fail;
    }

    public function setFail(?int $fail): self
    {
        $this->fail = $fail;

        return $this;
    }

    public function getdate_created(): ?string
    {
        return $this->date_created;
    }

    public function setdate_created(?string $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    public function setOwnerId(?int $owner_id): self
    {
        $this->owner_id = $owner_id;

        return $this;
    }
}
