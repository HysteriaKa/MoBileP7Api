<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource(collectionOperations: [
    "GET" => ["security_get_denormalize" => "object.getClient() == user"],
    "POST" => ["security_post_denormalize" => "object.getClient() == user"]

], itemOperations: [
    "GET" => ["security" => "object.getClient() == user"],
    "delete" => ["security" => "object.getClient() == user"]
])]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:collection'])]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['read:collection'])]
    #[Assert\NotBlank()]
    private $firstname;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['read:collection'])]
    #[Assert\NotBlank()]
    private $lastname;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'customers')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }
}
