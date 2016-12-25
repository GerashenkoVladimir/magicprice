<?php

namespace PricerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Поставщик: ',
                'required' => false
                ))
            ->add('code', TextType::class, array(
                'label' => 'Код поставщика: ',
                'required'=> false
                ))
            ->add('priceCurrency', TextType::class, array(
                'label' => 'Валюта: ',
                'required'=> false
                ))
            ->add('exchangeRate', TextType::class, array(
                'label' => 'Обменный курс по отношению к евро: ',
                'required'=> false
                ))
            ->add('marginRate', TextType::class, array(
                'label' => 'Коэфициент наценки +/-: ',
                'required'=> false
                ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Сохранить',
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'PricerBundle\Entity\Supplier',
            )
        );
    }

    public function getName()
    {
        return 'pricer_bundle_supplier_form';
    }
}
