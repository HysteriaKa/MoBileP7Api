<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: CustomerRepository::class)]

#[ApiResource(collectionOperations: [
    "GET" => ["security_get_denormalize" => "object.getClient() == user"],
    "POST" => ["security_post_denormalize" => "object.getClient() == user"]

], itemOperations: [
    "GET" => ["security" => "object.getClient() == user"],
    "delete" => ["security" => "object.getClient() == user"],
    "patch" => ["security" => "object.getClient() == user"]
])]
#[ApiFilter(
    SearchFilter::class,
    properties:['lastname'=>'ipartial']

)]
#[ApiFilter(
    OrderFilter::class,
    properties:['lastname','firstname']

)]
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

    #[ORM\Column(type: 'datetime')]
    #[Groups(['read:collection'])]
    private $created_at;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Groups(['read:collection'])]
    private $email;

    public function __construct()
    {
        $this->created_at =new DateTime();
    }
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
