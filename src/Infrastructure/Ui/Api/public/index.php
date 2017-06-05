<?php

use Dvaqueiro\Infrastructure\Ui\Api\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../../../../../vendor/autoload.php';

$app = Application::bootstrap();

$app->get('/', function () {
    return new JsonResponse("Api is ready!!!", 200);
});

$app->get('/books', function () use ($app) {
    $response = $app['showAllBooksService']->execute();
    
    return new JsonResponse($response);
});

$app->get('/book/{id}', function ($id) use ($app) {
    $response = $app['showOneBookService']->execute($id);

    return new JsonResponse($response);
});

$app->post('/book', function (Request $request) use ($app) {
    $content = $request->getContent();
    $response = $app['addNewBookService']->execute($content);

    return new JsonResponse($response);
});

$app->put('/book/{bookId}', function ($bookId, Request $request) use ($app) {
    $content = $request->getContent();
    $response = $app['updateBookService']->execute($bookId, $content);

    return new JsonResponse($response);
});

$app->run();