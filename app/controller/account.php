<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/* 
 * Account Controller
 * Manage to the visitor sign in/up/out
 * Information about routes: config/routes.php
 */
 
/* 
 * Login form
 * user login form
 */
$app->get('/s/in', function (Request $request, Response $response) {
  return $this->view->render($response, 'account/in.phtml');
});

/* 
 * Login request
 * user login form
 */
$app->post('/s/in', function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $user_data = [];
  $user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
  $user_data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
  $user = new UserEntity($user_data);
  $mapper = new UserMapper($this->db);
  $login = $mapper->logIn($user);
  if($login == true) {   
    return $response->withRedirect("/d");
  } else {
    return $response->withRedirect("/");
  }
});

/* 
 * Logout
 * user logout - delete $_SESSION
 */
$app->get('/s/out', function (Request $request, Response $response) {
  session_start();
  session_destroy();
  return $response->withRedirect("/");
});

/* 
 * Login create account
 * User form to create account
 */
$app->get('/s/up', function (Request $request, Response $response) {
  return $this->view->render($response, 'account/up.phtml');
});

/* 
 * Login create account request
 * User form to create account
 */
$app->post('/s/up', function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $user_data = [];
  $user_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
  $user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
  $user_data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
  $user = new UserEntity($user_data);
  $mapper = new UserMapper($this->db);
  $mapper->save($user);
  return $response->withRedirect("/");
});


$app->get('/u/up/{id}/u', function (Request $request, Response $response, $args) {
  $user_id = $args['id'];    
  $mapper = new UserMapper($this->db);
  $users = $mapper->getUserById($user_id);
  return $this->view->render($response, 'account/updateaccount.phtml', ['users'=>$users]);
});

$app->post('/u/up/{id}/u', function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $user_data = [];
  $user_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
  $user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
  $user_data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
  $user_data['id'] = filter_var($data['id']);
  $user = new UserEntity($user_data);
  $mapper = new UserMapper($this->db);
  $mapper->update($user);
  return $response->withRedirect("/d");
});


