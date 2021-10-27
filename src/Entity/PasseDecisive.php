<?php

namespace App\Entity;

use App\Repository\PasseDecisiveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PasseDecisiveRepository::class)
 */
class PasseDecisive
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
    private $minute_passe;

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

    public function getMinutePasse(): ?int
    {
        return $this->minute_passe;
    }

    public function setMinutePasse(int $minute_passe): self
    {
        $this->minute_passe = $minute_passe;

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
