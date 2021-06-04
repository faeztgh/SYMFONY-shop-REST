<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ApiResource(
 *      formats={
 *          "json"
 *     },
 *     itemOperations={
 *     "get"={
 *          "access_control"="is_granted('IS_AUTHENTICATED_FULLY')",
 *           "normalization_context"={
 *               "groups"={"get"}
 *            }
 *     },
 *   },
 *     collectionOperations={}
 *
 * )
 * @UniqueEntity("phoneNo")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"get", "put", "post"})
     */
    private $phoneNo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get", "put", "post"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get", "put", "post"})
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get"})
     */
    private $isVerified = false;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="customer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    public function getPhoneNo(): ?string
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(string $phoneNo): self
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString():string
    {
        return $this->getUser()->getUsername();
    }
}
