<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GenreType form.
 */
class GenreType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('genreName', null, [
            'label' => 'Genre Name',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('genreSource', null, [
            'label' => 'Genre Source',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('genreUsageNote', null, [
            'label' => 'Genre Usage Note',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('genreUri', UrlType::class, [
            'label' => 'Genre Uri',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('broaderTermId', null, [
            'label' => 'Broader Term Id',
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
            'data_class' => 'App\Entity\Genre',
        ]);
    }
}
