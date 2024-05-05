<?php

namespace App\Entity;

use App\Repository\ReactionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionsRepository::class)]
class Reactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $article = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentsID = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentslikes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentsdislikes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCommentsID(): ?string
    {
        return $this->commentsID;
    }

    public function setCommentsID(string $commentsID): static
    {
        $this->commentsID = $commentsID;

        return $this;
    }

    public function getCommentslikes(): ?string
    {
        return $this->commentslikes;
    }

    public function setCommentslikes(?string $commentslikes): static
    {
        $this->commentslikes = $commentslikes;

        return $this;
    }

    public function getCommentsdislikes(): ?string
    {
        return $this->commentsdislikes;
    }

    public function setCommentsdislikes(?string $commentsdislikes): static
    {
        $this->commentsdislikes = $commentsdislikes;

        return $this;
    }
}
