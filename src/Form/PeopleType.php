<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Place;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * PeopleType form.
 */
class PeopleType extends AbstractType {
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
        $builder->add('otherLastName', null, [
            'label' => 'Other Last Name',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('otherFirstName', null, [
            'label' => 'Other First Name',
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
        $builder->add('gender', null, [
            'label' => 'Gender',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('biographicalNotes', null, [
            'label' => 'Biographical Notes',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('biographicalAnnotation', null, [
            'label' => 'Biographical Annotation',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('nationality', null, [
            'label' => 'Nationality',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('peopleUri', UrlType::class, [
            'label' => 'People Uri',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('residentInLd', ChoiceType::class, [
            'label' => 'Resident In Ld',
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
        $builder->add('residentInLondon', ChoiceType::class, [
            'label' => 'Resident In London',
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
        $builder->add('residentOutsideUk', ChoiceType::class, [
            'label' => 'Resident Outside Uk',
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
        $builder->add('travelOutsideUk', ChoiceType::class, [
            'label' => 'Travel Outside Uk',
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
        $builder->add('birthPlace', Select2EntityType::class, [
            'multiple' => false,
            'remote_route' => 'place_typeahead',
            'class' => Place::class,
            'primary_key' => 'id',
            'text_property' => 'placename',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('deathPlace', Select2EntityType::class, [
            'multiple' => false,
            'remote_route' => 'place_typeahead',
            'class' => Place::class,
            'primary_key' => 'id',
            'text_property' => 'placeName',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('travels', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'place_typeahead',
            'class' => Place::class,
            'primary_key' => 'id',
            'text_property' => 'placeName',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('residences', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'place_typeahead',
            'class' => Place::class,
            'primary_key' => 'id',
            'text_property' => 'placeName',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('roles', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'role_typeahead',
            'class' => Role::class,
            'primary_key' => 'id',
            'text_property' => 'roleName',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
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
            'data_class' => 'App\Entity\People',
        ]);
    }
}
