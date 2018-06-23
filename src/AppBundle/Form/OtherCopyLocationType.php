<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * OtherCopyLocationType form.
 */
class OtherCopyLocationType extends AbstractType
{
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        $builder->add('otherCopyLocation', null, array(
            'label' => 'Other Copy Location',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
                $builder->add('copyCount', null, array(
            'label' => 'Copy Count',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
                        $builder->add('book');
        
    }
    
    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OtherCopyLocation'
        ));
    }

}
