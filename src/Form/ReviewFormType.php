<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class ReviewFormType extends AbstractT
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Note', NumberType::class, ['label' => 'Note :']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviewdto::class,
        ]);
    }
}