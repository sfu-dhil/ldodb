<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\BindingFeature;
use App\Entity\DigitalCopyHolder;
use App\Entity\Genre;
use App\Entity\Keyword;
use App\Entity\MapSize;
use App\Entity\MapType;
use App\Entity\Place;
use App\Entity\PlateType;
use App\Entity\ReferencedPerson;
use App\Entity\Subject;
use App\Entity\SubjectHeading;
use Symfony\Bridge\Doctrine\Form\Type\EntityType as SymfonyEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * BookType form.
 */
class BookType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('fileName', null, [
            'label' => 'File Name',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('callNumber', null, [
            'label' => 'Call Number',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('title', null, [
            'label' => 'Title',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('shortTitle', null, [
            'label' => 'Short Title',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('seriesTitle', null, [
            'label' => 'Series Title',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('titlePageQuotation', null, [
            'label' => 'Title Page Quotation',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('dedication', null, [
            'label' => 'Dedication',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('imprint', null, [
            'label' => 'Imprint',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('edition', null, [
            'label' => 'Edition',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('publicationDate', null, [
            'label' => 'Publication Date',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('volumes', IntegerType::class, [
            'label' => 'Volumes',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('pages', IntegerType::class, [
            'label' => 'Pages',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('copies', IntegerType::class, [
            'label' => 'Copies',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('sfuCatOrigBib', null, [
            'label' => 'Sfu Cat Orig Bib',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('sfuDigitalCopy', null, [
            'label' => 'SFU Digital Copy',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('originalBib', ChoiceType::class, [
            'label' => 'Original Bib',
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
        $builder->add('bicknellNumber', null, [
            'label' => 'Bicknell Number',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('healeyNumber', null, [
            'label' => 'Healey Number',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('reedNumber', null, [
            'label' => 'Reed Number',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('publicDomain', ChoiceType::class, [
            'label' => 'Public Domain',
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
        $builder->add('britishEdition', null, [
            'label' => 'British Edition',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('price', null, [
            'label' => 'Price',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('printRun', null, [
            'label' => 'Print Run',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('bookUri', UrlType::class, [
            'label' => 'Book Uri',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('digitalObjectUrl', UrlType::class, [
            'label' => 'Digital Object Url',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('bibliographicNotes', null, [
            'label' => 'Bibliographic Notes',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('criticalAnnotation', TextareaType::class, [
            'label' => 'Critical Annotation',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);
        $builder->add('format', null, [
            'label' => 'Format',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('plateCount', IntegerType::class, [
            'label' => 'Plate Count',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('mapCount', IntegerType::class, [
            'label' => 'Map Count',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('illustrations', null, [
            'label' => 'Illustrations',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('photographs', null, [
            'label' => 'Photographs',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('tables', ChoiceType::class, [
            'label' => 'Tables',
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
        $builder->add('bindingColour', null, [
            'label' => 'Binding Colour',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('contributions', CollectionType::class, [
            'label' => 'Contributions',
            'required' => false,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty' => true,
            'entry_type' => ContributionType::class,
            'entry_options' => [
                'label' => false,
            ],
            'by_reference' => true,
            'attr' => [
                'class' => 'collection collection-complex',
                'help_block' => '',
            ],
        ]);
        $builder->add('genres', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'genre_typeahead',
            'class' => Genre::class,
            'primary_key' => 'id',
            'text_property' => 'genreName',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('referencedPeople', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'referenced_person_typeahead',
            'class' => ReferencedPerson::class,
            'primary_key' => 'id',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('plateTypes', SymfonyEntityType::class, [
            'class' => PlateType::class,
            'multiple' => true,
            'expanded' => true,
        ]);
        $builder->add('mapTypes', SymfonyEntityType::class, [
            'class' => MapType::class,
            'multiple' => true,
            'expanded' => true,
        ]);
        $builder->add('subjects', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'subject_typeahead',
            'class' => Subject::class,
            'primary_key' => 'id',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('mapSizes', SymfonyEntityType::class, [
            'class' => MapSize::class,
            'multiple' => true,
            'expanded' => true,
        ]);
        $builder->add('subjectHeadings', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'subject_heading_typeahead',
            'class' => SubjectHeading::class,
            'primary_key' => 'id',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('bindingFeatures', SymfonyEntityType::class, [
            'class' => BindingFeature::class,
            'multiple' => true,
            'expanded' => true,
        ]);
        $builder->add('keywords', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'keyword_typeahead',
            'class' => Keyword::class,
            'primary_key' => 'id',
            'page_limit' => 10,
            'allow_clear' => true,
            'delay' => 250,
            'language' => 'en',
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('digitalCopyHolders', SymfonyEntityType::class, [
            'class' => DigitalCopyHolder::class,
            'multiple' => true,
            'expanded' => true,
        ]);
        $builder->add('publicationPlaces', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'place_typeahead',
            'class' => Place::class,
            'primary_key' => 'id',
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
            'data_class' => 'App\Entity\Book',
        ]);
    }
}
