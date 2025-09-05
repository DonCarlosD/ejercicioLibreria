<?php

namespace App\Form;

use App\Entity\Biblioteca;
use App\Entity\BibliotecaLibro;
use App\Entity\Libro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliotecaLibrosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad', TextType::class, [
                'attr' => [
                    'min' => 1,
                    'class' => 'form-control'
                ],
                'label' => 'cantidad',
            ])
            ->add('puntuacion', TextType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                    'class' => 'form-control'
                ],
                'label' => 'puntaje',
            ])
            ->add('biblioteca', EntityType::class, [
                'class' => Biblioteca::class,
                'choice_label' => 'nombre',
                'disabled' => true,
                'attr' => ['class' => 'form-control'],
                'label' => 'biblioteca'
            ])
            ->add('libro', EntityType::class, [
                'class' => Libro::class,
                'choice_label' => 'titulo',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Seleccione un libro',
                'label' => 'libro'


            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'value' => 'Agregar Libro',
                    'class' => 'btn btn-primary form-control'],
                'label' => 'Guardar',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BibliotecaLibro::class,
        ]);
    }
}
