<?php

namespace Dvaqueiro\Infrastructure\Ui\Api;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Doctrine\ORM\EntityManager;
use Dvaqueiro\Application\addNewBookService;
use Dvaqueiro\Application\showAllBooksService;
use Dvaqueiro\Application\showOneBookService;
use Dvaqueiro\Application\updateBookService;
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
            /* @var $entityManager EntityManager */
            return $app['orm.em']->getRepository('Dvaqueiro\Domain\Model\Book\Book');
        };

        $app['showAllBooksService'] = function ($app) {
            return new showAllBooksService($app['book_repository']);
        };

        $app['showOneBookService'] = function ($app) {
            return new showOneBookService($app['book_repository']);
        };

        $app['addNewBookService'] = function ($app) {
            return new addNewBookService($app['book_repository']);
        };

        $app['updateBookService'] = function ($app) {
            return new updateBookService($app['book_repository']);
        };

        return $app;
    }
}