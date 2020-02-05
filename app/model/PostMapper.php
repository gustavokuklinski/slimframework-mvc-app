<?php
  /*
   * PostMapper
   * Map all SQL queries using PDO
   */
  class PostMapper extends Mapper {
  
    public function getAllPosts() {
      $sql = "SELECT id, user_id, title, content, created_at, updated_at FROM posts";
      $stmt = $this->db->query($sql);
      $result = [];
      while($row = $stmt->fetch()) {
        $results[] = new PostEntity($row);
      }
      return $results;
    }
    
    public function getPostById($post_id) {
      $sql = "SELECT id, user_id, title, content, created_at, updated_at FROM posts WHERE id = :post_id"; 
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["post_id" => $post_id]);
      if($result) {
        return new PostEntity($stmt->fetch());
      }
    }
    
    public function getPostsByUserId($user_id) {
      $sql = "SELECT id, user_id, title, content, created_at, updated_at FROM posts WHERE user_id = :user_id"; 
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["user_id" => $user_id]);
      $result = [];
      while($row = $stmt->fetch()) {
        $results[] = new PostEntity($row);
      }
      return $results;
    }
    
    public function save(PostEntity $post) {
      $sql = "INSERT INTO posts(title, content, user_id) values(:title, :content, :user_id)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
        "title" => $post->getTitle(),
        "content" => $post->getContent(),
        "user_id" => $post->getUserId(),
      ]);
      if(!$result) {
        return new Exception("Could't save this record");
      }
    }
    
    public function update(PostEntity $post) {
      $sql = "UPDATE posts SET title=:title, content=:content WHERE id=:id";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
        "title" => $post->getTitle(),
        "content" => $post->getContent(),
        "id" => $post->getId(),
      ]);
      if(!$result) {
        return new Exception("Could't update this record");
      }
    }
    
    public function destroy($post_id) {
      $sql = "DELETE FROM posts WHERE id=:post_id";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["post_id" => $post_id]);
      if(!$result) {
        return new Exception("Could't delete this record");
      }
    }
    
    
    
  }
