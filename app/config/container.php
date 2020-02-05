<?php 
/* 
 * container.php
 * Setup the basic settings for: template(views) and MySQL PDO
 */
 
// this container is used by Slim Framework
$container = $app->getContainer();

// Mysql PDO
/* 
 * The same dada passed in database.php is used here to connect
 */
$container['db'] = function($conn) {
  $db = $conn['settings']['db'];
  $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbnm'], $db['user'], $db['pass']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};

// Views - PHP View
/* 
 * Setup the template engine url to render templates
 */
$container['view'] = new Slim\Views\PhpRenderer("../app/view/");
