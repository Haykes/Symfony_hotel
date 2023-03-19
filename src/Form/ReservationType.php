<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Suite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une date de début.',
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date de début doit être égale ou postérieure à aujourd\'hui.',
                    ]),
                ],
            ])
            ->add('endDate', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une date de fin.',
                    ]),
                ],
            ])
            ->add('suite', EntityType::class, [
                'class' => Suite::class,
                'choice_label' => 'title',
                'label' => 'Suite',
                'placeholder' => 'Sélectionnez une suite',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une suite.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
