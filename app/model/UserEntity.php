<?php
  /*
   * UserEntity
   * manipulate data to be inserted or retrivied from the database
   */
  class UserEntity {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    
    public function __construct(array $data) {
      if(isset($data['id'])) {
        $this->id = $data['id'];
      }
      $this->name = $data['name'];
      $this->email = $data['email'];
      $this->password = $data['password'];
    }
    
    public function getId() {
      return $this->id;
    }
    
    public function getName() {
      return $this->name;
    }
    
    public function getEmail() {
      return $this->email;
    }
    
    public function getPassword() {
      return $this->password;
    }
    
  }
