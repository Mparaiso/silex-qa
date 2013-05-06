<?php

namespace Mparaiso\QA\Controller;

use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\ControllerCollection;

class DefaultController implements ControllerProviderInterface
{
    function questionCreate(Request $req, Application $app)
    {
        $question = new $app['mp.qa.entity.question']();
        $type = new $app['mp.qa.form.question']();
        $form = $app['form.factory']->create($type, $question);
        if ("POST" === $req->getMethod()) {
            $form->bind($req);
            if ($form->isValid) {
                // persist question
            }
        }
        return $app['twig']->render('mp.qa.question.create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    function userProfile(Request $req, Application $app, $_format, $id)
    {
        $user = $app['mp.qa.service.user']->find($id);
        $user == NULL AND $app->abort(404, 'Resource not found');
        return $app['twig']->render("mp.qa.user.read.$_format.twig", array(
            "user" => $user,
        ));
    }

    function recentAnswer(Request $request, Application $app, $_format)
    {
        $limit = $app['mp.qa.params.limit'];
        $offset = $request->query->getInt("offset", 0);

        $answers = $app['mp.qa.service.answer']->getRecent($limit, (int)$offset * (int)$limit);
        $total = count($answers);
        return $app['twig']->render("mp.qa.answer.recent.$_format.twig", array(
            "answers" => $answers,
            "total"   => $total,
            "limit"   => $limit,
            'offset'  => $offset,
        ));
    }

    function recentQuestions(Request $request, Application $app, $_format)
    {
        $limit = $app['mp.qa.params.limit'];
        $offset = $request->query->getInt("offset", 0);

        $questions = $app['mp.qa.service.question']->getLatest($limit, (int)$offset * (int)$limit);
        $total = count($questions);
        return $app['twig']->render("mp.qa.question.latest.$_format.twig", array(
            "questions" => $questions,
            "total"     => $total,
            "limit"     => $limit,
            'offset'    => $offset,
        ));
    }

    function popularQuestions(Request $request, Application $app, $_format)
    {
        $limit = $app['mp.qa.params.limit'];
        $offset = $request->query->getInt("offset", 0);

        $questions = $app['mp.qa.service.question']->getPopular($limit, (int)$offset * (int)$limit);
        $total = count($questions);
        return $app['twig']->render("mp.qa.question.popular.$_format.twig", array(
            "questions" => $questions,
            "total"     => $total,
            "limit"     => $limit,
            'offset'    => $offset,
        ));
    }

    function showAnswers(Request $req, Application $app, $_format, $id)
    {
        $question = $app['mp.qa.service.question']->find($id);
        $question == NULL AND $app->abort(404, "Resource not found");
        return $app['twig']->render("mp.qa.question.show.$_format.twig", array(
            "question" => $question,
        ));
    }


    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        /* @var $controllers ControllerCollection */
        $controllers->get('/', array($this, "popularQuestions"))
            ->value('_format', 'html')
            ->bind('mp_qa_question_popular');
        $controllers->get('/user/read/{id}.{_format}', array($this, 'userProfile'))
            ->value('_format', 'html')
            ->assert('id', '\d+')
            ->bind('mp_qa_user_read');
        $controllers->get('/question/ask', array($this, "questionCreate"))
            ->bind('mp_qa_question_create');
        $controllers->get('/question/latest.{_format}', array($this, "recentQuestions"))
            ->value('_format', 'html')
            ->bind('mp_qa_question_latest');
        $controllers->get('/answer/recent.{_format}', array($this, "recentAnswer"))
            ->value('_format', 'html')
            ->bind('mp_qa_answer_recent');
        $controllers->get('/question/{id}/{title}.{_format}', array($this, 'showAnswers'))
            ->value('_format', 'html')
            ->assert('id', '\d+')
            ->bind('mp_qa_question_show');
        return $controllers;
    }
}