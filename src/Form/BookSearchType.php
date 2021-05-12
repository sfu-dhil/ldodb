<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * BookType form.
 */
class BookSearchType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->setMethod('GET');
        $builder->add('title', TextType::class, [
            'label' => 'Title',
            'required' => false,
            'attr' => [
                'help_block' => 'Search for a title or short title',
            ],
        ]);

        $builder->add('publicationDate', TextType::class, [
            'label' => 'Publication Date',
            'required' => false,
            'attr' => [
                'help_block' => 'Search for a year (eg <kbd>1795</kbd>) or range of years (<kbd>1790-1800</kbd>) or a partial range of years (<kbd>*-1800</kbd>)',
            ],
        ]);

        $builder->add('genre', TextType::class, [
            'label' => 'Genre',
            'required' => false,
            'attr' => [
                'help_block' => 'Search for titles by genre',
            ],
        ]);

        $builder->add('keyword', TextType::class, [
            'label' => 'Subject or Keyword',
            'required' => false,
            'attr' => [
                'help_block' => 'Search for title by keyword or subject',
            ],
        ]);
    }
}
