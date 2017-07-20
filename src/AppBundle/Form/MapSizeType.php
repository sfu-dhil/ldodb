<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapSizeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        $builder->add('mapSize', null, array(
            'label' => 'Map Size',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
                $builder->add('mapSizeNotes', null, array(
            'label' => 'Map Size Notes',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
                        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MapSize'
        ));
    }
}
