<?php

namespace Mparaiso\Provider;

use Silex\ServiceProviderInterface;
use Twig_SimpleFilter;
use Mparaiso\QA\Controller\DefaultController;
use Mparaiso\QA\Service\Question as QuestionService;
use Mparaiso\QA\Service\Answer as AnswerService;
use Symfony\Component\EventDispatcher\GenericEvent;
use Mparaiso\CodeGeneration\Service\CRUDService;
use Mparaiso\CodeGeneration\Controller\CRUD;
use Doctrine\ORM\Mapping\Driver\YamlDriver;
use Silex\Application;

/**
 * EN : provide a QA service for a silex application , is bootstrap ready ;)
 * FR : fournit un Q and A pour une application silex , compatible avec twitter bootstrap
 * @author M.PARAISO <mparaiso@online.fr>
 */
class QAServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        /**
         * CONTROLLERS
         */
        $app['mp.qa.controller.default'] = $app->share(function ($app) {
            return new DefaultController();
        });
        $app['mp.qa.controller.admin.answer'] = $app->share(function ($app) {
            return new CRUD(array(
                'service'        => $app['mp.qa.service.answer'],
                "entityClass"    => $app['mp.qa.entity.answer'],
                "formClass"      => $app['mp.qa.form.answer'],
                "resourceName"   => "answer",
                "templateLayout" => $app['mp.qa.twig.crud.layout']
            ));
        });
        $app['mp.qa.controller.admin.question'] = $app->share(function ($app) {
            return new CRUD(array(
                'service'        => $app['mp.qa.service.question'],
                "entityClass"    => $app['mp.qa.entity.question'],
                "formClass"      => $app['mp.qa.form.question'],
                "resourceName"   => "question",
                "templateLayout" => $app['mp.qa.twig.crud.layout']
            ));
        });
        $app['mp.qa.controller.admin.interest'] = $app->share(function ($app) {
            return new CRUD(array(
                'service'        => $app['mp.qa.service.interest'],
                "entityClass"    => $app['mp.qa.entity.interest'],
                "formClass"      => $app['mp.qa.form.interest'],
                "resourceName"   => "interest",
                "templateLayout" => $app['mp.qa.twig.crud.layout']
            ));
        });
        $app['mp.qa.controller.admin.relevancy'] = $app->share(function ($app) {
            return new CRUD(array(
                'service'        => $app['mp.qa.service.relevancy'],
                "entityClass"    => $app['mp.qa.entity.relevancy'],
                "formClass"      => $app['mp.qa.form.relevancy'],
                "resourceName"   => "relevancy",
                "templateLayout" => $app['mp.qa.twig.crud.layout']
            ));
        });
        $app['mp.qa.controller.admin.user'] = $app->share(function ($app) {
            return new CRUD(array(
                'service'        => $app['mp.qa.service.user'],
                "entityClass"    => $app['mp.qa.entity.user'],
                "formClass"      => $app['mp.qa.form.user'],
                "resourceName"   => "user",
                "templateLayout" => $app['mp.qa.twig.crud.layout']
            ));
        });
        /**
         * CORE SERVICES
         */
        $app['mp.qa.service.answer'] = $app->share(function ($app) {
            return new AnswerService($app['mp.qa.orm.em'], $app['mp.qa.entity.answer']);
        });
        $app['mp.qa.service.question'] = $app->share(function ($app) {
            return new QuestionService($app['mp.qa.orm.em'], $app['mp.qa.entity.question']);
        });
        $app['mp.qa.service.interest'] = $app->share(function ($app) {
            return new CRUDService($app['mp.qa.orm.em'], $app['mp.qa.entity.interest']);
        });
        $app['mp.qa.service.relevancy'] = $app->share(function ($app) {
            return new CRUDService($app['mp.qa.orm.em'], $app['mp.qa.entity.relevancy']);
        });
        $app['mp.qa.service.user'] = $app->share(function ($app) {
            return new CRUDService($app['mp.qa.orm.em'], $app['mp.qa.entity.user']);
        });
        /**
         * DOCTRINE ORM CONFIGURATION
         */
        $app['mp.qa.orm.em'] = $app->share(function ($app) {
            return $app['orm.em'];
        });
        $app['mp.qa.orm.entity_path'] = __DIR__ . "/../QA/Resources/doctrine";
        $app['mp.qa.entity.question'] = '\Mparaiso\QA\Entity\Question';
        $app['mp.qa.entity.answer'] = '\Mparaiso\QA\Entity\Answer';
        $app['mp.qa.entity.user'] = '\Mparaiso\QA\Entity\User';
        $app['mp.qa.entity.interest'] = '\Mparaiso\QA\Entity\Interest';
        $app['mp.qa.entity.relevancy'] = '\Mparaiso\QA\Entity\Relevancy';
        /**
         * FORMS
         */
        $app['mp.qa.form.question'] = '\Mparaiso\QA\Form\Question';
        $app['mp.qa.form.answer'] = '\Mparaiso\QA\Form\Answer';
        $app['mp.qa.form.user'] = '\Mparaiso\QA\Form\User';
        $app['mp.qa.form.interest'] = '\Mparaiso\QA\Form\Interest';
        $app['mp.qa.form.relevancy'] = '\Mparaiso\QA\Form\Relevancy';
        /**
         * TWIG
         */

        $app['mp.qa.twig.template_path'] = __DIR__ . '/../QA/Resources/views';
        $app['mp.qa.twig.crud.layout'] = "mp.qa.crud.layout.html.twig";
        $app['mp.qa.twig.layout'] = "mp.qa.layout.html.twig";
        $app['twig'] = $app->share($app->extend("twig", function ($twig, $app) {
            $twig->addFilter(new Twig_SimpleFilter("slugify", function ($word, $replacement = "-") {
                $word = preg_replace('/\W+/mi', $replacement, trim($word));
                return $word;
            }));
            return $twig;
        }));

        /** doctrine orm driver */
        $app['orm.chain_driver'] = $app->share($app->extend("orm.chain_driver", function ($driver, $app) {
            $driver->addDriver(
                new YamlDriver($app['mp.qa.orm.entity_path']), 'Mparaiso\QA');
            return $driver;
        }));
        /**
         * ROUTING
         */
        $app['mp.qa.routes.prefix'] = "";
        /**
         * PARAMS
         */
        $app['mp.qa.params.title'] = "Answer it !";
        $app['mp.qa.params.temp_dir'] = __DIR__ . '/../../../temp/qa/';
        $app['mp.qa.params.limit'] = 10;
        $app['mp.qa.params.robots'] = "index, follow";
        $app['mp.qa.params.description'] = "symfony project";
        $app['mp.qa.params.keywords'] = "symfony, project";
        $app['mp.qa.params.language'] = "en";
        /**
         * Event Listeners
         */
        $app['mp.qa.listener.user_before_save'] = $app->protect(function (GenericEvent $event) {
            $entity = $event->getSubject();
            if ($entity->getCreatedAt() == NULL)
                $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        });
        $app['mp.qa.listener.question_before_save'] = $app->protect(function (GenericEvent $event) {
            $entity = $event->getSubject();
            if ($entity->getCreatedAt() == NULL)
                $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        });
        $app['mp.qa.listener.interest_before_save'] = $app->protect(function (GenericEvent $event) {
            $entity = $event->getSubject();
            if ($entity->getCreatedAt() == NULL)
                $entity->setCreatedAt(new \DateTime());
        });
        $app['mp.qa.listener.answer_before_save'] = $app->protect(function (GenericEvent $event) {
            $entity = $event->getSubject();
            if ($entity->getCreatedAt() == NULL)
                $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        });

        $app['mp.qa.listener.relevancy_before_save'] = $app->protect(function (GenericEvent $event) {
            $entity = $event->getSubject();
            if ($entity->getCreatedAt() == NULL)
                $entity->setCreatedAt(new \DateTime());
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        $app['twig.loader.filesystem']
            ->addPath($app['mp.qa.twig.template_path']);

        /**
         * CONTROLLERS
         */
        $p = $app['mp.qa.routes.prefix'];
        $app->mount("$p", $app['mp.qa.controller.default']);
        $app->mount("$p/admin", $app['mp.qa.controller.admin.answer']);
        $app->mount("$p/admin", $app['mp.qa.controller.admin.question']);
        $app->mount("$p/admin", $app['mp.qa.controller.admin.interest']);
        $app->mount("$p/admin", $app['mp.qa.controller.admin.relevancy']);
        $app->mount("$p/admin", $app['mp.qa.controller.admin.user']);
        /**
         * EN: Listeners setup
         */
        $app->on('user_before_create', $app['mp.qa.listener.user_before_save']);
        $app->on('user_before_update', $app['mp.qa.listener.user_before_save']);
        $app->on('question_before_create', $app['mp.qa.listener.question_before_save']);
        $app->on('question_before_update', $app['mp.qa.listener.question_before_save']);
        $app->on('interest_before_create', $app['mp.qa.listener.interest_before_save']);
        $app->on('interest_before_update', $app['mp.qa.listener.interest_before_save']);
        $app->on('answer_before_create', $app['mp.qa.listener.answer_before_save']);
        $app->on('answer_before_update', $app['mp.qa.listener.answer_before_save']);
        $app->on('relevancy_before_create', $app['mp.qa.listener.relevancy_before_save']);
        $app->on('relevancy_before_update', $app['mp.qa.listener.relevancy_before_save']);

    }

}
