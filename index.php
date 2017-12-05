<?php

require 'vendor/autoload.php';
require 'db.php';

$app = new \Slim\Slim();
$app->db = new DBConnect();

$app->config(array(
    'debug' => false
));

$app->get('/', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $app->render('home.php', array('status' => $app->db->getStatus()));
});

$app->get('/:id', function($id) {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $app->render('home.php', array('status' => $app->db->getStatusById(filter_var($id, FILTER_SANITIZE_STRING))));
});

$app->map('/status/:status(/:name)', function($status, $name = 'anonymous') {
    $app = \Slim\Slim::getInstance();
    if($status === 'fired' || $status === '1') {
        $app->db->setStatus(true, filter_var($name, FILTER_SANITIZE_STRING));
        $app->response->setStatus(200);
    } else if($status === 'notfired' || $status === '0') {
        $app->db->setStatus(false, filter_var($name, FILTER_SANITIZE_STRING));
        $app->response->setStatus(200);
    } else {
        $app->response->setStatus(500);
    }
})->via('PUT', 'POST');

$app->map('/status/latest', function() {
    $app = \Slim\Slim::getInstance();
    $status = json_encode($app->db->getStatus());
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $status;
})->via('GET');

$app->map('/status/:id', function($id) {
    $app = \Slim\Slim::getInstance();
    $status = json_encode($app->db->getStatusById(filter_var($id, FILTER_SANITIZE_STRING)));
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $status;
})->via('GET');

$app->map('/status/all', function() {
    $app = \Slim\Slim::getInstance();
    $status = json_encode($app->db->getAllStatuses());
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $status;
})->via('GET');

$app->run();
