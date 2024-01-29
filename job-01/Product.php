<?php

class Product
{
    public function __construct(
      private ?int $id = null,
      private ?string $name = null,
      private ?array $photos = null,
      private ?int $price = null,
      private ?string $description = null,
      private ?int $quantity = null,
      private ?DateTime $createdAt = null,
      private ?DateTime $updatedAt = null,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): Product
    {
        $this->photos = $photos;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }


    public function setPrice(?int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    
    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }


    public function getQuantity(): ?int
    {
        return $this->quantity;
    }


    public function setQuantity(?int $quantity): Product
    {
        $this->quantity = $quantity;
        return $this;
    }


    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }


    public function setCreatedAt(?DateTime $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt(?DateTime $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}

?>