<?php

namespace App\Form;

use App\Entity\Autor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'autor.nombre',
                'attr' => ['class' => 'form-control']

            ])
            ->add('apellidoPaterno', TextType::class,[
                'label' => 'autor.apellido',
                'attr' => ['class' => 'form-control']
            ])
            ->add('apellidoMaterno', TextType::class,[
                'label' => 'autor.apellido_materno',
                'attr' => ['class' => 'form-control']
            ])
            ->add('fechaNac', DateType::class,[
                'label' => 'autor.fecha_nacimiento',
                'widget' => 'single_text',
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
            'data_class' => Autor::class,
        ]);
    }
}
