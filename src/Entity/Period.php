<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeriodRepository")
 */
class Period
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_begin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $last_value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_unit;

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Prevision", mappedBy="period")
    //  */
    // private $previsions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="period")
     */
    private $projects;

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
        // $this->previsions = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->date_begin;
    }

    public function setDateBegin(?\DateTimeInterface $date_begin): self
    {
        $this->date_begin = $date_begin;

        return $this;
    }

    public function getLastValue(): ?int
    {
        return $this->last_value;
    }

    public function setLastValue(?int $last_value): self
    {
        $this->last_value = $last_value;

        return $this;
    }

    public function getLastUnit(): ?string
    {
        return $this->last_unit;
    }

    public function setLastUnit(?string $last_unit): self
    {
        $this->last_unit = $last_unit;

        return $this;
    }

    // /**
    //  * @return Collection|Prevision[]
    //  */
    // public function getPrevisions(): Collection
    // {
    //     return $this->previsions;
    // }

    // public function addPrevision(Prevision $prevision): self
    // {
    //     if (!$this->previsions->contains($prevision)) {
    //         $this->previsions[] = $prevision;
    //         $prevision->setPeriod($this);
    //     }

    //     return $this;
    // }

    // public function removePrevision(Prevision $prevision): self
    // {
    //     if ($this->previsions->contains($prevision)) {
    //         $this->previsions->removeElement($prevision);
    //         // set the owning side to null (unless already changed)
    //         if ($prevision->getPeriod() === $this) {
    //             $prevision->setPeriod(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setPeriod($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getPeriod() === $this) {
                $project->setPeriod(null);
            }
        }

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
