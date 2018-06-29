<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PlaceType form.
 */
class PlaceType extends AbstractType {

    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('placeName', null, array(
            'label' => 'Place Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('placeUri', null, array(
            'label' => 'Place Uri',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('inLakeDistrict', ChoiceType::class, array(
            'label' => 'In Lake District',
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
        $builder->add('latitude', null, array(
            'label' => 'Latitude',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('longitude', null, array(
            'label' => 'Longitude',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('regionId', null, array(
            'label' => 'Region Id',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('countryId', null, array(
            'label' => 'Country Id',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('books');
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
            'data_class' => 'AppBundle\Entity\Place'
        ));
    }

}
