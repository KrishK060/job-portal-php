<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EducationRepository::class)
 */
class Education
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=JobSeekerProfile::class, inversedBy="education")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profileId;

    /**
     * @ORM\Column(type="date")
     */
    private $startdate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $enddate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfileId(): ?JobSeekerProfile
    {
        return $this->profileId;
    }

    public function setProfileId(?JobSeekerProfile $profileId): self
    {
        $this->profileId = $profileId;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(?\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }
}
