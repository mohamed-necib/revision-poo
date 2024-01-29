<?php
require_once 'Product.php';
class Category
{

  private $db = null;
  public function __construct(
    private ?int $id = null,
    private ?string $name = null,
    private ?string $description = null,
    private ?DateTime $createdAt = null,
    private ?DateTime $updatedAt = null
  ) {
  }


  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of updatedAt
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * Set the value of updatedAt
   *
   * @return  self
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }


  /**
   * Set the value of db
   *
   * @return  self
   */
  public function setDb($db)
  {
    $this->db = $db;

    return $this;
  }

  /**
   * Get the products of the category
   */

  public function getProducts()
  {
    $request = $this->db->prepare('SELECT * FROM product WHERE category_id = :id');
    $request->execute(['id' => $this->id]);
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
    $productsList = [];
    if(!$results) return false;
    foreach ($results as $result) {
      $product = new Product(
        $result['id'],
        $result['name'],
        json_decode($result['photos']),
        $result['price'],
        $result['description'],
        $result['category_id'],
        new DateTime($result['createdAt']),
        new DateTime($result['updatedAt'])
      );
      array_push($productsList, $product);
    }
    return $productsList;
  }
}
