<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//error_reporting( E_ALL ^ ( E_NOTICE | E_WARNING | E_DEPRECATED ) );
//error_reporting(0);
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 15/6/16
 * Time: 10:32
 */
require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->config('debug', false);
$app->error(function ( Exception $e ) use ($app) {
    echo "error : " . $e;
});
//$app->response->headers->set('Content-Type', 'application/json');
$app->get('/', function () {
    echo "Hello world";
});
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
$app->get('/books/:id', function ($id) {
    //Show book identified by $id
    echo "Book $id";
});
$app->get('/books/:one/:two', function ($one, $two) {
    echo "The first parameter is " . $one;
    echo "The second parameter is " . $two;
});

// oneormany/juan/luis/daria
$app->get('/oneormany/:name+', function ($names) {
    echo "Names: <BR>";
    foreach ($names as &$name) {
        echo $name;
        echo "<BR>";
    }
});



//$app->post('/books', function () {
//    $app = \Slim\Slim::getInstance();
//    $body = $app->request->getBody();
//    $json = json_decode($body, true);
//    echo $json["name"];
//});

$app->post('/books', function () {
    $app = \Slim\Slim::getInstance();
    $body = $app->request->getBody();
    $json = json_decode($body, true);
    $name = $json["name"];

    $response = $app->response();
//    $response->headers->set('Content-Type', 'application/json');
    $response->status(200);

    $result = array("message"=>"$name added.");
//    echo json_encode($result);
    $response->body(json_encode($result));
});

$app->run();


?>