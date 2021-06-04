<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *     formats={
 *          "json"
 *     },
 *     itemOperations={
 *     "get"={
 *           "normalization_context"={
 *               "groups"={"get"}
 *            }
 *     },
 *     "put"={
 *          "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user",
 *           "denormalization_context"={
 *               "groups"={"put"}
 *             },
 *           "normalization_context"={
 *               "groups"={"get"}
 *            }
 *         }
 *      },
 *     collectionOperations={
 *              "get"={
 *                  "normalization_context"={
 *                   "groups"={"get"},
 *                }
 *     },
 *              "post"={
 *                   "denormalization_context"={
 *                       "groups"={"post"}
 *                  },
 *              }
 *          },
 * )
 *
 *
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     *
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get"})
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get"})
     */
    private $model;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"get"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get"})
     */
    private $color;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"get"})
     */
    private $dicount;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"get"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"get"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get"})
     */
    private $fullName;

    /**
     * @ORM\Column(type="float")
     * @Groups({"get"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"get"})
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get"})
     */
    private $briefDescription;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get"})
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Seller::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private $rate;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDicount(): ?float
    {
        return $this->dicount;
    }

    public function setDicount(?float $dicount): self
    {
        $this->dicount = $dicount;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getBriefDescription(): ?string
    {
        return $this->briefDescription;
    }

    public function setBriefDescription(string $briefDescription): self
    {
        $this->briefDescription = $briefDescription;

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

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSeller(): ?Seller
    {
        return $this->seller;
    }

    public function setSeller(?Seller $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFullName();
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }


}
