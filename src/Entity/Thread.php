<?php

namespace App\Entity;

use App\Repository\ThreadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThreadRepository::class)]
class Thread
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $status = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $main = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $edited = null;

    #[ORM\ManyToOne(inversedBy: 'threads')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Response>
     */
    #[ORM\OneToMany(targetEntity: Response::class, mappedBy: 'thread', orphanRemoval: true)]
    private Collection $responses;

    /**
     * @var Collection<int, ThreadVote>
     */
    #[ORM\OneToMany(targetEntity: ThreadVote::class, mappedBy: 'thread', orphanRemoval: true)]
    private Collection $threadVotes;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'thread')]
    private Collection $categories;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
        $this->threadVotes = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMain(): ?string
    {
        return $this->main;
    }

    public function setMain(string $main): static
    {
        $this->main = $main;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getEdited(): ?\DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(\DateTimeInterface $edited): static
    {
        $this->edited = $edited;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->user;
    }

    public function setIdUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Response>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Response $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setThread($this);
        }

        return $this;
    }

    public function removeResponse(Response $response): static
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getThread() === $this) {
                $response->setThread(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ThreadVote>
     */
    public function getThreadVotes(): Collection
    {
        return $this->threadVotes;
    }

    public function addThreadVote(ThreadVote $threadVote): static
    {
        if (!$this->threadVotes->contains($threadVote)) {
            $this->threadVotes->add($threadVote);
            $threadVote->setThread($this);
        }

        return $this;
    }

    public function removeThreadVote(ThreadVote $threadVote): static
    {
        if ($this->threadVotes->removeElement($threadVote)) {
            // set the owning side to null (unless already changed)
            if ($threadVote->getThread() === $this) {
                $threadVote->setThread(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addThread($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeThread($this);
        }

        return $this;
    }
}
