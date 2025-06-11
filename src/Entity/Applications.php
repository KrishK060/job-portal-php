<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationsRepository::class)
 */
class Applications
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=JobSeekerProfile::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobseeker;

    /**
     * @ORM\ManyToOne(targetEntity=JobPost::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $appliedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobseeker(): ?JobSeekerProfile
    {
        return $this->jobseeker;
    }

    public function setJobseeker(?JobSeekerProfile $jobseeker): self
    {
        $this->jobseeker = $jobseeker;

        return $this;
    }

    public function getJob(): ?JobPost
    {
        return $this->job;
    }

    public function setJob(?JobPost $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAppliedAt(): ?\DateTimeImmutable
    {
        return $this->appliedAt;
    }

    public function setAppliedAt(\DateTimeImmutable $appliedAt): self
    {
        $this->appliedAt = $appliedAt;

        return $this;
    }

}
