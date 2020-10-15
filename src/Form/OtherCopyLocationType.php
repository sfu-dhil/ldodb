<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * OtherCopyLocationType form.
 */
class OtherCopyLocationType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('otherCopyLocation', null, [
            'label' => 'Other Copy Location',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('copyCount', null, [
            'label' => 'Copy Count',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('book', Select2EntityType::class, [
            'multiple' => false,
            'required' => true,
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
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\OtherCopyLocation',
        ]);
    }
}
