<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('roles', ChoiceType::class, array(
                    'choices' => array(
                        'ROLE_ORG' => 'ROLE_ORG',
                        'ROLE_USER' => 'ROLE_USER',

                    ),
                    'multiple' => true,
                    'required' => true,
                )
            );
            //->add('profilePictureFile',FileType::class);
    }

    /**
     * {@inheritdoc}
     */

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'Main_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}