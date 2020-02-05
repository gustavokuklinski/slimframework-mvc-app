<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/* 
 * Static Controller
 * Manage public pages 
 * Information about routes: config/routes.php
 */
 
/* 
 * Home
 * List all posts
 */
$app->get('/', function (Request $request, Response $response) {
  $mapper = new PostMapper($this->db);
  $posts = $mapper->getAllPosts();
  return $this->view->render($response, 'static/home.phtml', ['posts'=>$posts, 'router'=>$this->router]);
});

/* 
 * Home
 * List single post
 */
$app->get('/n/{id}', function (Request $request, Response $response, $args) {
  $post_id = $args['id'];    
  $mapper = new PostMapper($this->db);
  $posts = $mapper->getPostById($post_id);
  return $this->view->render($response, 'static/post.phtml', ['posts'=>$posts]);
})->setName('post-detail');

/* 
 * User public profile
 * Show name and e-mail of the user
 */
$app->get('/u/{id}', function (Request $request, Response $response, $args) {
  $user_id = $args['id'];  
  $user_mapper = new UserMapper($this->db);
  $users = $user_mapper->getUserById($user_id);
  return $this->view->render($response, 'static/profile.phtml', ['users'=>$users]);
});

