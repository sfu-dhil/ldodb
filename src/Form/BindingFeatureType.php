<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BindingFeatureType form.
 */
class BindingFeatureType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('bindingFeature', null, [
            'label' => 'Binding Feature',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('bindingFeatureNotes', null, [
            'label' => 'Binding Feature Notes',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('books');
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\BindingFeature',
        ]);
    }
}
