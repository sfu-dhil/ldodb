<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PlaceType form.
 */
class PlaceType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('placeName', null, [
            'label' => 'Place Name',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('placeUri', UrlType::class, [
            'label' => 'Place Uri',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('inLakeDistrict', ChoiceType::class, [
            'label' => 'In Lake District',
            'expanded' => true,
            'multiple' => false,
            'choices' => [
                'Yes' => true,
                'No' => false,
                'Unknown' => null,
            ],
            'required' => false,
            'placeholder' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('latitude', NumberType::class, [
            'label' => 'Latitude',
            'html5' => true,
            'input' => 'number',
            'scale' => 8,
            'required' => false,
            'attr' => [
                'help_block' => '',
                'step' => 'any',
            ],
        ]);
        $builder->add('longitude', NumberType::class, [
            'label' => 'Longitude',
            'html5' => true,
            'input' => 'number',
            'scale' => 8,
            'required' => false,
            'attr' => [
                'help_block' => '',
                'step' => 'any',
            ],
        ]);
        $builder->add('regionId', IntegerType::class, [
            'label' => 'Region Id',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('countryId', IntegerType::class, [
            'label' => 'Country Id',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Place',
        ]);
    }
}
