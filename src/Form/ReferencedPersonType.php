<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ReferencedPersonType form.
 */
class ReferencedPersonType extends AbstractType
{
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('lastName', null, [
            'label' => 'Last Name',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('firstName', null, [
            'label' => 'First Name',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('birthDate', null, [
            'label' => 'Birth Date',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('deathDate', null, [
            'label' => 'Death Date',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('sameAsPeopleEntityId', null, [
            'label' => 'Same As People Entity Id',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('referencedPersonUri', UrlType::class, [
            'label' => 'Referenced Person Uri',
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
            'data_class' => 'App\Entity\ReferencedPerson',
        ]);
    }
}
