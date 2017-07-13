<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder->add('fileName');     
        $builder->add('callNumber');     
        $builder->add('title');     
        $builder->add('shortTitle');     
        $builder->add('seriesTitle');     
        $builder->add('titlePageQuotation');     
        $builder->add('dedication');     
        $builder->add('imprint');     
        $builder->add('edition');     
        $builder->add('publicationDate');     
        $builder->add('volumes');     
        $builder->add('pages');     
        $builder->add('copies');     
        $builder->add('sfuCatOrigBib');     
        $builder->add('originalBib');     
        $builder->add('bicknellNumber');     
        $builder->add('healeyNumber');     
        $builder->add('reedNumber');     
        $builder->add('publicDomain');     
        $builder->add('britishEdition');     
        $builder->add('price');     
        $builder->add('printRun');     
        $builder->add('bookUri');     
        $builder->add('digitalObjectUrl');     
        $builder->add('bibliographicNotes');     
        $builder->add('criticalAnnotation');     
        $builder->add('format');     
        $builder->add('plateCount');     
        $builder->add('mapCount');     
        $builder->add('illustrations');     
        $builder->add('photographs');     
        $builder->add('tables');     
        $builder->add('bindingColour');     
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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }
}
