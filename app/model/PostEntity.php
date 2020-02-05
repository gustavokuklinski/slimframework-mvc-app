<?php
  /*
   * PostEntity
   * manipulate data to be inserted or retrivied from the database
   */

  class PostEntity {
    /*
     * paramerters
     * must be the data modeling set in protected or private
     */
    protected $id;
    protected $user_id;
    protected $title;
    protected $content;
    protected $updated_at;
    protected $created_at;
    
    public function __construct(array $data) {
      if(isset($data['id'])) {
        $this->id = $data['id'];
      }
      
      $this->user_id = $data['user_id'];
      $this->title = $data['title'];
      $this->content = $data['content'];
      $this->updated_at = $data['updated_at'];
      $this->created_at = $data['created_at'];
    }
    
    /*
     * Getters and Setters
     */
    public function getId() {
      return $this->id;
    }
    
    public function getUserId() {
      return $this->user_id;
    }
    
    public function getTitle() {
      return $this->title;
    }
    
    public function getContent() {
      return $this->content;
    }
    
    public function getUpdatedAt() {
      return $this->updated_at;
    }
    
    public function getCreatedAt() {
      return $this->created_at;
    }
    
    /*
     * This was created for a short description
     */
    public function getShortContent() {
      return substr($this->content, 0, 120);
    }
    
  }
