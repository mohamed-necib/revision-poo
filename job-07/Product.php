<?php
require_once 'Category.php';
class Product
{
    private $db = null;
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?array $photos = null,
        private ?int $price = null,
        private ?string $description = null,
        private ?int $quantity = null,
        private ?DateTime $createdAt = null,
        private ?DateTime $updatedAt = null,
        private ?int $category_id = null
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
     * Get the value of photos
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set the value of photos
     *
     * @return  self
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

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
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

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
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

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

    public function getCategory()
    {
        $request = $this->db->prepare("SELECT * FROM category WHERE id = :id");
        $request->execute([
            "id" => $this->category_id
        ]);
        $cresult = $request->fetch(PDO::FETCH_ASSOC);
        $category = new Category(
            $cresult["id"],
            $cresult["name"],
            $cresult["description"],
            new DateTime($cresult["createdAt"]),
            new DateTime($cresult["updatedAt"])
        );
        return $category;
    }

    public function findOneById(int $id)
    {
        $request = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $request->execute([
            "id" => $id
        ]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $this->id = $result["id"];
        $this->name = $result["name"];
        $this->photos = json_decode($result['photos']);
        $this->price = $result["price"];
        $this->description = $result["description"];
        $this->quantity = $result["quantity"];
        $this->createdAt = new DateTime($result["createdAt"]);
        $this->updatedAt = new DateTime($result["updatedAt"]);
        $this->category_id = $result["category_id"];
        return $this;
    }
}
