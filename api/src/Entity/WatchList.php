<?php

namespace App\Entity;

use App\Repository\WatchListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WatchListRepository::class)
 */
class WatchList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_movie;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $watched;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMovie(): ?int
    {
        return $this->id_movie;
    }

    public function setIdMovie(int $id_movie): self
    {
        $this->id_movie = $id_movie;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getWatched(): ?string
    {
        return $this->watched;
    }

    public function setWatched(string $watched): self
    {
        $this->watched = $watched;

        return $this;
    }
}
