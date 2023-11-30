<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner ce champ")]
    #[Assert\Length(min:4,minMessage:"Veuillez avoir au moins 4 caracters" )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Veuillez renseigner ce champ")]
    #[Assert\Length(min:10,minMessage:"Veuillez avoir au moins 10 caracters" )]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner ce champ")]
    private ?string $nom_auteur = null;

    #[ORM\ManyToOne(inversedBy: 'yes')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Donation::class)]
    private Collection $article;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nom_auteur;
    }

    public function setNomAuteur(string $nom_auteur): static
    {
        $this->nom_auteur = $nom_auteur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Commentaire $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Commentaire $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->title;
    }

    /**
     * @return Collection<int, Donation>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Donation $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setArticle($this);
        }

        return $this;
    }

    public function removeArticle(Donation $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getArticle() === $this) {
                $article->setArticle(null);
            }
        }

        return $this;
    }
}
