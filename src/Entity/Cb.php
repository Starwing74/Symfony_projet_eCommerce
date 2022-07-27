<?php

namespace App\Entity;

use App\Repository\CbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CbRepository::class)]
class Cb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
