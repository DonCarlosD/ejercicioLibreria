<?php

namespace App\Form;

use App\Entity\Autor;
use App\Entity\Libro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn',TextType::class,[
                'label' => 'ISBN',
                'attr' => [
                    'maxlength' => 13,
                    'class' => 'form-control'],
            ])
            ->add('titulo',TextType::class,[
                'label' => 'titulo',
                'attr' => [
                    'maxlength' => 255,
                    'class' => 'form-control'],
            ])
            ->add('editorial',TextType::class,[
                'label' => 'editorial',
                'attr' => [
                    'maxlength' => 255,
                    'class' => 'form-control'],
            ])
            ->add('noPaginas',TextType::class,[
                'label' => 'no_paginas',
                'attr' => [
                    'maxlength' => 5,
                    'class' => 'form-control'],
            ])
            ->add('sinopsis',TextareaType::class,[
                'label' => 'sinopsis',
                'attr' => [
                    'maxlength' => 1000,
                    'class' => 'form-control',
                    'type' => 'textarea'],
            ])
            ->add('autor', EntityType::class, [
                'class' => Autor::class,
                'choice_label' => 'name',
                'label' => 'autor',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'placeholder_libro',
                'required' => true,
            ])
            ->add('sudmit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => ['class' => 'btn btn-primary w-100 mt-4'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}
