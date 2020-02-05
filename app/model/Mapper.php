<?php
/*
 * Mapper
 * construct the database
 */
abstract class Mapper {
  protected $db;
  
  public function __construct($db) {
    $this->db = $db;
  }
}
