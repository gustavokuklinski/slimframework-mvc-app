<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/* 
 * Dashboard Controller
 * Panel control for the user manage his created posts and account
 * Information about routes: config/routes.php
 */

/* 
 * Dashboard
 * User control panel
 */
$app->get('/d', function (Request $request, Response $response) {
  return $this->view->render($response, 'dashboard/home.phtml');
});

/* 
 * Create form
 * Create a new post
 */
$app->get('/d/add', function (Request $request, Response $response) {
  return $this->view->render($response, 'dashboard/addpost.phtml');
});

/* 
 * Create request
 * Create a new post
 */
$app->post('/d/add', function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $post_data = [];
  $post_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
  $post_data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
  $post_data['user_id'] = filter_var($data['user_id']);
  $post = new PostEntity($post_data);
  $mapper = new PostMapper($this->db);
  $mapper->save($post);
  return $response->withRedirect("/d");
});

/* 
 * Detail all posts created by the user
 *
 */
$app->get('/d/n/{id}', function (Request $request, Response $response, $args) {
  $user_id = $args['id'];
  $mapper = new PostMapper($this->db);
  $posts = $mapper->getPostsByUserId($user_id);
  return $this->view->render($response, 'dashboard/myposts.phtml', ['posts'=>$posts, 'router'=>$this->router]);
});

/* 
 * Detail single post created by the user
 *
 */
$app->get('/d/n/v/{id}', function (Request $request, Response $response, $args) {
  $post_id = $args['id'];    
  $mapper = new PostMapper($this->db);
  $posts = $mapper->getPostById($post_id);
  return $this->view->render($response, 'dashboard/viewmypost.phtml', ['posts'=>$posts]);
})->setName('user-post-detail');

/* 
 * Update post form
 * update selected post 
 */
$app->get('/d/n/v/{id}/u', function (Request $request, Response $response, $args) {
  $post_id = $args['id'];    
  $mapper = new PostMapper($this->db);
  $posts = $mapper->getPostById($post_id);
  return $this->view->render($response, 'dashboard/updatemypost.phtml', ['posts'=>$posts]);
})->setName('user-update-post-detail');

/* 
 * Update post request
 * update selected post 
 */
$app->post('/d/n/v/{id}/u', function (Request $request, Response $response) {
  $data = $request->getParsedBody();
  $post_data = [];
  $post_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
  $post_data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
  $post_data['id'] = filter_var($data['id']);
  $post = new PostEntity($post_data);
  $mapper = new PostMapper($this->db);
  $mapper->update($post);
  return $response->withRedirect("/d");
});

/* 
 * Delete post request
 * delete selected post 
 */
$app->post('/d/n/v/{id}/d', function (Request $request, Response $response, $args) {
  $post_id = $args['id'];    
  $mapper = new PostMapper($this->db);
  $posts = $mapper->destroy($post_id);
  return $response->withRedirect("/d");
})->setName('user-delete-post');


