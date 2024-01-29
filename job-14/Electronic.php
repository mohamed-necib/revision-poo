<?php

require_once 'Product.php';
require_once 'SockableInterface.php';

// class Clothing extending from Product

class Electronic extends Product implements SockableInterface
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
    protected ?string $brand = null,
    protected ?int $waranty_fee = null,
  ) {
    parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);
  }

  /**
   * Get the value of brand
   */
  public function getBrand()
  {
    return $this->brand;
  }

  /**
   * Set the value of brand
   *
   * @return  self
   */
  public function setBrand($brand)
  {
    $this->brand = $brand;

    return $this;
  }

  /**
   * Get the value of waranty_fee
   */
  public function getWaranty_fee()
  {
    return $this->waranty_fee;
  }

  /**
   * Set the value of waranty_fee
   *
   * @return  self
   */
  public function setWaranty_fee($waranty_fee)
  {
    $this->waranty_fee = $waranty_fee;

    return $this;
  }

  /** 
   * CREATE
   */
  public function create(): Electronic|bool
  {
    $result = parent::create();
    if (!$result) {
      return $result;
    }

    $request = $this->db->prepare(
      "INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)"
    );
    $result = $request->execute([
      'name' => $this->name,
      'photos' => json_encode($this->photos),
      'price' => $this->price,
      'description' => $this->description,
      'quantity' => $this->quantity,
      'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
      'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
      'category_id' => $this->category_id,
    ]);

    $request = $this->db->prepare(
      "INSERT INTO electronic (id_product, brand, waranty_fee) VALUES (:id_product, :brand, :waranty_fee)"
    );
    $result = $request->execute([
      'id_product' => $this->id,
      'brand' => $this->brand,
      'waranty_fee' => $this->waranty_fee,
    ]);
    if ($result) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * UPDATE
   */
  public function update(): Electronic|bool
  {
    $result = parent::update();
    if (!$result) {
      return $result;
    }

    $request = $this->db->prepare(
      "UPDATE electronic SET brand = :brand, waranty_fee = :waranty_fee WHERE id_product = :id_product"
    );
    $result = $request->execute([
      'id_product' => $this->id,
      'brand' => $this->brand,
      'waranty_fee' => $this->waranty_fee,
    ]);
    if ($result) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * FIND ONE BY ID
   */

  public function findOneById(int $id): Electronic|bool
  {

    $request = $this->db->prepare(
      "SELECT * FROM electronic INNER JOIN product ON electronic.id_product = product.id WHERE id_product = :id"
    );
    $request->execute(['id' => $id]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $electronic = new Electronic(
        $result['id'],
        $result['name'],
        json_decode($result['photos']),
        $result['price'],
        $result['description'],
        $result['quantity'],
        new DateTime($result['createdAt']),
        new DateTime($result['updatedAt']),
        $result['category_id'],
        $result['brand'],
        $result['waranty_fee'],
      );
      return $electronic;
    } else {
      return false;
    }
  }

  /**
   * FIND ALL
   */
  public function findAll(): array
  {
    $request = $this->db->prepare("SELECT * FROM electronic INNER JOIN product ON electronic.id_product = product.id");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $electronic = [];
    foreach ($result as $data) {
      $electronic[] = new Electronic(
        $data['id'],
        $data['name'],
        json_decode($data['photos']),
        $data['price'],
        $data['description'],
        $data['quantity'],
        new DateTime($data['createdAt']),
        new DateTime($data['updatedAt']),
        $data['category_id'],
        $data['brand'],
        $data['waranty_fee'],
      );
    }
    return $electronic;
  }

  //Add stock
  public function addStocks(int $stock): self
  {
    $this->quantity += $stock;
    return $this;
  }

  //Remove stock
  public function removeStocks(int $stock): self
  {
    $this->quantity -= $stock;
    return $this;
  }
}
