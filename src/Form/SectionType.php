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
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'Créer la section',
            ]);
            
    }
}
