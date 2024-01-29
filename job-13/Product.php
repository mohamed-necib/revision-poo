<?php
require_once 'Category.php';
abstract class Product
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
        protected ?int $category_id = null
    ) {
        $dbname = 'draft-shop';
        $host = 'localhost';
        $dbuser = 'root';
        $dbpass = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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

    abstract public function findOneById(int $id);
   

    abstract public function findAll();
    

    /**
     * Create a new product in database
     */
    public function create()
    {
        // Vérification tous les attributs
        if (
            (!$this->name) ||
            (!$this->photos) ||
            (!$this->price) ||
            (!$this->description) ||
            (!$this->quantity) ||
            (!$this->createdAt) ||
            (!$this->updatedAt) ||
            (!$this->category_id)
        ) {
            return false;
        }
        $request = $this->db->prepare("INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)");
        $request->execute([
            "name" => $this->name,
            "photos" => json_encode($this->photos),
            "price" => $this->price,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "createdAt" =>
            $this->createdAt->format('Y-m-d H:i:s'),
            "updatedAt" =>
            $this->updatedAt->format('Y-m-d H:i:s'),
            "category_id" => $this->category_id
        ]);
        // Vérification du bon fonctionnement de la requete
        if ($request->rowCount() > 0) {
            $this->id = $this->db->lastInsertId();
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Update a product in database
     */
    public function update()
    {
        // Vérification tous les attributs
        if (
            (!$this->id) ||
            (!$this->name) ||
            (!$this->photos) ||
            (!$this->price) ||
            (!$this->description) ||
            (!$this->quantity) ||
            (!$this->createdAt) ||
            (!$this->updatedAt) ||
            (!$this->category_id)
        ) {
            return false;
        }
        $request = $this->db->prepare("UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, createdAt = :createdAt, updatedAt = :updatedAt, category_id = :category_id WHERE id = :id");
        $request->execute([
            "id" => $this->id,
            "name" => $this->name,
            "photos" => json_encode($this->photos),
            "price" => $this->price,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "createdAt" =>
            $this->createdAt->format('Y-m-d H:i:s'),
            "updatedAt" =>
            $this->updatedAt->format('Y-m-d H:i:s'),
            "category_id" => $this->category_id
        ]);

        // Vérification du bon fonctionnement de la requete
       
        if ($request) {
            return $this;
        } else {
            return false;
        }
    }
}
