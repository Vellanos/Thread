<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $edited = null;

    /**
     * @var Collection<int, Thread>
     */
    #[ORM\ManyToMany(targetEntity: Thread::class, mappedBy: 'categories')]
    private Collection $thread;

    public function __construct()
    {
        $this->thread = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Thread>
     */
    public function getThread(): Collection
    {
        return $this->thread;
    }

    public function addThread(Thread $thread): static
    {
        if (!$this->thread->contains($thread)) {
            $this->thread->add($thread);
        }

        return $this;
    }

    public function removeThread(Thread $thread): static
    {
        $this->thread->removeElement($thread);

        return $this;
    }
}
