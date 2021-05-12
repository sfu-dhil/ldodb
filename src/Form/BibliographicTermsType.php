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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BibliographicTermsType form.
 */
class BibliographicTermsType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('bibliographicTerm', null, [
            'label' => 'Bibliographic Term',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('useForFormat', ChoiceType::class, [
            'label' => 'Use For Format',
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
        $builder->add('useForPhotographs', ChoiceType::class, [
            'label' => 'Use For Photographs',
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
        $builder->add('useForIllustrations', ChoiceType::class, [
            'label' => 'Use For Illustrations',
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
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\BibliographicTerms',
        ]);
    }
}
