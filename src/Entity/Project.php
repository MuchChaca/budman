<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $delta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prevision", mappedBy="project")
     */
    private $previsions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Period", inversedBy="projects")
     */
    private $period;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_updated;

    public function __construct()
    {
        $this->previsions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDelta()
    {
        return $this->delta;
    }

    public function setDelta($delta): self
    {
        $this->delta = $delta;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Prevision[]
     */
    public function getPrevisions(): Collection
    {
        return $this->previsions;
    }

    public function addPrevision(Prevision $prevision): self
    {
        if (!$this->previsions->contains($prevision)) {
            $this->previsions[] = $prevision;
            $prevision->setProject($this);
        }

        return $this;
    }

    public function removePrevision(Prevision $prevision): self
    {
        if ($this->previsions->contains($prevision)) {
            $this->previsions->removeElement($prevision);
            // set the owning side to null (unless already changed)
            if ($prevision->getProject() === $this) {
                $prevision->setProject(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->last_updated;
    }

    public function setLastUpdated(?\DateTimeInterface $last_updated): self
    {
        $this->last_updated = $last_updated;

        return $this;
    }
}
