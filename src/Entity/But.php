<?php

namespace App\Entity;

use App\Repository\ButRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ButRepository::class)
 */
class But
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minuteBut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeBut;

    /**
     * @ORM\ManyToOne(targetEntity=Joueurs::class)
     */
    private $joueur;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class)
     */
    private $matchs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinuteBut(): ?int
    {
        return $this->minuteBut;
    }

    public function setMinuteBut(?int $minuteBut): self
    {
        $this->minuteBut = $minuteBut;

        return $this;
    }

    public function getTypeBut(): ?string
    {
        return $this->typeBut;
    }

    public function setTypeBut(?string $typeBut): self
    {
        $this->typeBut = $typeBut;

        return $this;
    }

    public function getJoueur(): ?Joueurs
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueurs $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }

    public function getMatchs(): ?Matchs
    {
        return $this->matchs;
    }

    public function setMatchs(?Matchs $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }
}
