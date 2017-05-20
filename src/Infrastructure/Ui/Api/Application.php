<?php

namespace dvaqueiro\Infrastructure\Ui\Api;

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

        return $app;
    }
}