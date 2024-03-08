<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Constraints\RegexConstraint;
use Ernicani\Form\Fields\DivField;
use Ernicani\Form\Fields\PasswordField;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('title', TextField::class, [
                'label' => 'Titre',
                'required' => true,
                'attr' => [ 
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-lg focus:outline-none pl-4 bg-neutral-700 text-slate-300',
                ],
            ])
            ->add('completion', TextField::class, [
                'label' => 'Nombre de répétitions',
                'required' => true,
                'attr' => [ 
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-lg focus:outline-none pl-4 bg-neutral-700 text-slate-300',
                ],
            ])
            
            ->add('submit', SubmitField::class, [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-lg w-full py-3 mt-3 border-b-4 border-b-base-purple',
                ],
            ])
            ;
    }
}
