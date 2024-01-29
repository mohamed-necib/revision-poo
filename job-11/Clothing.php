
<?php

require_once 'Product.php';

// class Clothing extending from Product

class Clothing extends Product
{
  protected $db = null;
  public function __construct(
    protected ?int $id = null,
    protected ?string $name = null,
    protected ?array $photos = null,
    protected ?int $price = null,
    protected ?string $description = null,
    protected ?int $quantity = null,
    protected ?DateTime $createdAt = null,
    protected ?DateTime $updatedAt = null,
    protected ?int $category_id = null,
    protected ?string $size = null,
    protected ?string $color = null,
    protected ?string $type = null,
    protected ?int $material_fee = null
  ) {
    parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);
  }
}
