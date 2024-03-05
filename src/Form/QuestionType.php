<?php

namespace App\Form;

use Ernicani\Form\AbstractType;
use Ernicani\Form\Fields\CheckboxField;
use Ernicani\Form\Fields\SubmitField;
use Ernicani\Form\FormBuilder;
use Ernicani\Form\Fields\TextField;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilder $formBuilder, array $options)
    {
        $formBuilder 
            ->add('content', TextField::class, [
                'label' => 'Question',
                'required' => true,
            ])
            ->add('submit', SubmitField::class, [
                'label' => 'Ajouter',
            ]);
    }
}
