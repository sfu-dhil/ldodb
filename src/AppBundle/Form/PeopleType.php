<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeopleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder->add('lastName');     
        $builder->add('firstName');     
        $builder->add('otherLastName');     
        $builder->add('otherFirstName');     
        $builder->add('birthDate');     
        $builder->add('deathDate');     
        $builder->add('gender');     
        $builder->add('biographicalNotes');     
        $builder->add('biographicalAnnotation');     
        $builder->add('nationality');     
        $builder->add('peopleUri');     
        $builder->add('residentInLd');     
        $builder->add('residentInLondon');     
        $builder->add('residentOutsideUk');     
        $builder->add('travelOutsideUk');     
        $builder->add('birthPlace');     
        $builder->add('deathPlace');     
        $builder->add('travels');     
        $builder->add('residences');     
        $builder->add('roles');         
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\People'
        ));
    }
}
