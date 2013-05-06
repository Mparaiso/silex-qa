<?php

namespace Mparaiso\QA\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Answer extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('question')
            ->add('user')
            ->add('body')
            ->add('relevancies',null,array('multiple'=>true,'expanded'=>true));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "answer";
    }
}
