<?php

namespace dvaqueiro\Infrastructure\Ui\Api;

use dvaqueiro\Application\showAllBooksService;
use dvaqueiro\Domain\Model\Book\Book;
use dvaqueiro\Domain\Model\Book\Isbn;
use dvaqueiro\Infrastructure\Persistence\InMemory\Book\InMemoryBookRepository;
use Silex\Provider\SecurityServiceProvider;

/**
 * Description of Application
 *
 * @author dvaqueiro
 */
class Application
{
    public static function bootstrap()
    {
        $app = new \Silex\Application();

        $app['debug'] = true;

        $app['app.token_authenticator'] = function ($app) {
            return new TokenAuthenticator($app['security.encoder_factory']);
        };

        $app['security.firewalls'] = array(
            'main' => array(
                'guard' => array(
                    'authenticators' => array(
                        'app.token_authenticator'
                    ),
                ),
                'users' => array(
                    //raw password = foo
                    'dvaqueiro' => array('ROLE_USER', '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a'),
                ),
            ),
        );

        $app->register(new SecurityServiceProvider(), $app['security.firewalls']);

        $app['book_repository'] = function () {
            return new InMemoryBookRepository();
        };

        $app['book_repository']->add(new Book(new Isbn(123456), 'title', 1990));

        $app['show_all_books_service'] = function ($app) {
            return new showAllBooksService($app['book_repository']);
        };

        return $app;
    }
}