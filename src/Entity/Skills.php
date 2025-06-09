<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=JobSeekerProfile::class, inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profileId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skillName;

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

    public function getSkillName(): ?string
    {
        return $this->skillName;
    }

    public function setSkillName(string $skillName): self
    {
        $this->skillName = $skillName;

        return $this;
    }
}
