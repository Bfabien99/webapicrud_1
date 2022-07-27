<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ApiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ],
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter title...'
                )
            ])
            ->add('description', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter description...'
                )
            ])
            ->add('price', IntegerType::class, [
                'constraints' => [
                    new NotNull(),
                ],
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter price...'
                )
            ])
            ->add('image_url', UrlType::class, [
                'constraints' => [
                    new NotNull(),
                ],
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter image url...'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
