<?php
  class Entity {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEntities(){
      $this->db->query('SELECT *,
                        entity.id as entityId,
                        users.id as userId,
                        entity.created_at as entityCreated,
                        users.created_at as userCreated,
                        entity.category as category,
                        entity.price as price
                        FROM entity
                        INNER JOIN users
                        ON entity.user_id = users.id
                        ORDER BY entity.created_at DESC
                        ');
      $results = $this->db->resultSet();

      return $results;
    }

    public function getEntitiesByCat($category){
      $this->db->query("SELECT * from entity WHERE user_id = ". $_SESSION['user_id'] . " AND category = ". $category);
      // Execute
      $results = $this->db->resultSet();
      return $results;
    }

    public function addEntity($data){
      $this->db->query('INSERT INTO entity (name, user_id, price, category) VALUES(:name, :user_id, :price, :category)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':category', $data['category']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getEntityById($id){
      $this->db->query('SELECT * FROM entity WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();
      return $row;
      
    }

    public function updateEntitty($data){
      $this->db->query('UPDATE entity SET name = :name, price = :price, category = :category WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':category', $data['category']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteEntity($id){
      $this->db->query('DELETE FROM entity WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }//end of entity-class-tag