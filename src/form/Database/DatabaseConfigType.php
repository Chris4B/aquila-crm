<?php

namespace App\Form\Database;

use App\Entity\DatabaseConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatabaseConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('databaseHost', TextType::class, [
                'label' => 'Database Host'
            ])
            ->add('databasePort', TextType::class, [
                'label' => 'Database Port'
            ])
            ->add('databaseName', TextType::class, [
                'label' => 'Database Name'
            ])
            ->add('databaseUser', TextType::class, [
                'label' => 'Database user'
            ])
            ->add('databasePassword', TextType::class, [
                'label' => 'Database Password'
            ])
            ->add('Enregistrer', SubmitType::class, [
                'label' => 'Configure Database'
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatabaseConfig::class
        ]);
    }
}