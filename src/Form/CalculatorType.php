<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $operators = ['adder' => '+', 'substractor' => '-', 'multiplicator' => '*', 'divisor' => '/'];
        
        $builder
            ->add('operation', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-control operation-input']
            ]);

        foreach ($operators as $name => $sign) {
            $builder->add($name, ButtonType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary btn-block operator-button',
                    'value' => $sign
                ], 
                'label' => $sign
            ]);
        }

        for ($i = 0; $i <= 9 ; $i++) {
            $builder->add($i, ButtonType::class, [
                'attr' => [
                    'class' => 'btn btn-light btn-block operand-button',
                    'value' => $i
                ],
                'label' => $i
            ]);
        }
        $builder->add('point', ButtonType::class, [
            'attr' => [
                 'class' => 'btn btn-light btn-block operand-button',
                 'value' => '.'
                ],
            'label' => '.'
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
