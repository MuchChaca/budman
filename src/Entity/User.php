<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="author")
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

	public function getId(): int
	{
		return $this->id;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setSurname(string $surname): void
	{
		$this->surname = $surname;
	}

	public function getSurname(): ?string
	{
		return $this->surname;
	}

	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	public function getUsername(): ?string
	{
		return $this->username;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	public function getPassword(): ?string
	{
		return $this->password;
	}

	public function getRoles(): array
	{
		$roles = $this->roles;

		if (empty($roles)) {
			$roles[] = 'ROLE_USER';
		}

		return array_unique($roles);
	}

	public function setRoles(array $roles): void
	{
		$this->roles = $roles;
	}

	public function getSalt(): ?string
	{
		return null;
	}

	public function eraseCredentials(): void
	{

	}
 private $__EXTRA__LINE;
 /**
  * @ORM\Column(type="datetime", nullable=true)
  */
 private $date_creation;
 /**
  * @return Collection|Project[]
  */
 public function getProjects(): Collection
 {
     return $this->projects;
 }
//  private $__EXTRA__LINE;
 public function addProject(Project $project): self
 {
     if (!$this->projects->contains($project)) {
         $this->projects[] = $project;
         $project->setAuthor($this);
     }
     $__EXTRA__LINE;
     return $this;
 }
//  private $__EXTRA__LINE;
 public function removeProject(Project $project): self
 {
     if ($this->projects->contains($project)) {
         $this->projects->removeElement($project);
         // set the owning side to null (unless already changed)
         if ($project->getAuthor() === $this) {
             $project->setAuthor(null);
         }
     }
     $__EXTRA__LINE;
     return $this;
 }
// private $__EXTRA__LINE;
public function getDateCreation(): ?\DateTimeInterface
{
    return $this->date_creation;
}
// private $__EXTRA__LINE;
// private $__EXTRA__LINE;
/**
 * @ORM\Column(type="datetime", nullable=true)
 */
private $last_updated;
public function setDateCreation(?\DateTimeInterface $date_creation): self
{
    $this->date_creation = $date_creation;
    $__EXTRA__LINE;
    return $this;
}
// private $__EXTRA__LINE;
public function getLastUpdated(): ?\DateTimeInterface
{
    return $this->last_updated;
}
// private $__EXTRA__LINE;
public function setLastUpdated(?\DateTimeInterface $last_updated): self
{
    $this->last_updated = $last_updated;
    $__EXTRA__LINE;
    return $this;
}
}
