<?php

declare(strict_types=1);

namespace Waaz\SyliusTntPlugin\Form\Extension;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;

final class AddressTntExtension extends AbstractTypeExtension
{
    public function __construct(private RouterInterface $router)
    {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'sylius.form.address.city',
                'attr' => [
                    'data-tnt-url' => $this->router->generate('waaz_tnt_plugin_city_choices_by_zip_code', ['postcode' =>'xxxxx']),
                    'data-tnt-select-classes' => 'ui dropdown'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => true,
                'label' => 'sylius.form.address.phone_number',
                'constraints' => [new NotBlank(['groups' => ['sylius']])]
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [AddressType::class];
    }
}