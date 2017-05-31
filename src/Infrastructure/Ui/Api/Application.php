<?php

namespace Dvaqueiro\Infrastructure\Ui\Api;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Dvaqueiro\Application\showAllBooksService;
use Dvaqueiro\Domain\Model\Book\Book;
use Dvaqueiro\Domain\Model\Book\Isbn;
use Dvaqueiro\Infrastructure\Persistence\Doctrine\Book\DoctrineBookRepository;
use Silex\Provider\DoctrineServiceProvider;
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

        $app->register(new DoctrineServiceProvider(),
            array(
            'db.options' => array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'dbname' => 'book_store',
                'user' => 'root',
                'password' => 'abc123456',
                'charset' => 'utf8',
                'driverOptions' => array(1002 => 'SET NAMES utf8',),
            ),
        ));

        $app->register(new DoctrineOrmServiceProvider,
            array(
            "orm.em.options" => array(
                "mappings" => array(
                    array(
                        "type" => "xml",
                        "namespace" => "Dvaqueiro\\",
                        "path" => __DIR__."/../../Persistence/Doctrine/Mappings",
                    ),
                ),
            ),
        ));

        $app['book_repository'] = function ($app) {
//            return new InMemoryBookRepository();
            /* @var $entityManager \Doctrine\ORM\EntityManager */
            return $app['orm.em']->getRepository('Dvaqueiro\Domain\Model\Book\Book');
        };

//        $app['book_repository']->add(new Book(new Isbn(123456), 'title', 1990));

        $app['show_all_books_service'] = function ($app) {
            return new showAllBooksService($app['book_repository']);
        };

        return $app;
    }
}