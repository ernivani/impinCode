<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Constraints\RegexConstraint;
use Ernicani\Form\Fields\PasswordField;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\Fields\TextField;
use Ernicani\Form\FormBuilder;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('email', TextField::class, [
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse e-mail',
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-t-lg focus:outline-none pl-4 bg-neutral-700 text-slate-300',
                ],
            ])
            ->add('username', TextField::class, [
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom d\'utilisateur',
                    'class' => 'border-2 border-neutral-800 w-full py-3 focus:outline-none pl-4 bg-neutral-700 text-slate-300',
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
                'label' => 'CRÉER MON COMPTE',
                'attr' => [
                    'class' => 'hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-2xl w-full py-3 mt-3 border-b-4 border-b-base-purple',
                ],
            ]);
    }
}
