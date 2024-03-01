<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Constraints\RegexConstraint;
use Ernicani\Form\Fields\PasswordField;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('identifiant', TextField::class, [
                'label' => '',
                'required' => true,
                'regex' => new RegexConstraint('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'Invalid email address'),
                'attr' => [
                    'placeholder' => 'Email ou nom d\'utilisateur',
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-t-lg focus:outline-none pl-4 bg-neutral-700 text-slate-300',
                ],

            ])
            ->add('password', PasswordField::class, [
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-b-lg focus:outline-none pl-4 bg-neutral-700 text-slate-300',
                ],
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'Connexion',
                'attr' => [
                    'class' => 'hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-2xl w-full py-3 mt-7 border-b-4 border-b-base-purple',
                ],
            ])

            ;
    }
}