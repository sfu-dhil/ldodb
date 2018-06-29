<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PeopleType form.
 */
class PeopleType extends AbstractType {

    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('lastName', null, array(
            'label' => 'Last Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('firstName', null, array(
            'label' => 'First Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('otherLastName', null, array(
            'label' => 'Other Last Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('otherFirstName', null, array(
            'label' => 'Other First Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('birthDate', null, array(
            'label' => 'Birth Date',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('deathDate', null, array(
            'label' => 'Death Date',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('gender', null, array(
            'label' => 'Gender',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('biographicalNotes', null, array(
            'label' => 'Biographical Notes',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('biographicalAnnotation', null, array(
            'label' => 'Biographical Annotation',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('nationality', null, array(
            'label' => 'Nationality',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('peopleUri', null, array(
            'label' => 'People Uri',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('residentInLd', ChoiceType::class, array(
            'label' => 'Resident In Ld',
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
        $builder->add('residentInLondon', ChoiceType::class, array(
            'label' => 'Resident In London',
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
        $builder->add('residentOutsideUk', ChoiceType::class, array(
            'label' => 'Resident Outside Uk',
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
        $builder->add('travelOutsideUk', ChoiceType::class, array(
            'label' => 'Travel Outside Uk',
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
        $builder->add('birthPlace');
        $builder->add('deathPlace');
        $builder->add('travels');
        $builder->add('residences');
        $builder->add('roles');
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
            'data_class' => 'AppBundle\Entity\People'
        ));
    }

}
