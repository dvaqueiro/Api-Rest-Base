<?php

use Dvaqueiro\Application\showAllBooksService;
use Dvaqueiro\Domain\Model\Book\Book;
use Dvaqueiro\Domain\Model\Book\Isbn;
use Dvaqueiro\Infrastructure\Persistence\InMemory\Book\InMemoryBookRepository;
use Dvaqueiro\Infrastructure\Ui\Api\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__.'/../../../../../vendor/autoload.php';

$app = Application::bootstrap();

$app->get('/', function () {
    return new JsonResponse("Api is ready!!!", 200);
});

$app->get('/books', function () use ($app) {
    $response = $app['show_all_books_service']->execute();
    
    return new JsonResponse($response);
});

$app->run();