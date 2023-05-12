<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
      // Bind values
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
          return true;
      } else {
          return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Update profile
    public function update($data) {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      $this->db->query("UPDATE users SET username = '". $data['name'] ."', email = '" . $data['email'] . "', password = '" . $data["password"] . "' WHERE id=".$_SESSION["user_id"]);
      
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    } 

    public function insertAvatar($fileName){
      print_r($fileName);
      $this->db->query("UPDATE users SET avatar = '" . $fileName . "' WHERE id = ".$_SESSION["user_id"]);
       // Execute
       if($this->db->execute()){
        $_SESSION['user_avatar'] = $fileName;
        return true;
       } else {
        return false;
       }
    }

    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

     // Get User by ID
     public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }




  }//end-of-User-class


?>