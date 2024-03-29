<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('title', TextField::class, [
                'label' => 'Titre de la section',
                'required' => true,
                'attr' => [ 
                    'class' => 'border-2 border-neutral-800 w-full py-3 rounded-lg focus:outline-none pl-4 bg-neutral-700 text-white',
                ],
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'Créer la section',
                'attr' => [
                    'class' => 'hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-lg w-full py-3 mt-3 border-b-4 border-b-base-purple',
                ],
            ]);
            
    }
}
