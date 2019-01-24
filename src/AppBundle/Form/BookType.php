<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BookType form.
 */
class BookType extends AbstractType {

    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('fileName', null, array(
            'label' => 'File Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('callNumber', null, array(
            'label' => 'Call Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('title', null, array(
            'label' => 'Title',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('shortTitle', null, array(
            'label' => 'Short Title',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('seriesTitle', null, array(
            'label' => 'Series Title',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('titlePageQuotation', null, array(
            'label' => 'Title Page Quotation',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('dedication', null, array(
            'label' => 'Dedication',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('imprint', null, array(
            'label' => 'Imprint',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('edition', null, array(
            'label' => 'Edition',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('publicationDate', null, array(
            'label' => 'Publication Date',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('volumes', null, array(
            'label' => 'Volumes',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('pages', null, array(
            'label' => 'Pages',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('copies', null, array(
            'label' => 'Copies',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('sfuCatOrigBib', null, array(
            'label' => 'Sfu Cat Orig Bib',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('sfuDigitalCopy', null, array(
            'label' => 'SFU Digital Copy',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('originalBib', ChoiceType::class, array(
            'label' => 'Original Bib',
            'expanded' => true,
            'multiple' => false,
            'choices' => array(
                'Yes' => true,
                'No' => false,
                'Unknown' => null,
            ),
            'required' => false,
            'placeholder' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('bicknellNumber', null, array(
            'label' => 'Bicknell Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('healeyNumber', null, array(
            'label' => 'Healey Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('reedNumber', null, array(
            'label' => 'Reed Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('publicDomain', ChoiceType::class, array(
            'label' => 'Public Domain',
            'expanded' => true,
            'multiple' => false,
            'choices' => array(
                'Yes' => true,
                'No' => false,
                'Unknown' => null,
            ),
            'required' => false,
            'placeholder' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('britishEdition', null, array(
            'label' => 'British Edition',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('price', null, array(
            'label' => 'Price',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('printRun', null, array(
            'label' => 'Print Run',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('bookUri', UrlType::class, array(
            'label' => 'Book Uri',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('digitalObjectUrl', null, array(
            'label' => 'Digital Object Url',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('bibliographicNotes', null, array(
            'label' => 'Bibliographic Notes',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('criticalAnnotation', null, array(
            'label' => 'Critical Annotation',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('format', null, array(
            'label' => 'Format',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('plateCount', null, array(
            'label' => 'Plate Count',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('mapCount', null, array(
            'label' => 'Map Count',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('illustrations', null, array(
            'label' => 'Illustrations',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('photographs', null, array(
            'label' => 'Photographs',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('tables', ChoiceType::class, array(
            'label' => 'Tables',
            'expanded' => true,
            'multiple' => false,
            'choices' => array(
                'Yes' => true,
                'No' => false,
                'Unknown' => null,
            ),
            'required' => false,
            'placeholder' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('bindingColour', null, array(
            'label' => 'Binding Colour',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('genres');
        $builder->add('referencedPeople');
        $builder->add('plateTypes');
        $builder->add('mapTypes');
        $builder->add('subjects');
        $builder->add('mapSizes');
        $builder->add('subjectHeadings');
        $builder->add('bindingFeatures');
        $builder->add('keywords');
        $builder->add('digitalCopyHolders');
        $builder->add('publicationPlaces');
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }

}
