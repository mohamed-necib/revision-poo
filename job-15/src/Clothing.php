<?php
namespace App;
use App\Abstract\Product;
use App\Interface\SockableInterface;
use DateTime;
use PDO;


// class Clothing extending from Product

class Clothing extends Product implements SockableInterface
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

  /**
   * Get the value of size
   */
  public function getSize()
  {
    return $this->size;
  }

  /**
   * Set the value of size
   *
   * @return  self
   */
  public function setSize($size)
  {
    $this->size = $size;

    return $this;
  }

  /**
   * Get the value of color
   */
  public function getColor()
  {
    return $this->color;
  }

  /**
   * Set the value of color
   *
   * @return  self
   */
  public function setColor($color)
  {
    $this->color = $color;

    return $this;
  }

  /**
   * Get the value of type
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Set the value of type
   *
   * @return  self
   */
  public function setType($type)
  {
    $this->type = $type;

    return $this;
  }

  /**
   * Get the value of material_fee
   */
  public function getMaterial_fee()
  {
    return $this->material_fee;
  }

  /**
   * Set the value of material_fee
   *
   * @return  self
   */
  public function setMaterial_fee($material_fee)
  {
    $this->material_fee = $material_fee;

    return $this;
  }

  /** CREATE */
  public function create(): Clothing|bool
  {
    $result = parent::create();
    if (!$result) {
      return $result;
    }

    $request = $this->db->prepare(
      "INSERT INTO clothing (size, color, type, material_fee, id_product) VALUES (:size, :color, :type, :material_fee, :id_product)"
    );
    $result = $request->execute([
      'size' => $this->size,
      'color' => $this->color,
      'type' => $this->type,
      'material_fee' => $this->material_fee,
      'id_product' => $this->id
    ]);
    if ($result) {
      return $this;
    } else {
      return $result;
    }
  }

  /** UPDATE */

  public function update(): Clothing|bool
  {
    $result = parent::update();

    if (!$result) {
      return $result;
    }
    $request = $this->db->prepare(
      "UPDATE clothing SET size = :size, color = :color, type = :type, material_fee = :material_fee WHERE id_product = :id_product"
    );
    $result = $request->execute([
      'size' => $this->size,
      'color' => $this->color,
      'type' => $this->type,
      'material_fee' => $this->material_fee,
      'id_product' => $this->id
    ]);
    if ($result) {
      return $this;
    } else {
      return $result;
    }
    return $result;
  }

  /** FIND ONE BY ID */
  public function findOneById(int $id): Clothing|bool
  {

    $request = $this->db->prepare(
      "SELECT * FROM clothing INNER JOIN product ON clothing.id_product = product.id WHERE id_product = :id"
    );
    $request->execute(['id' => $id]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $clothing = new Clothing(
        $result['id'],
        $result['name'],
        json_decode($result['photos']),
        $result['price'],
        $result['description'],
        $result['quantity'],
        new DateTime($result['createdAt']),
        new DateTime($result['updatedAt']),
        $result['category_id'],
        $result['size'],
        $result['color'],
        $result['type'],
        $result['material_fee']
      );
      return $clothing;
    } else {
      return false;
    }
  }

  /** FINDALL */
  public function findAll(): array
  {
    $request = $this->db->prepare("SELECT * FROM clothing INNER JOIN product ON clothing.id_product = product.id");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $clothings = [];
    foreach ($result as $clothing) {
      $clothings[] = new Clothing(
        $clothing['id'],
        $clothing['name'],
        json_decode($clothing['photos']),
        $clothing['price'],
        $clothing['description'],
        $clothing['quantity'],
        new DateTime($clothing['createdAt']),
        new DateTime($clothing['updatedAt']),
        $clothing['category_id'],
        $clothing['size'],
        $clothing['color'],
        $clothing['type'],
        $clothing['material_fee']
      );
    }
    return $clothings;
  }

  //AddStocks
  public function addStocks(int $stock): self
  {
    $result = $this->quantity += $stock;
    $this->update();
    return $this;
  }

  //RemoveStocks
  public function removeStocks(int $stock): self
  {
    $this->quantity -= $stock;
    $this->update();
    return $this;
  }
}
