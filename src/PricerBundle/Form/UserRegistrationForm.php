<?php

namespace PricerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Имя пользователя: ',
                'required' => false
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Пароль: ',
                'required' => false
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email: ',
                'required' => false
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'Имя: ',
                'required' => false
            ))
            ->add('secondName', TextType::class, array(
                'label' => 'Фамилия: ',
                'required' => false
            ))
            ->add('birthDate', BirthdayType::class, array(
                'label' => 'Дата рождения: ',
                'required' => false
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Контактный телефон: ',
                'required' => false
            ))
            ->add('website', UrlType::class, array(
                'label' => 'Интернет сайт: ',
                'required' => false
            ))
            ->add('facebook', UrlType::class, array(
                'label' => 'Facebook: ',
                'required' => false
            ))
            ->add('skype', TextType::class, array(
                'label' => 'Skype: ',
                'required' => false
            ))
            ->add('viber', TextType::class, array(
                'label' => 'Viber: ',
                'required' => false
            ))
            ->add('anotherMessenger', TextType::class, array(
                'label' => 'Другие: ',
                'required' => false
            ))
            ->add('country', TextType::class, array(
                'label' => 'Страна: ',
                'required' => false
            ))
            ->add('region', TextType::class, array(
                'label' => 'Регион: ',
                'required' => false
            ))
            ->add('city', TextType::class, array(
                'label' => 'Город: ',
                'required' => false
            ))
            ->add('street', TextType::class, array(
                'label' => 'Улица: ',
                'required' => false
            ))
            ->add('house', TextType::class, array(
                'label' => 'Дом: ',
                'required' => false
            ))
            ->add('flat', TextType::class, array(
                'label' => 'Квартира: ',
                'required' => false
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Сохранить'
            ));
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
        return 'pricer_bundle_user_registration_form';
    }
}
