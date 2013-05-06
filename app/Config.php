<?php
use Silex\ServiceProviderInterface;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Mparaiso\Provider\CrudServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Mparaiso\Provider\QAServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Mparaiso\Provider\DoctrineORMServiceProvider;
use Mparaiso\Provider\ConsoleServiceProvider;
use Silex\Application;

class Config implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $app->register(new ConsoleServiceProvider);
        $app->register(new TwigServiceProvider(), array(
            "twig.options" => array(
                "cache" => __DIR__ . '/../temp/twig',
            )
        ));
        $app->register(new HttpCacheServiceProvider(), array(
            "http_cache.cache_dir" => __DIR__ . '/temp/http',
        ));
        $app->register(new MonologServiceProvider(), array(
            "monolog.logfile" => __DIR__ . '/../temp/log-' . date('Y-m-d') . '.txt'));
        $app->register(new FormServiceProvider());
        $app->register(new SessionServiceProvider());
        $app->register(new ValidatorServiceProvider());
        $app->register(new TranslationServiceProvider());
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new DoctrineServiceProvider, array(
            "db.options" => array(
                "driver"   => getenv('QA_DRIVER'),
                "host"     => getenv("QA_HOST"),
                "dbname"   => getenv('QA_DBNAME'),
                "password" => getenv('QA_PASSWORD'),
                "user"     => getenv("QA_USER"),
            )
        ));
        $app->register(new DoctrineORMServiceProvider, array(
            "orm.proxy_dir" => __DIR__ . '/Proxy',
        ));
        $app->register(new CrudServiceProvider);
        $app->register(new QAServiceProvider);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}
