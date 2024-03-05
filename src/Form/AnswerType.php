<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Fields\CheckboxField;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder
            ->add('content', TextField::class, [
                'label' => 'Réponse',
                'required' => true,
            ])
            ->add('isCorrect', CheckboxField::class, [
                'label' => 'Correcte',
                'required' => false,
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'Ajouter',
            ]);
            
    }
}
