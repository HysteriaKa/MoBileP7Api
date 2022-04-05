<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhoneRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ApiResource(
    attributes:[
        'order' => ['price' => 'ASC']
    ],
    collectionOperations:[
        "GET"
    ],
    itemOperations:[
        "GET"
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties:['price']

)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:collection'])]
    private $id;

    #[ORM\Column(type: 'string', length: 32)]
    #[Groups(['read:collection'])]
    private $name;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['read:collection'])]
    private $createdAt;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:collection'])]
    private $description;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(['read:collection'])]
    private $color;

    #[ORM\Column(type: 'float')]
    #[Groups(['read:collection'])]
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
