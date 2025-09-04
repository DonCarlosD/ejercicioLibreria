<?php

namespace App\Form;

use App\Entity\Biblioteca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliotecaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[
                'label' => 'Nombre de la Biblioteca',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('calle', TextType::class,[
                'label' => 'Calle',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('colonia', TextType::class,[
                'label' => 'Colonia',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('No', TextType::class,[
                'label' => 'Número',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('CP', TextType::class,[
                'label' => 'Código Postal',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('tel', TextType::class,[
                'label' => 'Teléfono',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => ['class' => 'btn btn-primary w-100 mt-4']
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Biblioteca::class,
        ]);
    }
}
