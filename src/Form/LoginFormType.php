<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Constraints\RegexConstraint;
use Ernicani\Form\Fields\DivField;
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
            ->add('htmlElement', DivField::class, [
                'attr' => [
                    'class' => 'ml-1',
                ],
                'html' => '<a href="#" class="text-light-purple text-sm hover:underline">Tu as oublié ton mot de passe ?</a>',
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'CONNEXION',
                'attr' => [
                    'class' => 'hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-2xl w-full py-3 mt-3 border-b-4 border-b-base-purple',
                ],
            ])

            ;
    }
}