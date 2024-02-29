<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Constraints\RegexConstraint;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('email', TextField::class, [
                'label' => 'Email',
                'required' => true,
                'regex' => new RegexConstraint('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'Invalid email address')
            ])
            ->add('username', TextField::class, [
                'label' => 'Username',
                'required' => true,
                'regex' => new RegexConstraint('/^[a-zA-Z0-9._-]{3,}$/', 'Invalid username')
            ]);
    }
}