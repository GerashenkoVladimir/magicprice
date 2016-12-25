<?php

namespace PricerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', EmailType::class, array('label' => 'Email: '))
            ->add('_password', PasswordType::class, array('label' => 'Пароль: '))
            ->add('submit', SubmitType::class, array('label' => 'Войти'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'PricerBundle\Entity\User',
            )
        );
    }

    public function getName()
    {
        return 'pricer_bundle_user_form';
    }
}
