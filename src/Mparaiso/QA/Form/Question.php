<?php

namespace Mparaiso\QA\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Question extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('title')
        ->add('body')
        ->add('user')
        ->add('interests',null,array('multiple'=>true,'expanded'=>true))
        ->add('answers',null,array('multiple'=>true,'expanded'=>true));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "question";
    }
}
