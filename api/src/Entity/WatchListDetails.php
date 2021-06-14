<?php

namespace App\Entity;

use App\Repository\WatchListDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WatchListDetailsRepository::class)
 */
class WatchListDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\OneToOne(targetEntity=WatchList::class, inversedBy="watchListDetails", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?WatchList $watchlist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWatchlist(): ?WatchList
    {
        return $this->watchlist;
    }

    public function setWatchlist(WatchList $watchlist): self
    {
        $this->watchlist = $watchlist;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
