<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\SupplementalPlaceData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * SupplementalPlaceDataType form.
 */
class SupplementalPlaceDataType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('geonameId', IntegerType::class, [
            'label' => 'Geonameid',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('geoname', null, [
            'label' => 'Geoname',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('latitude', NumberType::class, [
            'label' => 'Latitude',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('longitude', NumberType::class, [
            'label' => 'Longitude',
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
            'data_class' => SupplementalPlaceData::class,
        ]);
    }
}
