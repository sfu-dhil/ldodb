<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Book;
use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * OtherNationalEditionType form.
 */
class OtherNationalEditionType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('publicationDate', TextType::class, [
            'label' => 'Publication Date',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('book', Select2EntityType::class, [
            'multiple' => false,
            'remote_route' => 'book_typeahead',
            'class' => Book::class,
            'primary_key' => 'id',
            'text_property' => 'title',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('place', Select2EntityType::class, [
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
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\OtherNationalEdition',
        ]);
    }
}
