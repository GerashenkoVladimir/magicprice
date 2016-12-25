<?php

namespace PricerBundle\Form;

use PricerBundle\Entity\Brand;
use PricerBundle\Service\GlobalHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddVendorCodeRulerForm extends AbstractType
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct()
    {
        $this->container = GlobalHelper::getContainer();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $doctrine = $this->container->get('doctrine');
        $brands = $doctrine->getRepository('PricerBundle:Brand')->findAll();
        $builder
            ->add('brand', ChoiceType::class, array(
                'label' => 'Выберите производителя для которого нужно создать правило замены: ',
                'choices' =>$brands,
                'choice_label' => function(Brand $brand){
                    return $brand->getName();
                },
                'attr' => array(
                    'size' => 10
                ),
            ))
            ->add('ruler', TextType::class, array(
                'label' => 'Правило замены: '
            ))
            ->add('replacement', TextType::class, array(
                'label' => 'На что будет заменено: ',
                'required' => false,
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Добавить правило'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'PricerBundle\Entity\VendorCodeRuler',
            )
        );
    }

    public function getName()
    {
        return 'pricer_bundle_add_vendor_code_ruler_form';
    }
}
