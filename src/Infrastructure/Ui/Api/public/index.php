<?php

use dvaqueiro\Infrastructure\Ui\Api\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__.'/../../../../../vendor/autoload.php';

$app = Application::bootstrap();

$app->get('/', function () {
    return new JsonResponse("Api is ready!!!", 200);
});

$app->run();