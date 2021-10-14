<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function (Request $request, Response $response, $args) {
	// Render index view
	return $this->view->render($response, 'index.latte');
})->setName('index');

$app->post('/login', function (Request $request, Response $response, $args) {
	//read POST data
	$input = $request->getParsedBody();

	//log
	$this->logger->info('Your name: ' . $input['person']);

	return $response->withHeader('Location', $this->router->pathFor('index'));
})->setName('redir');

$app->get('/users', function (Request $request, Response $response, $args) {

	$json = file_get_contents('https://akela.mendelu.cz/~xvalovic/mock_users.json');
	$obj["users"] = json_decode($json, true);
	// Render index view
	return $this->view->render($response, 'users.latte', $obj);
})->setName('users_list');

$app->get('/login', function (Request $request, Response $response, $args) {
	// Render index view
	return $this->view->render($response, 'login.latte');
})->setName('login_form');