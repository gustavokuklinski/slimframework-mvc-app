<?php
  /*
   * PostMapper
   * Map all SQL queries using PDO
   */
  class UserMapper extends Mapper {
  
    public function getAllUsers() {
      $sql = "SELECT id, name FROM users";
      $stmt = $this->db->query($sql);
      $result = [];
      while($row = $stmt->fetch()) {
        $results[] = new UserEntity($row);
      }
      return $results;
    }
    
    public function getUserById($user_id) {
      $sql = "SELECT id, name, email FROM users WHERE id = :user_id"; 
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["user_id" => $user_id]);
      if($result) {
        return new UserEntity($stmt->fetch());
      }
    }
    
    // This in special was created do manage Login and start the session
    public function logIn(UserEntity $user) {
      $id = $user->getId();
      $name = $user->getName();
      $email = $user->getEmail();
      $password = $user->getPassword();
      $sql = "SELECT id, name, email, password FROM users WHERE email = :email AND password = :password";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindParam('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        session_start();
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        return true;
      }
      return false;
    }
    
    
    public function save(UserEntity $user) {
      $sql = "INSERT INTO users(name, email, password) values(:name, :email, :password)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "password" => $user->getPassword(),
      ]);
      if(!$result) {
        return new Exception("Could't save this record");
      }
    }
    
    public function update(UserEntity $user) {
      $sql = "UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "password" => $user->getPassword(),
      ]);
      if(!$result) {
        return new Exception("Could't update this record");
      }
    }
    
    public function destroy() {
    
    }
    
    
    
  }
