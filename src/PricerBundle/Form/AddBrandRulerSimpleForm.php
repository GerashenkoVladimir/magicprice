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

class AddBrandRulerSimpleForm extends AbstractType
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
        $brands = $this->container->get('doctrine')->getRepository('PricerBundle:Brand')->findAll();
        $builder
            ->add('brand', ChoiceType::class,array(
                'label' => 'Выберите бренд к которому нужно применить правило: ',
                'choices' => $brands,
//                'multiple' => true,
                'attr' => array(
                    'size' => 10
                ),
                'choice_label' => function(Brand $brand){
                    return $brand->getName();
                }
            ))
            ->add('ruler', TextType::class, array(
                'label' => 'Правило замены: '
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Добавить правило'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'PricerBundle\Entity\BrandRuler',
            )
        );
    }

    public function getName()
    {
        return 'pricer_bundle_add_brand_ruler_simple_form';
    }
}
