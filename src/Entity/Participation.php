<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity=Joueurs::class)
     */
    private $joueur;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutesJeu;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMinutesJeu(): ?int
    {
        return $this->minutesJeu;
    }

    public function setMinutesJeu(?int $minutesJeu): self
    {
        $this->minutesJeu = $minutesJeu;

        return $this;
    }
}
