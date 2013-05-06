<?php

namespace Mparaiso\QA\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class User extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('nickname')
        ->add('email')
        ->add('questions',null,array('multiple'=>true,"expanded"=>true))
        ->add('interests',null,array('multiple'=>true,"expanded"=>true))
        ->add('answers',null,array('multiple'=>true,"expanded"=>true))
        ->add('relevancies',null,array('multiple'=>true,"expanded"=>true));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "user";
    }
}
