<?php

namespace App\Form\Database;

use App\Entity\DatabaseConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatabaseConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('databaseDriver', ChoiceType::class, [
                'choices' => array_combine($options['available_drivers'], $options['available_drivers']),
                'label' => 'Database Driver',
                'attr' => ['class' => 'form-control']
            ])

            ->add('connectionName',TextType::class,[
                'label'=> 'database Connection',
                'attr' => [
                    'class' => 'form-control',
                    'readonly' => true
                ],
                
            ])
            ->add('databaseHost', TextType::class, [
                'label' => 'Database Host',
                'attr' => ['class' => 'form-control']
            ])
            ->add('databasePort', TextType::class, [
                'label' => 'Database Port',
                'attr' => ['class' => 'form-control']
            ])
            ->add('databaseName', TextType::class, [
                'label' => 'Database Name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('databaseUser', TextType::class, [
                'label' => 'Database user',
                'attr' => ['class' => 'form-control']
            ])
            ->add('databasePassword', TextType::class, [
                'label' => 'Database Password',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('Enregistrer', SubmitType::class, [
                'label' => 'Configure Database',
                'attr' => ['class' => 'form-control btn btn-primary mt-3']
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => DatabaseConfig::class,
            'available_drivers' => [] // Set a default value to avoid issues
        ]);
    }
}