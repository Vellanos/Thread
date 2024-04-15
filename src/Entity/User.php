<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', columns: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $pseudo = null;

    /**
     * @var array<string> The user roles
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string|null The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $edited;

    /**
     * @var Collection<int, Thread>
     */
    #[ORM\OneToMany(targetEntity: Thread::class, mappedBy: 'id_user', orphanRemoval: true)]
    private Collection $threads;

    /**
     * @var Collection<int, Response>
     */
    #[ORM\OneToMany(targetEntity: Response::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $responses;

    /**
     * @var Collection<int, ResponseVote>
     */
    #[ORM\OneToMany(targetEntity: ResponseVote::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $responseVotes;

    /**
     * @var Collection<int, ThreadVote>
     */
    #[ORM\OneToMany(targetEntity: ThreadVote::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $threadVotes;

    public function __construct()
    {
        $this->threads = new ArrayCollection();
        $this->responses = new ArrayCollection();
        $this->responseVotes = new ArrayCollection();
        $this->threadVotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password ?? '';
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getEdited(): ?DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(?DateTimeInterface $edited): self
    {
        $this->edited = $edited;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Thread>
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    public function addThread(Thread $thread): static
    {
        if (!$this->threads->contains($thread)) {
            $this->threads->add($thread);
            $thread->setIdUser($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): static
    {
        if ($this->threads->removeElement($thread)) {
            // set the owning side to null (unless already changed)
            if ($thread->getIdUser() === $this) {
                $thread->setIdUser(null);
            }
        }

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
            $response->setUser($this);
        }

        return $this;
    }

    public function removeResponse(Response $response): static
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getUser() === $this) {
                $response->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResponseVote>
     */
    public function getResponseVotes(): Collection
    {
        return $this->responseVotes;
    }

    public function addResponseVote(ResponseVote $responseVote): static
    {
        if (!$this->responseVotes->contains($responseVote)) {
            $this->responseVotes->add($responseVote);
            $responseVote->setUser($this);
        }

        return $this;
    }

    public function removeResponseVote(ResponseVote $responseVote): static
    {
        if ($this->responseVotes->removeElement($responseVote)) {
            // set the owning side to null (unless already changed)
            if ($responseVote->getUser() === $this) {
                $responseVote->setUser(null);
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
            $threadVote->setUser($this);
        }

        return $this;
    }

    public function removeThreadVote(ThreadVote $threadVote): static
    {
        if ($this->threadVotes->removeElement($threadVote)) {
            // set the owning side to null (unless already changed)
            if ($threadVote->getUser() === $this) {
                $threadVote->setUser(null);
            }
        }

        return $this;
    }
}
